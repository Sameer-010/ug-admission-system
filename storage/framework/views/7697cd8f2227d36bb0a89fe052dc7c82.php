<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-header bg-primary text-white fw-bold">
        Update Profile Information
    </div>

    <div class="card-body">

        <form method="POST" action="<?php echo e(route('profile.update')); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Name</label>
                <input type="text" class="form-control" name="name"
                    value="<?php echo e(old('name', $user->name)); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" name="email"
                    value="<?php echo e(old('email', $user->email)); ?>" required>
            </div>

            <button class="btn btn-success px-4">Save</button>
        </form>

    </div>
</div>
<?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/profile/partials/update-profile-information-form.blade.php ENDPATH**/ ?>