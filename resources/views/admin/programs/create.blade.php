@extends('layouts.app')

@section('content')
<div class="bg-light min-vh-100">
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #003d82 0%, #0052a8 100%);">
                    <div class="card-body p-4 p-md-5">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="badge bg-warning text-dark px-3 px-md-4 py-2 rounded-pill mb-3 fs-6">
                                    <i class="bi bi-plus-circle me-2"></i>Create Program
                                </div>
                                <h1 class="display-5 display-md-4 fw-bold text-white mb-3">Add New Program</h1>
                                <p class="lead text-white opacity-90 mb-4 fs-5 fs-md-4">Create a new academic program for student admissions</p>
                            </div>
                            <div class="col-lg-4 text-center d-none d-lg-block">
                                <div class="bg-white bg-opacity-10 rounded-circle p-3 p-md-4 d-inline-block">
                                    <i class="bi bi-journal-plus text-white" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header bg-white border-0 p-4">
                        <h3 class="fw-bold mb-0 fs-4">
                            <i class="bi bi-journal-text me-3 text-primary"></i>Program Details
                        </h3>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.programs.store') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <!-- Basic Information -->
                                <div class="col-12">
                                    <h5 class="fw-bold mb-3 text-primary">
                                        <i class="bi bi-info-circle me-2"></i>Basic Information
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Program Code <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-pill">
                                            <i class="bi bi-code-slash text-muted"></i>
                                        </span>
                                        <input type="text" name="code" class="form-control rounded-pill" placeholder="e.g., BSIT" required>
                                    </div>
                                    <small class="text-muted">Unique code for the program (e.g., BSIT, BSCS)</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Program Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-pill">
                                            <i class="bi bi-mortarboard text-muted"></i>
                                        </span>
                                        <input type="text" name="name" class="form-control rounded-pill" placeholder="e.g., BS Information Technology" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="description" class="form-control rounded-3" rows="4" placeholder="Enter program description..."></textarea>
                                </div>

                                <!-- Program Details -->
                                <div class="col-12 mt-4">
                                    <h5 class="fw-bold mb-3 text-primary">
                                        <i class="bi bi-gear me-2"></i>Program Details
                                    </h5>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Duration (Years) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-pill">
                                            <i class="bi bi-clock text-muted"></i>
                                        </span>
                                        <select name="duration_years" class="form-select rounded-pill" required>
                                            <option value="2">2 Years</option>
                                            <option value="3">3 Years</option>
                                            <option value="4" selected>4 Years</option>
                                            <option value="5">5 Years</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Total Seats <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-pill">
                                            <i class="bi bi-people text-muted"></i>
                                        </span>
                                        <input type="number" name="total_seats" class="form-control rounded-pill" placeholder="e.g., 50" min="1" required>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-12 mt-4">
                                    <h5 class="fw-bold mb-3 text-primary">
                                        <i class="bi bi-toggle-on me-2"></i>Program Status
                                    </h5>
                                </div>

                                <div class="col-12">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                                                <label class="form-check-label fw-bold" for="is_active">
                                                    Accepting Applications
                                                </label>
                                                <p class="text-muted mb-0 small">When enabled, students can apply to this program.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="col-12 mt-4 pt-4 border-top">
                                    <div class="d-flex gap-3 justify-content-end">
                                        <a href="{{ route('admin.programs.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                            <i class="bi bi-arrow-left me-2"></i>Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                                            <i class="bi bi-plus-circle me-2"></i>Create Program
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection