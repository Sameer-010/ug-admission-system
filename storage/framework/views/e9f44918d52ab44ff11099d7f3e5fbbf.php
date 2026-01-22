

<?php $__env->startSection('content'); ?>

<div class="container py-4">

    <h3 class="fw-bold mb-3">Notifications</h3>

    <form action="<?php echo e(route('notifications.read.all')); ?>" method="GET" class="mb-3">
        <button class="btn btn-primary btn-sm">Mark All as Read</button>
    </form>

    <div class="list-group shadow-sm">

        <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('notifications.read.single', $noti->id)); ?>"
               class="list-group-item list-group-item-action 
                    <?php echo e($noti->is_read ? '' : 'fw-bold bg-light'); ?>">

                <div class="d-flex justify-content-between">
                    <h6 class="mb-1"><?php echo e($noti->title); ?></h6>
                    <small><?php echo e($noti->created_at->diffForHumans()); ?></small>
                </div>

                <p class="mb-1"><?php echo e($noti->message); ?></p>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-muted text-center py-4">No notifications found.</p>
        <?php endif; ?>

    </div>

    <div class="mt-3">
        <?php echo e($notifications->links()); ?>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/notifications/index.blade.php ENDPATH**/ ?>