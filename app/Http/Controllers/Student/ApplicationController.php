<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Program;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    /* ===============================
     * SHOW APPLICATION FORM
     * =============================== */
    public function create(Request $request)
    {
        $programs = Program::where('is_active', true)->get();
        $selectedProgram = null;

        if ($request->has('program')) {
            $selectedProgram = Program::find($request->program);
        }

        return view('student.application.create', compact('programs', 'selectedProgram'));
    }

    /* ===============================
     * STORE APPLICATION + STEP 3: GENERATE CHALLAN
     * =============================== */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'father_name' => 'required|string|max:255',
            'father_cnic' => 'required|string|max:15',
            'father_occupation' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'domicile' => 'required|string|max:255',

            'matric_board' => 'required|string|max:255',
            'matric_roll_no' => 'required|string|max:50',
            'matric_total_marks' => 'required|integer',
            'matric_obtained_marks' => 'required|integer',
            'matric_passing_year' => 'required|integer|min:2000|max:' . date('Y'),

            'inter_board' => 'required|string|max:255',
            'inter_roll_no' => 'required|string|max:50',
            'inter_total_marks' => 'required|integer',
            'inter_obtained_marks' => 'required|integer',
            'inter_passing_year' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        /* ===============================
         * CALCULATIONS
         * =============================== */
        $validated['matric_percentage'] =
            ($validated['matric_obtained_marks'] / $validated['matric_total_marks']) * 100;

        $validated['inter_percentage'] =
            ($validated['inter_obtained_marks'] / $validated['inter_total_marks']) * 100;

        /* ===============================
         * BASE DATA
         * =============================== */
        $validated['user_id'] = auth()->id();
        $validated['status']  = 'draft';

        /* ===============================
         * CREATE APPLICATION
         * =============================== */
        $application = Application::create($validated);
        $application->load('program', 'user');

        /* ==================================================
         * STEP 3 — AUTO GENERATE FEE CHALLAN (PDF)
         * ================================================== */
        try {
            $challanNumber = 'UG-' . now()->format('Ymd') . '-' . rand(1000, 9999);

            $pdf = Pdf::loadView(
                'student.challan.fee-challan',
                [
                    'application' => $application,
                    'amount'      => 2000, // Admission fee
                ]
            )->setPaper('A4', 'portrait');

            $path = "challans/{$challanNumber}.pdf";

            Storage::disk('public')->put($path, $pdf->output());

            $application->update([
                'challan_number' => $challanNumber,
                'challan_pdf'    => $path,
                'challan_status' => 'pending',
            ]);

        } catch (\Throwable $e) {
            Log::error(
                "CHALLAN GENERATION FAILED | App ID {$application->id} | {$e->getMessage()}"
            );
        }

        /* ===============================
         * REDIRECT TO DOCUMENT UPLOAD
         * =============================== */
        return redirect()
            ->route('student.application.documents', $application->id)
            ->with('success', 'Application saved! Download challan and upload paid copy.');
    }

    /* ===============================
     * SHOW APPLICATION
     * =============================== */
    public function show($id)
{
    $application = Application::with(['program', 'documents'])
        ->where('user_id', auth()->id())
        ->findOrFail($id);

    return view('student.application.show', compact('application'));
}

}
