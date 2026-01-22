@extends('layouts.app')

@section('content')
<div class="bg-light min-vh-100">
    <div class="container-fluid py-4">

        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color:#002855;">
                    <div class="card-body p-4 p-md-5">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3 fs-6">
                                    <i class="bi bi-file-earmark-text me-2"></i> Applications Management
                                </div>
                                <h1 class="display-5 fw-bold text-white mb-3">All Applications</h1>
                                <p class="lead text-white opacity-90 mb-0">
                                    Review, approve, reject or schedule tests & interviews
                                </p>
                            </div>
                            <div class="col-lg-4 text-center d-none d-lg-block">
                                <i class="bi bi-files text-white display-1 opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success rounded-4 shadow-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger rounded-4 shadow-sm">{{ session('error') }}</div>
        @endif

        <!-- Filters -->
        <div class="card border-0 shadow-lg rounded-4 mb-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.applications.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select rounded-pill" onchange="this.form.submit()">
                                <option value="">All Status</option>
                                <option value="submitted" {{ request('status')=='submitted'?'selected':'' }}>Submitted</option>
                                <option value="under_review" {{ request('status')=='under_review'?'selected':'' }}>Under Review</option>
                                <option value="approved" {{ request('status')=='approved'?'selected':'' }}>Approved</option>
                                <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Program</label>
                            <select name="program" class="form-select rounded-pill" onchange="this.form.submit()">
                                <option value="">All Programs</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ request('program') == $program->id ? 'selected' : '' }}>
                                        {{ $program->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Search</label>
                            <div class="input-group">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control rounded-pill" placeholder="Search student...">
                                <button class="btn btn-primary rounded-pill ms-2 px-4"><i class="bi bi-search"></i></button>
                            </div>
                        </div>

                        <div class="col-md-2 text-end">
                            <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-primary rounded-pill w-100">
                                <i class="bi bi-arrow-clockwise me-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Application Table -->
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center p-4">
                <h3 class="fw-bold fs-4 text-primary">
                    <i class="bi bi-list-check me-2"></i> Applications
                    <span class="badge bg-primary ms-2">{{ $applications->total() }}</span>
                </h3>

                <div class="d-flex gap-2 align-items-center">
                    <!-- BULK INTERVIEW -->
                    <button id="bulkInterviewBtn" class="btn btn-success rounded-pill" disabled data-bs-toggle="modal" data-bs-target="#bulkInterviewModal">
                        <i class="bi bi-calendar-event me-2"></i>Test & Interview
                    </button>

                    <!-- BULK ACTION DROPDOWN -->
                    <div class="dropdown">
                        <button class="btn btn-primary rounded-pill dropdown-toggle" id="bulkActionButton" disabled data-bs-toggle="dropdown">
                            <i class="bi bi-gear me-2"></i>Bulk Actions
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item bulk-option" data-action="approve"><i class="bi bi-check-circle text-success me-2"></i>Approve</a></li>
                            <li><a class="dropdown-item bulk-option" data-action="reject"><i class="bi bi-x-circle text-danger me-2"></i>Reject</a></li>
                            <li><a class="dropdown-item bulk-option" data-action="under_review"><i class="bi bi-hourglass-split text-warning me-2"></i>Under Review</a></li>
                        </ul>
                    </div>

                    <form id="bulkActionForm" action="{{ route('admin.applications.bulk-action') }}" method="POST" class="d-none">
                        @csrf
                        <input type="hidden" name="action" id="bulkAction">
                        <input type="hidden" name="application_ids" id="bulkApplicationIds">
                    </form>
                </div>
            </div>

            <div class="card-body p-0">
                @if($applications->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-1 text-muted"></i>
                        <h5 class="fw-bold mt-2">No Applications Found</h5>
                    </div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="text-white" style="background:#002855;">
                            <tr>
                                <th class="text-center"><input type="checkbox" id="selectAll"></th>
                                <th>ID</th>
                                <th>Student</th>
                                <th>Program</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $app)
                            <tr>
                                <td class="text-center"><input type="checkbox" class="application-checkbox" value="{{ $app->id }}"></td>
                                <td><strong>#{{ $app->id }}</strong></td>
                                <td><strong>{{ $app->user->name }}</strong><br><small class="text-muted">{{ $app->user->email }}</small></td>
                                <td><strong>{{ $app->program->code }}</strong><br><small class="text-muted">{{ $app->program->name }}</small></td>
                                <td>
                                    @if($app->status == 'approved') <span class="badge bg-success">Approved</span>
                                    @elseif($app->status == 'rejected') <span class="badge bg-danger">Rejected</span>
                                    @elseif($app->status == 'under_review') <span class="badge bg-warning text-dark">Under Review</span>
                                    @else <span class="badge bg-info text-dark">Submitted</span>
                                    @endif
                                </td>
                                <td>{{ $app->created_at->format('M d, Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.applications.show', $app->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="bi bi-eye me-2"></i>View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-3">{{ $applications->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- BULK Test & Interview Modal -->
<div class="modal fade" id="bulkInterviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="bi bi-calendar-event me-2 text-primary"></i>Send Test & Interview Slip</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="bulkInterviewForm" action="{{ route('admin.applications.bulk-interview') }}" method="POST">
                @csrf
                <input type="hidden" name="application_ids" id="bulkInterviewIds">

                <div class="modal-body">
                    <div class="alert alert-info">Only <strong>approved</strong> applicants will receive the slip. Non-approved selections are skipped.</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Test Date</label>
                            <input type="date" name="test_date" class="form-control rounded-pill" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Test Time</label>
                            <input type="time" name="test_time" class="form-control rounded-pill" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Test Venue</label>
                            <input type="text" name="test_venue" class="form-control rounded-pill" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Interview Date</label>
                            <input type="date" name="interview_date" class="form-control rounded-pill" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Interview Time</label>
                            <input type="time" name="interview_time" class="form-control rounded-pill" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Interview Venue</label>
                            <input type="text" name="interview_venue" class="form-control rounded-pill" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold">Notes (optional)</label>
                            <textarea name="notes" class="form-control rounded-3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success rounded-pill px-4"><i class="bi bi-send me-2"></i>Send Slip</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const selectAll = document.getElementById("selectAll");
    const checkboxes = document.querySelectorAll(".application-checkbox");
    const bulkActionButton = document.getElementById("bulkActionButton");
    const bulkInterviewBtn = document.getElementById("bulkInterviewBtn");
    const bulkIdsInput = document.getElementById("bulkApplicationIds");
    const bulkInterviewIdsInput = document.getElementById("bulkInterviewIds");
    const bulkInterviewModal = document.getElementById('bulkInterviewModal');

    function updateSelection() {
        const selected = [...checkboxes].filter(c => c.checked).map(c => c.value);
        bulkIdsInput.value = JSON.stringify(selected);
        bulkInterviewIdsInput.value = JSON.stringify(selected);

        const hasSelection = selected.length > 0;
        bulkActionButton.disabled = !hasSelection;
        bulkInterviewBtn.disabled = !hasSelection;

        bulkActionButton.innerHTML = hasSelection
            ? `<i class="bi bi-gear me-2"></i>Bulk Actions (${selected.length})`
            : `<i class="bi bi-gear me-2"></i>Bulk Actions`;
    }

    selectAll?.addEventListener("change", function () {
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateSelection();
    });

    checkboxes.forEach(cb => cb.addEventListener("change", updateSelection));

    document.querySelectorAll(".bulk-option").forEach(item => {
        item.addEventListener("click", () => {
            const action = item.dataset.action;
            const selected = JSON.parse(bulkIdsInput.value || "[]");
            if (selected.length === 0) { alert("Select at least one application."); return; }
            if (confirm(`Are you sure you want to '${action}' ${selected.length} application(s)?`)) {
                document.getElementById("bulkAction").value = action;
                document.getElementById("bulkActionForm").submit();
            }
        });
    });

    if (bulkInterviewModal) {
        bulkInterviewModal.addEventListener('show.bs.modal', function () {
            const selected = [...checkboxes].filter(c => c.checked).map(c => c.value);
            bulkInterviewIdsInput.value = JSON.stringify(selected);
            if (selected.length === 0) {
                alert('Select at least one application.');
                var modalInstance = bootstrap.Modal.getInstance(bulkInterviewModal);
                modalInstance.hide();
            }
        });
    }
});
</script>
@endpush
