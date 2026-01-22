

<?php $__env->startSection('content'); ?>
<div class="bg-light min-vh-100">
    <div class="container py-5">
        <div class="row g-4">

            <!-- Welcome Banner -->
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-5 overflow-hidden"
                     style="background: linear-gradient(135deg, #003d82 0%, #0052a8 100%);">
                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <span class="badge bg-warning text-dark px-4 py-2 rounded-pill mb-3">
                                    Student Portal
                                </span>
                                <h1 class="fw-bold text-white mb-2">
                                    Welcome, <?php echo e(auth()->user()->name); ?>!
                                </h1>
                                <p class="text-white opacity-90">
                                    Track your applications and manage your admission process
                                </p>

                                <?php if($applications->isEmpty()): ?>
                                    <a href="<?php echo e(route('student.application.create')); ?>"
                                       class="btn btn-warning btn-lg rounded-pill">
                                        Start Application
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-4 text-center d-none d-lg-block">
                                <i class="bi bi-person-circle text-white" style="font-size: 7rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="col-md-4">
                <div class="card shadow border-0 rounded-4 text-center p-4">
                    <h2 class="text-primary fw-bold"><?php echo e($applications->count()); ?></h2>
                    <p>Total Applications</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-0 rounded-4 text-center p-4">
                    <h2 class="text-warning fw-bold">
                        <?php echo e($applications->where('status','under_review')->count()); ?>

                    </h2>
                    <p>Under Review</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-0 rounded-4 text-center p-4">
                    <h2 class="text-success fw-bold">
                        <?php echo e($applications->where('status','approved')->count()); ?>

                    </h2>
                    <p>Approved</p>
                </div>
            </div>

            <!-- Applications Table -->
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-5">
                    <div class="card-header bg-white p-4">
                        <h4 class="fw-bold mb-0">My Applications</h4>
                    </div>

                    <div class="card-body p-4">
                        <?php if($applications->isEmpty()): ?>
                            <div class="text-center py-5">
                                <p class="text-muted">No applications yet.</p>
                            </div>
                        <?php else: ?>
                        <div class="table-responsive">
                            <table class="table align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Program</th>
                                        <th>Status</th>
                                        <th>Applied</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><strong>#<?php echo e($application->id); ?></strong></td>

                                        <td>
                                            <?php echo e($application->program->name); ?><br>
                                            <small class="text-muted"><?php echo e($application->program->code); ?></small>
                                        </td>

                                        <!-- Application Status -->
                                        <td>
                                            <?php if($application->status === 'draft'): ?>
                                                <span class="badge bg-secondary">Draft</span>
                                            <?php elseif($application->status === 'submitted'): ?>
                                                <span class="badge bg-info">Submitted</span>
                                            <?php elseif($application->status === 'under_review'): ?>
                                                <span class="badge bg-warning">Under Review</span>
                                            <?php elseif($application->status === 'approved'): ?>
                                                <span class="badge bg-success">Approved</span>
                                            <?php elseif($application->status === 'rejected'): ?>
                                                <span class="badge bg-danger">Rejected</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php echo e($application->created_at->format('M d, Y')); ?>

                                        </td>

                                        <!-- Actions -->
                                        <td class="text-center">
                                            <!-- View -->
                                            <a href="<?php echo e(route('student.application.show', $application->id)); ?>"
                                               class="btn btn-sm btn-primary mb-1">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <!-- Download Challan (KEPT) -->
                                            <?php if($application->challan_pdf): ?>
                                                <a href="<?php echo e(asset('storage/'.$application->challan_pdf)); ?>"
                                                   target="_blank"
                                                   class="btn btn-sm btn-outline-secondary mb-1">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                            <?php endif; ?>

                                            <!-- Upload Paid Challan -->
                                            <?php if($application->challan_status === 'pending'): ?>
                                                <a href="<?php echo e(route('student.application.documents', $application->id)); ?>"
                                                   class="btn btn-sm btn-warning mb-1">
                                                    <i class="bi bi-upload"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Available Programs -->
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-5">
                    <div class="card-header bg-white border-0 p-4 p-md-5">
                        <h3 class="fw-bold mb-0 fs-3">
                            <i class="bi bi-mortarboard-fill me-3 text-primary"></i>Available Programs
                        </h3>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <div class="row g-4">
                            <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="card border-0 shadow-lg h-100 rounded-4 overflow-hidden">

                                    <?php if($index % 3 == 0): ?>
                                        <div class="card-header text-white p-4"
                                             style="background: linear-gradient(135deg, #003d82 0%, #0052a8 100%);">
                                    <?php elseif($index % 3 == 1): ?>
                                        <div class="card-header bg-success text-white p-4">
                                    <?php else: ?>
                                        <div class="card-header bg-warning text-dark p-4">
                                    <?php endif; ?>

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <h5 class="fw-bold mb-1"><?php echo e($program->code); ?></h5>
                                                <p class="mb-0 opacity-75 small"><?php echo e($program->name); ?></p>
                                            </div>
                                            <div class="bg-white bg-opacity-25 rounded-3 p-2">
                                                <i class="bi bi-mortarboard-fill fs-4"></i>
                                            </div>
                                        </div>

                                        <div class="progress bg-white bg-opacity-25" style="height:6px;">
                                            <div class="progress-bar bg-white" style="width:40%"></div>
                                        </div>

                                        <p class="small mt-2 mb-0 opacity-75">
                                            <i class="bi bi-people-fill me-2"></i>Limited seats available
                                        </p>
                                    </div>

                                    <div class="card-body p-4">
                                        <ul class="list-unstyled mb-4">
                                            <li class="mb-2">
                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                <strong><?php echo e($program->total_seats); ?></strong> Total Seats
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-clock-fill text-primary me-2"></i>
                                                <strong><?php echo e($program->duration_years); ?></strong> Years Duration
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-calendar-check-fill text-warning me-2"></i>
                                                Admission Open
                                            </li>
                                        </ul>

                                        <a href="<?php echo e(route('student.application.create', ['program' => $program->id])); ?>"
                                           class="btn btn-primary w-100 py-2 rounded-pill fw-bold shadow">
                                            <i class="bi bi-arrow-right-circle-fill me-2"></i>Apply Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/student/dashboard.blade.php ENDPATH**/ ?>