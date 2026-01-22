@extends('layouts.app')

@section('content')
<div class="bg-light min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- Header -->
                <div class="card border-0 shadow-lg rounded-4 mb-4"
                     style="background: linear-gradient(135deg, #003d82 0%, #0052a8 100%);">
                    <div class="card-body p-5 text-white">
                        <h1 class="fw-bold mb-2">Application #{{ $application->id }}</h1>
                        <p class="lead opacity-75">{{ $application->program->name }}</p>

                        <span class="badge 
                            @if($application->status == 'submitted') bg-info
                            @elseif($application->status == 'under_review') bg-warning text-dark
                            @elseif($application->status == 'approved') bg-success
                            @elseif($application->status == 'rejected') bg-danger
                            @endif px-3 py-2 rounded-pill fs-6">
                            {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                        </span>

                        <span class="badge bg-primary rounded-pill px-3 py-2 fs-6 ms-2">
                            <i class="bi bi-calendar"></i> {{ $application->created_at->format('M d, Y') }}
                        </span>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="card border-0 shadow-lg rounded-4 mb-4">
                    <div class="card-header bg-white p-4">
                        <h3 class="fw-bold fs-4"><i class="bi bi-person-badge me-2 text-primary"></i>Personal Information</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="text-muted small">Name</label>
                                <p class="fw-bold">{{ $application->user->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Email</label>
                                <p class="fw-bold">{{ $application->user->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Father's Name</label>
                                <p class="fw-bold">{{ $application->father_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Father CNIC</label>
                                <p class="fw-bold">{{ $application->father_cnic }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Date of Birth</label>
                                <p class="fw-bold">{{ $application->date_of_birth->format('M d, Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Gender</label>
                                <p class="fw-bold text-capitalize">{{ $application->gender }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Domicile</label>
                                <p class="fw-bold">{{ $application->domicile }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Academic Info -->
                @include('student.application.partials.academic-info', ['application' => $application])

                <!-- Documents -->
                @include('student.application.partials.documents', ['application' => $application])

                <!-- Admin Comments -->
                @if($application->admin_comments)
                <div class="card border-warning shadow-lg rounded-4 mb-4 border-start border-4 border-warning">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3"><i class="bi bi-chat-left-text text-warning me-2"></i>Admin Comments</h4>
                        <div class="bg-light p-3 rounded">
                            {{ $application->admin_comments }}
                        </div>
                    </div>
                </div>
                @endif

                <!-- Interview Details (only if approved) -->
                @if($application->status === 'approved' && $application->interview_date)
                <div class="card border-success shadow-lg rounded-4 mb-4 border-start border-4 border-success">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3 text-success">
                            <i class="bi bi-calendar-check me-2"></i> Interview Schedule
                        </h4>

                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($application->interview_date)->format('M d, Y') }}</p>
                        <p><strong>Time:</strong> {{ $application->interview_time }}</p>
                        <p><strong>Venue:</strong> {{ $application->interview_venue }}</p>

                        @if($application->interview_notes)
                            <p><strong>Notes:</strong> {{ $application->interview_notes }}</p>
                        @endif
                    </div>
                </div>
                @endif

                <div class="text-center">
                    <a href="{{ route('student.dashboard') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
