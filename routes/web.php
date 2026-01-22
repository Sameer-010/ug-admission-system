<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ApplicationController as StudentApplicationController;
use App\Http\Controllers\Student\DocumentController;
use App\Http\Controllers\Student\NotificationController as StudentNotificationController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;

use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| LOGOUT FIX (POST ONLY)
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT BASED ON ROLE
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    if (!$user) return redirect()->route('login');

    return match ($user->role) {
        'admin', 'staff' => redirect()->route('admin.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        default => abort(403),
    };
})
->middleware(['auth', 'verified'])
->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| STUDENT ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('student')
    ->middleware(['auth', 'verified'])
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

        // Applications
        Route::get('/application/create', [StudentApplicationController::class, 'create'])->name('application.create');
        Route::post('/application/store', [StudentApplicationController::class, 'store'])->name('application.store');
        Route::get('/application/{id}', [StudentApplicationController::class, 'show'])->name('application.show');

        // Documents
        Route::get('/application/{id}/documents', [DocumentController::class, 'index'])->name('application.documents');
        Route::post('/application/{id}/documents', [DocumentController::class, 'store'])->name('documents.store');
        Route::delete('/application/{id}/documents/{documentId}', [DocumentController::class, 'destroy'])->name('documents.destroy');

        // Submit application
        Route::post('/application/{id}/submit', [DocumentController::class, 'submit'])->name('application.submit');

        // Notifications
        Route::get('/notifications', [StudentNotificationController::class, 'index'])->name('notifications.index');
        Route::post('/notifications/{id}/read', [StudentNotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::post('/notifications/read-all', [StudentNotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    });

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', 'verified'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | IMPORTANT: BULK ROUTES ABOVE DYNAMIC ROUTES
        |--------------------------------------------------------------------------
        */
        Route::post('/applications/bulk-action', [AdminApplicationController::class, 'bulkAction'])
            ->name('applications.bulk-action');

        Route::post('/applications/bulk-interview', [AdminApplicationController::class, 'bulkInterview'])
            ->name('applications.bulk-interview');

        /*
        |--------------------------------------------------------------------------
        | APPLICATION ROUTES
        |--------------------------------------------------------------------------
        */
        Route::get('/applications', [AdminApplicationController::class, 'index'])->name('applications.index');

        Route::post('/applications/{application}/status',
            [AdminApplicationController::class, 'updateStatus']
        )->name('applications.update-status');

        Route::delete('/applications/{application}',
            [AdminApplicationController::class, 'destroy']
        )->name('applications.destroy');

        /*
        |--------------------------------------------------------------------------
        | MUST BE LAST (avoids collision)
        |--------------------------------------------------------------------------
        */
        Route::get('/applications/{application}', [AdminApplicationController::class, 'show'])
            ->name('applications.show');

        /*
        |--------------------------------------------------------------------------
        | STAFF & PROGRAM MANAGEMENT
        |--------------------------------------------------------------------------
        */
        Route::resource('staff', AdminStaffController::class)->except(['show']);
        Route::resource('programs', AdminProgramController::class)->except(['show']);
    });

/*
|--------------------------------------------------------------------------
| GLOBAL NOTIFICATIONS
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index.all');
    Route::get('/notifications/read/{id}', [NotificationController::class, 'markRead'])->name('notifications.read.single');
    Route::get('/notifications/read-all', [NotificationController::class, 'markAll'])->name('notifications.read.all');
});

/*
|--------------------------------------------------------------------------
| TEST EMAIL ROUTE
|--------------------------------------------------------------------------
*/
Route::get('/test-email', function () {
    Mail::raw('This is a test email from Laravel UG Admission.', function ($msg) {
        $msg->to('s22bsit010@student.ug.edu.pk')->subject('Test Email');
    });
    return "Email sent!";
});

/*
|--------------------------------------------------------------------------
| PASSWORD RESET ROUTES (BREEZE)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});
