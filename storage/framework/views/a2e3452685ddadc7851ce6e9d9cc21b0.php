<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-header bg-warning fw-bold">
        Update Password
    </div>

    <div class="card-body">

        <form method="POST" action="<?php echo e(route('password.update')); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Current Password</label>
                <input type="password" class="form-control" name="current_password" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">New Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Confirm New Password</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <button class="btn btn-primary px-4">Update Password</button>
        </form>

    </div>
</div>
<?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/profile/partials/update-password-form.blade.php ENDPATH**/ ?>