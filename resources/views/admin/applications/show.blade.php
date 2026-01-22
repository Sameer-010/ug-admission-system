@extends('layouts.app')

@section('content')
<div class="bg-light min-vh-100 py-5">
    <div class="container-fluid">
        <!-- Header -->
        <div class="card border-0 shadow-lg rounded-4 mb-4"
             style="background: linear-gradient(135deg, #003d82 0%, #0052a8 100%);">
            <div class="card-body p-5 text-white">
                <h1 class="fw-bold">Application #{{ $application->id }}</h1>
                <p class="lead opacity-75">{{ $application->user->name }} - {{ $application->program->name }}</p>

                <span class="badge 
                    @if($application->status=='submitted') bg-info
                    @elseif($application->status=='under_review') bg-warning text-dark
                    @elseif($application->status=='approved') bg-success
                    @elseif($application->status=='rejected') bg-danger
                    @endif px-4 py-2 rounded-pill">
                    {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                </span>

                <span class="badge bg-primary px-3 py-2 rounded-pill ms-2">
                    <i class="bi bi-calendar"></i> {{ $application->created_at->format('M d, Y') }}
                </span>
            </div>
        </div>

        <!-- Student + Academic + Documents -->
        @include('admin.applications.partials.student-info', ['application' => $application])
        @include('admin.applications.partials.academic-info', ['application' => $application])
        @include('admin.applications.partials.documents', ['application' => $application])

        <!-- Status Update + Interview -->
        <div class="card border-0 shadow-lg rounded-4 mb-4">
            <div class="card-header bg-white p-4">
                <h3 class="fw-bold fs-4"><i class="bi bi-gear me-2 text-primary"></i> Application Actions</h3>
            </div>

            <div class="card-body p-4">

                <form action="{{ route('admin.applications.update-status', $application->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Update Status</label>
                        <select id="statusSelect" name="status" class="form-select rounded-pill" required>
                            <option value="under_review" {{ $application->status=='under_review'?'selected':'' }}>Under Review</option>
                            <option value="approved" {{ $application->status=='approved'?'selected':'' }}>Approve</option>
                            <option value="rejected" {{ $application->status=='rejected'?'selected':'' }}>Reject</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Comments</label>
                        <textarea name="comments" rows="3" class="form-control rounded-3">{{ $application->admin_comments }}</textarea>
                    </div>

                    <!-- INTERVIEW AREA -->
                    <div id="interviewBlock" style="display: none;">
                        <hr>
                        <h5 class="fw-bold mb-3">Interview Schedule</h5>

                        <label class="form-label">Interview Date</label>
                        <input type="date" name="interview_date" value="{{ $application->interview_date }}" class="form-control rounded-pill mb-3">

                        <label class="form-label">Interview Time</label>
                        <input type="time" name="interview_time" value="{{ $application->interview_time }}" class="form-control rounded-pill mb-3">

                        <label class="form-label">Venue</label>
                        <input type="text" name="interview_venue" value="{{ $application->interview_venue }}" class="form-control rounded-pill mb-3">

                        <label class="form-label">Notes</label>
                        <textarea name="interview_notes" class="form-control rounded-3">{{ $application->interview_notes }}</textarea>
                    </div>

                    <button class="btn btn-primary w-100 rounded-pill py-3 fw-bold mt-3">
                        <i class="bi bi-check-circle me-2"></i>Update & Notify Student
                    </button>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const select = document.getElementById('statusSelect');
                        const block = document.getElementById('interviewBlock');

                        const toggle = () => {
                            block.style.display = select.value === 'approved' ? 'block' : 'none';
                        };

                        toggle();
                        select.addEventListener('change', toggle);
                    });
                </script>

            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Back to Applications
            </a>
        </div>
    </div>
</div>
@endsection
