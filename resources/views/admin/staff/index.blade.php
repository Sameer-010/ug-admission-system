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
                                    <i class="bi bi-people me-2"></i>Staff Management
                                </div>
                                <h1 class="display-5 display-md-4 fw-bold text-white mb-3">Staff Members</h1>
                                <p class="lead text-white opacity-90 mb-4 fs-5 fs-md-4">Manage staff accounts and permissions</p>
                            </div>
                            <div class="col-lg-4 text-center d-none d-lg-block">
                                <div class="bg-white bg-opacity-10 rounded-circle p-3 p-md-4 d-inline-block">
                                    <i class="bi bi-person-gear text-white" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-3 fs-4"></i>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">Success!</h6>
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">Error!</h6>
                            <p class="mb-0">{{ session('error') }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.staff.index') }}" method="GET">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 rounded-pill">
                                            <i class="bi bi-search text-muted"></i>
                                        </span>
                                        <input type="text" name="search" class="form-control rounded-pill" 
                                               placeholder="Search staff by name, email, or phone..." 
                                               value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-primary rounded-pill ms-2">
                                            <i class="bi bi-search me-2"></i>Search
                                        </button>
                                        @if(request('search'))
                                            <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-secondary rounded-pill ms-2">
                                                <i class="bi bi-x-circle me-2"></i>Clear
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="{{ route('admin.staff.create') }}" class="btn btn-primary rounded-pill px-4 py-2">
                                        <i class="bi bi-plus-circle me-2"></i>Add New Staff
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Staff List -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header bg-white border-0 p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="fw-bold mb-0 fs-4">
                                <i class="bi bi-person-badge me-3 text-primary"></i>Staff Members 
                                <span class="badge bg-primary rounded-pill ms-2">{{ $staff->count() }}</span>
                            </h3>
                            <div class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                @if(request('search'))
                                    Found {{ $staff->count() }} staff members matching "{{ request('search') }}"
                                @else
                                    Showing {{ $staff->count() }} staff members
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if($staff->isEmpty())
                            <div class="text-center py-5">
                                <div class="bg-light rounded-circle p-4 p-md-5 d-inline-flex mb-3 mb-md-4">
                                    <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
                                </div>
                                <h4 class="fw-bold text-muted mt-4">
                                    @if(request('search'))
                                        No Staff Members Found
                                    @else
                                        No Staff Members
                                    @endif
                                </h4>
                                <p class="text-muted mb-4">
                                    @if(request('search'))
                                        No staff members found matching "{{ request('search') }}"
                                    @else
                                        Get started by adding your first staff member to help manage admissions.
                                    @endif
                                </p>
                                <a href="{{ route('admin.staff.create') }}" class="btn btn-primary btn-lg rounded-pill px-4 py-2">
                                    <i class="bi bi-plus-circle me-2"></i>Add First Staff
                                </a>
                                @if(request('search'))
                                    <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4 py-2 ms-2">
                                        <i class="bi bi-arrow-left me-2"></i>View All Staff
                                    </a>
                                @endif
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-4 py-3 fw-bold">Staff Member</th>
                                            <th class="px-4 py-3 fw-bold">Contact Info</th>
                                            <th class="px-4 py-3 fw-bold">Role</th>
                                            <th class="px-4 py-3 fw-bold">Status</th>
                                            <th class="px-4 py-3 fw-bold">Joined Date</th>
                                            <th class="px-4 py-3 fw-bold text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($staff as $staffMember)
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                        <i class="bi bi-person-fill text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $staffMember->name }}</div>
                                                        <small class="text-muted">ID: {{ $staffMember->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="fw-bold text-dark">{{ $staffMember->email }}</div>
                                                <small class="text-muted">
                                                    <i class="bi bi-telephone me-1"></i>
                                                    {{ $staffMember->phone ?? 'Not provided' }}
                                                </small>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="badge bg-success rounded-pill px-3 py-2">
                                                    <i class="bi bi-person-check me-1"></i>Staff
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="badge bg-success rounded-pill px-3 py-2">
                                                    <i class="bi bi-check-circle me-1"></i>Active
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="fw-bold">{{ $staffMember->created_at->format('M d, Y') }}</div>
                                                <small class="text-muted">{{ $staffMember->created_at->diffForHumans() }}</small>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('admin.staff.edit', $staffMember->id) }}" 
                                                       class="btn btn-outline-primary btn-sm rounded-pill px-3" 
                                                       data-bs-toggle="tooltip" title="Edit Staff">
                                                        <i class="bi bi-pencil me-2"></i>Edit
                                                    </a>
                                                    @if($staffMember->id !== auth()->id())
                                                    <form action="{{ route('admin.staff.destroy', $staffMember->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3" 
                                                                data-bs-toggle="tooltip" title="Delete Staff"
                                                                onclick="return confirm('Are you sure you want to delete this staff member?')">
                                                            <i class="bi bi-trash me-2"></i>Delete
                                                        </button>
                                                    </form>
                                                    @else
                                                    <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" disabled
                                                            data-bs-toggle="tooltip" title="Cannot delete your own account">
                                                        <i class="bi bi-trash me-2"></i>Delete
                                                    </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Quick Stats Footer -->
                            <div class="card-footer bg-light border-0 p-4">
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="fw-bold text-primary fs-4">{{ $staff->count() }}</div>
                                        <small class="text-muted">Total Staff</small>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="fw-bold text-success fs-4">{{ $staff->count() }}</div>
                                        <small class="text-muted">Active</small>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="fw-bold text-warning fs-4">0</div>
                                        <small class="text-muted">Pending</small>
                                    </div>
                                    <div class="col-md-3">
                                        @php
                                            $thisMonthCount = $staff->filter(function($member) {
                                                return $member->created_at->format('Y-m') === now()->format('Y-m');
                                            })->count();
                                        @endphp
                                        <div class="fw-bold text-info fs-4">{{ $thisMonthCount }}</div>
                                        <small class="text-muted">This Month</small>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Help Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="fw-bold mb-2">Need help managing staff?</h5>
                                <p class="text-muted mb-0">Staff members can review applications and manage programs but cannot create other staff accounts.</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <button class="btn btn-outline-primary rounded-pill">
                                    <i class="bi bi-question-circle me-2"></i>View Help Guide
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Initialize tooltips -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
});
</script>
@endsection