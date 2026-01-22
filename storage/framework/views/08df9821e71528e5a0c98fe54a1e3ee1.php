<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-header bg-danger text-white fw-bold">
        Delete Account
    </div>

    <div class="card-body">

        <p class="text-muted">
            Once your account is deleted, all your data will be permanently removed.
        </p>

        <form method="POST" action="<?php echo e(route('profile.destroy')); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Confirm Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button class="btn btn-danger px-4"
                    onclick="return confirm('Are you sure you want to delete your account? This cannot be undone!');">
                Delete Account
            </button>
        </form>

    </div>
</div>
<?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/profile/partials/delete-user-form.blade.php ENDPATH**/ ?>