<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Program;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    /* ===============================
     * LIST APPLICATIONS
     * =============================== */
    public function index(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'staff'])) abort(403);

        $query = Application::with(['user', 'program'])->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->program) {
            $query->where('program_id', $request->program);
        }

        if ($request->search) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        return view('admin.applications.index', [
            'applications' => $query->paginate(10),
            'programs'     => Program::all(),
        ]);
    }

    /* ===============================
     * SHOW APPLICATION
     * =============================== */
    public function show(Application $application)
    {
        if (!in_array(auth()->user()->role, ['admin', 'staff'])) abort(403);

        $application->load(['user', 'program', 'documents']);

        return view('admin.applications.show', compact('application'));
    }

    /* ===============================
     * UPDATE STATUS (SINGLE)
     * =============================== */
    public function updateStatus(Request $request, Application $application)
    {
        $request->validate([
            'status'   => 'required|in:submitted,under_review,approved,rejected',
            'comments' => 'nullable|string',
        ]);

        $application->update([
            'status'         => $request->status,
            'admin_comments' => $request->comments,
            'reviewed_by'    => auth()->id(),
            'reviewed_at'    => now(),
        ]);

        Notification::create([
            'user_id' => $application->user->id,
            'title'   => 'Application Status Updated',
            'message' => "Your application status is now {$request->status}.",
            'type'    => 'application_status',
            'is_read' => false,
        ]);

        try {
            Mail::send([], [], function ($m) use ($application, $request) {
                $m->to($application->user->email)
                  ->subject('Application Status - UG Admission')
                  ->html(
                      "<p>Dear {$application->user->name},</p>
                       <p>Your application for <strong>{$application->program->name}</strong> is now
                       <strong>{$request->status}</strong>.</p>
                       <p>Regards,<br><strong>UG Admission Office</strong></p>"
                  );
            });
        } catch (\Throwable $e) {
            Log::error(
                "STATUS EMAIL FAILED | App ID {$application->id} | ".$e->getMessage()
            );
        }

        return back()->with('success', 'Application updated & email sent.');
    }

    /* ===============================
     * BULK INTERVIEW (PDF + EMAIL)
     * =============================== */
    public function bulkInterview(Request $request)
    {
        $request->validate([
            'application_ids' => 'required|string',
            'test_date'       => 'required|date',
            'test_time'       => 'required',
            'test_venue'      => 'required|string',
            'interview_date'  => 'required|date',
            'interview_time'  => 'required',
            'interview_venue' => 'required|string',
            'notes'           => 'nullable|string',
        ]);

        $ids = json_decode($request->application_ids, true);

        $apps = Application::whereIn('id', $ids)
            ->where('status', 'approved')
            ->with(['user', 'program'])
            ->get();

        if ($apps->isEmpty()) {
            return back()->with('error', 'No approved applications selected.');
        }

        $success = 0;
        $failed  = 0;

        foreach ($apps as $app) {
            try {
                $app->update([
                    'interview_date'  => $request->interview_date,
                    'interview_time'  => $request->interview_time,
                    'interview_venue' => $request->interview_venue,
                    'interview_notes' => $request->notes,
                ]);

                $pdf = Pdf::loadView(
                    'admin.applications.partials.test-interview-slip',
                    [
                        'application'     => $app,
                        'student'         => $app->user,
                        'program'         => $app->program,
                        'test_date'       => $request->test_date,
                        'test_time'       => $request->test_time,
                        'test_venue'      => $request->test_venue,
                        'interview_date'  => $request->interview_date,
                        'interview_time'  => $request->interview_time,
                        'interview_venue' => $request->interview_venue,
                        'notes'           => $request->notes,
                    ]
                )->setPaper('A4');

                Notification::create([
                    'user_id' => $app->user->id,
                    'title'   => 'Test & Interview Scheduled',
                    'message' => 'Please check your email for the interview slip.',
                    'type'    => 'interview',
                    'is_read' => false,
                ]);

                Mail::send([], [], function ($m) use ($app, $pdf) {
                    $m->to($app->user->email)
                      ->subject('Test & Interview Slip - UG Admission')
                      ->html(
                          "<p>Dear {$app->user->name},</p>
                           <p>Your test & interview slip is attached.</p>
                           <p>Regards,<br><strong>UG Admission Office</strong></p>"
                      )
                      ->attachData(
                          $pdf->output(),
                          "test-interview-slip-{$app->id}.pdf",
                          ['mime' => 'application/pdf']
                      );
                });

                $success++;
            } catch (\Throwable $e) {
                $failed++;
                Log::error(
                    "INTERVIEW FAILED | App ID {$app->id} | ".$e->getMessage()
                );
            }
        }

        return back()->with(
            'success',
            "{$success} interview(s) sent. {$failed} failed (check logs)."
        );
    }

    /* ===============================
     * BULK STATUS ACTION (FIXED)
     * =============================== */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,under_review',
            'application_ids' => 'required|string',
        ]);

        $ids = json_decode($request->application_ids, true);

        $statusMap = [
            'approve'      => 'approved',
            'reject'       => 'rejected',
            'under_review' => 'under_review',
        ];

        $apps = Application::whereIn('id', $ids)
            ->with(['user', 'program'])
            ->get();

        foreach ($apps as $app) {
            $status = $statusMap[$request->action];

            $app->update([
                'status'      => $status,
                'reviewed_by'=> auth()->id(),
                'reviewed_at'=> now(),
            ]);

            Notification::create([
                'user_id' => $app->user->id,
                'title'   => 'Application Status Updated',
                'message' => "Your application status is now {$status}.",
                'type'    => 'application_status',
                'is_read' => false,
            ]);

            try {
                Mail::send([], [], function ($m) use ($app, $status) {
                    $m->to($app->user->email)
                      ->subject('Application Status - UG Admission')
                      ->html(
                          "<p>Dear {$app->user->name},</p>
                           <p>Your application for <strong>{$app->program->name}</strong> is now
                           <strong>{$status}</strong>.</p>
                           <p>Regards,<br><strong>UG Admission Office</strong></p>"
                      );
                });
            } catch (\Throwable $e) {
                Log::error(
                    "BULK STATUS EMAIL FAILED | App ID {$app->id} | ".$e->getMessage()
                );
            }
        }

        return back()->with('success', count($apps).' applications updated & emailed.');
    }

    /* ===============================
     * DELETE APPLICATION
     * =============================== */
    public function destroy(Application $application)
    {
        $application->delete();
        return back()->with('success', 'Application deleted.');
    }
}
