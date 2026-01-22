

<?php $__env->startSection('content'); ?>
<div class="bg-light min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- Header -->
                <div class="card border-0 shadow-lg rounded-4 mb-4"
                     style="background: linear-gradient(135deg, #003d82 0%, #0052a8 100%);">
                    <div class="card-body p-5 text-white">
                        <h1 class="fw-bold mb-2">Application #<?php echo e($application->id); ?></h1>
                        <p class="lead opacity-75"><?php echo e($application->program->name); ?></p>

                        <span class="badge 
                            <?php if($application->status == 'submitted'): ?> bg-info
                            <?php elseif($application->status == 'under_review'): ?> bg-warning text-dark
                            <?php elseif($application->status == 'approved'): ?> bg-success
                            <?php elseif($application->status == 'rejected'): ?> bg-danger
                            <?php endif; ?> px-3 py-2 rounded-pill fs-6">
                            <?php echo e(ucfirst(str_replace('_', ' ', $application->status))); ?>

                        </span>

                        <span class="badge bg-primary rounded-pill px-3 py-2 fs-6 ms-2">
                            <i class="bi bi-calendar"></i> <?php echo e($application->created_at->format('M d, Y')); ?>

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
                                <p class="fw-bold"><?php echo e($application->user->name); ?></p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Email</label>
                                <p class="fw-bold"><?php echo e($application->user->email); ?></p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Father's Name</label>
                                <p class="fw-bold"><?php echo e($application->father_name); ?></p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Father CNIC</label>
                                <p class="fw-bold"><?php echo e($application->father_cnic); ?></p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Date of Birth</label>
                                <p class="fw-bold"><?php echo e($application->date_of_birth->format('M d, Y')); ?></p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Gender</label>
                                <p class="fw-bold text-capitalize"><?php echo e($application->gender); ?></p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Domicile</label>
                                <p class="fw-bold"><?php echo e($application->domicile); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Academic Info -->
                <?php echo $__env->make('student.application.partials.academic-info', ['application' => $application], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <!-- Documents -->
                <?php echo $__env->make('student.application.partials.documents', ['application' => $application], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <!-- Admin Comments -->
                <?php if($application->admin_comments): ?>
                <div class="card border-warning shadow-lg rounded-4 mb-4 border-start border-4 border-warning">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3"><i class="bi bi-chat-left-text text-warning me-2"></i>Admin Comments</h4>
                        <div class="bg-light p-3 rounded">
                            <?php echo e($application->admin_comments); ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Interview Details (only if approved) -->
                <?php if($application->status === 'approved' && $application->interview_date): ?>
                <div class="card border-success shadow-lg rounded-4 mb-4 border-start border-4 border-success">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3 text-success">
                            <i class="bi bi-calendar-check me-2"></i> Interview Schedule
                        </h4>

                        <p><strong>Date:</strong> <?php echo e(\Carbon\Carbon::parse($application->interview_date)->format('M d, Y')); ?></p>
                        <p><strong>Time:</strong> <?php echo e($application->interview_time); ?></p>
                        <p><strong>Venue:</strong> <?php echo e($application->interview_venue); ?></p>

                        <?php if($application->interview_notes): ?>
                            <p><strong>Notes:</strong> <?php echo e($application->interview_notes); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="text-center">
                    <a href="<?php echo e(route('student.dashboard')); ?>" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/student/application/show.blade.php ENDPATH**/ ?>