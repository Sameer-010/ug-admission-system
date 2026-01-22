<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Program;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | USER APPLICATIONS (ELOQUENT MODELS)
        |--------------------------------------------------------------------------
        | IMPORTANT:
        | Do NOT convert to array.
        | Blade expects objects like $application->id
        */
        $applications = Application::where('user_id', $user->id)
            ->with('program')
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | AVAILABLE PROGRAMS
        |--------------------------------------------------------------------------
        */
        $programs = Program::where('is_active', true)->get();

        return view('student.dashboard', compact('applications', 'programs'));
    }
}
