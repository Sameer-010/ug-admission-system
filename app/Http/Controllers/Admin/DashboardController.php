<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use App\Models\Program;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is admin or staff
        if (!in_array(auth()->user()->role, ['admin', 'staff'])) {
            abort(403, 'Unauthorized access. Admin or Staff role required.');
        }

        // Use actual database status values from your applications
        $stats = [
            'total_applications' => Application::count(),
            'pending' => Application::where('status', 'submitted')->count(), // Your DB uses 'submitted'
            'under_review' => Application::where('status', 'under_review')->count(),
            'approved' => Application::where('status', 'approved')->count(),
            'rejected' => Application::where('status', 'rejected')->count(),
            'total_students' => User::where('role', 'student')->count(),
            'total_staff' => User::where('role', 'staff')->count(),
            'total_programs' => Program::count(),
        ];

        $recentApplications = Application::with(['user', 'program'])
            ->latest()
            ->take(5)
            ->get();

        // Program statistics - count ALL applications for each program
        $programStats = Program::withCount(['applications'])
            ->orderBy('applications_count', 'desc')
            ->get();

        // Applications by status using actual DB values
        $applicationsByStatus = [
            'submitted' => Application::where('status', 'submitted')->count(), // Your DB uses 'submitted'
            'under_review' => Application::where('status', 'under_review')->count(),
            'approved' => Application::where('status', 'approved')->count(),
            'rejected' => Application::where('status', 'rejected')->count(),
            'draft' => Application::where('status', 'draft')->count(),
        ];

        return view('admin.dashboard', compact('stats', 'recentApplications', 'programStats', 'applicationsByStatus'));
    }
}