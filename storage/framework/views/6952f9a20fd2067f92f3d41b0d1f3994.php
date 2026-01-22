

<?php $__env->startSection('content'); ?>
<div class="bg-light min-vh-100 py-5">
    <div class="container-fluid">
        <!-- Header -->
        <div class="card border-0 shadow-lg rounded-4 mb-4"
             style="background: linear-gradient(135deg, #003d82 0%, #0052a8 100%);">
            <div class="card-body p-5 text-white">
                <h1 class="fw-bold">Application #<?php echo e($application->id); ?></h1>
                <p class="lead opacity-75"><?php echo e($application->user->name); ?> - <?php echo e($application->program->name); ?></p>

                <span class="badge 
                    <?php if($application->status=='submitted'): ?> bg-info
                    <?php elseif($application->status=='under_review'): ?> bg-warning text-dark
                    <?php elseif($application->status=='approved'): ?> bg-success
                    <?php elseif($application->status=='rejected'): ?> bg-danger
                    <?php endif; ?> px-4 py-2 rounded-pill">
                    <?php echo e(ucfirst(str_replace('_', ' ', $application->status))); ?>

                </span>

                <span class="badge bg-primary px-3 py-2 rounded-pill ms-2">
                    <i class="bi bi-calendar"></i> <?php echo e($application->created_at->format('M d, Y')); ?>

                </span>
            </div>
        </div>

        <!-- Student + Academic + Documents -->
        <?php echo $__env->make('admin.applications.partials.student-info', ['application' => $application], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('admin.applications.partials.academic-info', ['application' => $application], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('admin.applications.partials.documents', ['application' => $application], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Status Update + Interview -->
        <div class="card border-0 shadow-lg rounded-4 mb-4">
            <div class="card-header bg-white p-4">
                <h3 class="fw-bold fs-4"><i class="bi bi-gear me-2 text-primary"></i> Application Actions</h3>
            </div>

            <div class="card-body p-4">

                <form action="<?php echo e(route('admin.applications.update-status', $application->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Update Status</label>
                        <select id="statusSelect" name="status" class="form-select rounded-pill" required>
                            <option value="under_review" <?php echo e($application->status=='under_review'?'selected':''); ?>>Under Review</option>
                            <option value="approved" <?php echo e($application->status=='approved'?'selected':''); ?>>Approve</option>
                            <option value="rejected" <?php echo e($application->status=='rejected'?'selected':''); ?>>Reject</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Comments</label>
                        <textarea name="comments" rows="3" class="form-control rounded-3"><?php echo e($application->admin_comments); ?></textarea>
                    </div>

                    <!-- INTERVIEW AREA -->
                    <div id="interviewBlock" style="display: none;">
                        <hr>
                        <h5 class="fw-bold mb-3">Interview Schedule</h5>

                        <label class="form-label">Interview Date</label>
                        <input type="date" name="interview_date" value="<?php echo e($application->interview_date); ?>" class="form-control rounded-pill mb-3">

                        <label class="form-label">Interview Time</label>
                        <input type="time" name="interview_time" value="<?php echo e($application->interview_time); ?>" class="form-control rounded-pill mb-3">

                        <label class="form-label">Venue</label>
                        <input type="text" name="interview_venue" value="<?php echo e($application->interview_venue); ?>" class="form-control rounded-pill mb-3">

                        <label class="form-label">Notes</label>
                        <textarea name="interview_notes" class="form-control rounded-3"><?php echo e($application->interview_notes); ?></textarea>
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
            <a href="<?php echo e(route('admin.applications.index')); ?>" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Back to Applications
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/admin/applications/show.blade.php ENDPATH**/ ?>