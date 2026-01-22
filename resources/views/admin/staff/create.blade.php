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
                                    <i class="bi bi-person-plus me-2"></i>Add New Staff
                                </div>
                                <h1 class="display-5 display-md-4 fw-bold text-white mb-3">Create Staff Account</h1>
                                <p class="lead text-white opacity-90 mb-4 fs-5 fs-md-4">Add a new staff member to the admission system</p>
                            </div>
                            <div class="col-lg-4 text-center d-none d-lg-block">
                                <div class="bg-white bg-opacity-10 rounded-circle p-3 p-md-4 d-inline-block">
                                    <i class="bi bi-person-add text-white" style="font-size: 8rem;"></i>
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
                            <i class="bi bi-person-vcard me-3 text-primary"></i>Staff Information
                        </h3>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.staff.store') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <!-- Personal Information -->
                                <div class="col-12">
                                    <h5 class="fw-bold mb-3 text-primary">
                                        <i class="bi bi-person-circle me-2"></i>Personal Information
                                    </h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-pill">
                                            <i class="bi bi-person text-muted"></i>
                                        </span>
                                        <input type="text" name="name" class="form-control rounded-pill" placeholder="Enter full name" required value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-pill">
                                            <i class="bi bi-phone text-muted"></i>
                                        </span>
                                        <input type="tel" name="phone" class="form-control rounded-pill" placeholder="Enter phone number" required value="{{ old('phone') }}">
                                    </div>
                                    @error('phone')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Account Information -->
                                <div class="col-12 mt-4">
                                    <h5 class="fw-bold mb-3 text-primary">
                                        <i class="bi bi-shield-lock me-2"></i>Account Information
                                    </h5>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-pill">
                                            <i class="bi bi-envelope text-muted"></i>
                                        </span>
                                        <input type="email" name="email" class="form-control rounded-pill" placeholder="Enter email address" required value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-pill">
                                            <i class="bi bi-key text-muted"></i>
                                        </span>
                                        <input type="password" name="password" class="form-control rounded-pill" placeholder="Create password" required>
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Confirm Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-pill">
                                            <i class="bi bi-key-fill text-muted"></i>
                                        </span>
                                        <input type="password" name="password_confirmation" class="form-control rounded-pill" placeholder="Confirm password" required>
                                    </div>
                                </div>

                                <!-- Role Information -->
                                <div class="col-12 mt-4">
                                    <h5 class="fw-bold mb-3 text-primary">
                                        <i class="bi bi-person-gear me-2"></i>Role Information
                                    </h5>
                                </div>

                                <div class="col-12">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-3">
                                                    <i class="bi bi-person-check text-primary fs-4"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-1">Staff Role</h6>
                                                    <p class="text-muted mb-0">This user will have access to review applications and manage programs.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="col-12 mt-4 pt-4 border-top">
                                    <div class="d-flex gap-3 justify-content-end">
                                        <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                            <i class="bi bi-arrow-left me-2"></i>Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                                            <i class="bi bi-person-add me-2"></i>Create Staff Account
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