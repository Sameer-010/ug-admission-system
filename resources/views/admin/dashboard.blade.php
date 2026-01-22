@extends('layouts.app')

@section('content')


<div class="min-vh-100" style="background: linear-gradient(180deg, #f8f9fa 0%, #eaf1f9 100%);">

    <div class="container-fluid px-4 py-4">
        <!-- Header -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-5"
             style="background: linear-gradient(135deg, #003366 0%, #004b99 100%);">

            <div class="card-body p-5">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="badge bg-warning text-dark px-4 py-2 rounded-pill mb-3 fs-6 shadow-sm">
                            <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                        </div>
                        <h1 class="display-5 fw-bold text-white mb-3">
                            Welcome, {{ auth()->user()->name }}!
                        </h1>
                        <p class="lead text-white-50 fs-5">
                            Manage admissions, review applications, and oversee system operations efficiently.
                        </p>
                    </div>
                    <div class="col-lg-4 text-center d-none d-lg-block">
                        <div class="bg-white bg-opacity-10 rounded-circle p-4 d-inline-block">
                            <i class="bi bi-shield-check text-white" style="font-size: 8rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row g-4 mb-5">
            @php
                $cards = [
                    ['color' => 'primary', 'icon' => 'file-earmark-text-fill', 'label' => 'Total Applications', 'value' => $stats['total_applications'] ?? 0],
                    ['color' => 'warning', 'icon' => 'clock-fill', 'label' => 'Pending Review', 'value' => $stats['pending'] ?? 0],
                    ['color' => 'success', 'icon' => 'check-circle-fill', 'label' => 'Approved', 'value' => $stats['approved'] ?? 0],
                    ['color' => 'info', 'icon' => 'mortarboard-fill', 'label' => 'Active Programs', 'value' => $stats['total_programs'] ?? 0],
                ];
            @endphp

            @foreach($cards as $card)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card border-0 shadow-lg rounded-4 h-100 border-start border-{{ $card['color'] }} border-5">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-{{ $card['color'] }} bg-opacity-10 rounded-3 p-3 me-3">
                                    <i class="bi bi-{{ $card['icon'] }} text-{{ $card['color'] }} fs-2"></i>
                                </div>
                                <div>
                                    <h2 class="fw-bold text-{{ $card['color'] }} mb-1 display-6">{{ $card['value'] }}</h2>
                                    <p class="text-muted mb-0 fw-semibold">{{ $card['label'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Recent Applications + Program Stats -->
        <div class="row g-4 mb-5">
            <!-- Recent Applications -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4 h-100">
                    <div class="card-header bg-primary text-white border-0 p-4 rounded-top-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="fw-bold mb-0 fs-4">
                                <i class="bi bi-clock-history me-2"></i>Recent Applications
                            </h3>
                            <a href="{{ route('admin.applications.index') }}" class="btn btn-light btn-sm rounded-pill px-3 fw-semibold">
                                <i class="bi bi-arrow-right me-1"></i>View All
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if($recentApplications->isEmpty())
                            <div class="text-center py-5">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-3 mb-0">No applications yet</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-4 py-3">Student</th>
                                            <th class="px-4 py-3">Program</th>
                                            <th class="px-4 py-3">Status</th>
                                            <th class="px-4 py-3">Date</th>
                                            <th class="px-4 py-3 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentApplications as $application)
                                            @php
                                                $statuses = [
                                                    'submitted' => ['info', 'send', 'Submitted'],
                                                    'under_review' => ['warning', 'hourglass-split', 'Under Review'],
                                                    'approved' => ['success', 'check-circle', 'Approved'],
                                                    'rejected' => ['danger', 'x-circle', 'Rejected'],
                                                    'draft' => ['secondary', 'pencil', 'Draft'],
                                                ];
                                                $statusKey = $application->status;
                                                $s = $statuses[$statusKey] ?? ['secondary', 'question-circle', ucfirst($statusKey)];
                                            @endphp
                                            <tr>
                                                <td class="px-4 py-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="bi bi-person-fill text-primary"></i>
                                                        </div>
                                                        <div>
                                                            <div class="fw-bold">{{ $application->user->name }}</div>
                                                            <small class="text-muted">{{ $application->user->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="fw-bold">{{ $application->program->code }}</div>
                                                    <small class="text-muted">{{ $application->program->name }}</small>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <span class="badge bg-{{ $s[0] }} rounded-pill px-3 py-2">
                                                        <i class="bi bi-{{ $s[1] }} me-1"></i>{{ $s[2] }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3">{{ $application->created_at->format('M d, Y') }}</td>
                                                <td class="px-4 py-3 text-center">
                                                    <a href="{{ route('admin.applications.show', $application->id) }}"
                                                       class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                        <i class="bi bi-eye-fill me-1"></i>Review
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Program Statistics -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg rounded-4 h-100">
                    <div class="card-header bg-primary text-white border-0 p-4 rounded-top-4">
                        <h3 class="fw-bold mb-0 fs-4">
                            <i class="bi bi-bar-chart-fill me-2"></i>Program Statistics
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        @if($programStats->count() > 0)
                            @php
                                $totalProgramApplications = $programStats->sum('applications_count');
                                $maxApplications = $programStats->max('applications_count');
                            @endphp
                            @foreach($programStats as $program)
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-bold text-dark">{{ $program->code }}</span>
                                        <span class="badge bg-primary">{{ $program->applications_count }}</span>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        @php $percentage = $maxApplications > 0 ? ($program->applications_count / $maxApplications) * 100 : 0; @endphp
                                        <div class="progress-bar bg-primary" style="width: {{ $percentage }}%;"></div>
                                    </div>
                                    <small class="text-muted">{{ $program->name }}</small>
                                </div>
                            @endforeach
                            <div class="border-top pt-3 mt-3">
                                <small class="text-muted fw-semibold">
                                    Total: {{ $totalProgramApplications }} applications across {{ $programStats->count() }} programs
                                </small>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-journal-text text-muted mb-3" style="font-size: 3rem;"></i>
                                <p class="text-muted mb-2">No applications received yet</p>
                                <small class="text-muted">Program statistics will appear here when students start applying</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-primary text-white border-0 p-4 rounded-top-4">
                <h3 class="fw-bold mb-0 fs-4">
                    <i class="bi bi-lightning-fill me-2"></i>Quick Actions
                </h3>
            </div>
            <div class="card-body p-4">
                @php
                    $actions = [
                        ['route' => 'admin.applications.index', 'color' => 'primary', 'icon' => 'file-earmark-text-fill', 'title' => 'Review Applications', 'desc' => 'Manage all applications'],
                        ['route' => 'admin.staff.index', 'color' => 'info', 'icon' => 'people-fill', 'title' => 'Manage Staff', 'desc' => 'Add/Edit staff members'],
                        ['route' => 'admin.programs.index', 'color' => 'success', 'icon' => 'mortarboard-fill', 'title' => 'Programs', 'desc' => 'Manage academic programs'],
                        ['route' => '#', 'color' => 'warning', 'icon' => 'graph-up-arrow', 'title' => 'Reports', 'desc' => 'View system reports'],
                    ];
                @endphp

                <div class="row g-3">
                    @foreach($actions as $a)
                        <div class="col-md-3 col-6">
                            @php
                                // Safe route handling — prevents RouteNotFoundException
                                $link = $a['route'] === '#' ? '#' : (Route::has($a['route']) ? route($a['route']) : '#');
                            @endphp
                            <a href="{{ $link }}" class="card border-0 shadow-sm rounded-4 text-decoration-none h-100">
                                <div class="card-body text-center p-4">
                                    <div class="bg-{{ $a['color'] }} bg-opacity-10 rounded-3 p-3 mb-3 d-inline-flex">
                                        <i class="bi bi-{{ $a['icon'] }} text-{{ $a['color'] }} fs-2"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1">{{ $a['title'] }}</h6>
                                    <small class="text-muted">{{ $a['desc'] }}</small>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
