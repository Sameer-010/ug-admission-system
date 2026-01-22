<?php $__env->startSection('header'); ?>
    <h2 class="fw-bold fs-4 text-dark">Profile</h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row g-4">

    <div class="col-md-8 mx-auto">
        <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <div class="col-md-8 mx-auto">
        <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <div class="col-md-8 mx-auto">
        <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/profile/edit.blade.php ENDPATH**/ ?>