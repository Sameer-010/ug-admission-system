<div class="card border-0 shadow-lg rounded-4 mb-4">
    <div class="card-header bg-white p-4">
        <h3 class="fw-bold fs-4">
            <i class="bi bi-files me-2 text-primary"></i> Uploaded Documents
        </h3>
    </div>

    <div class="card-body p-4">
        <?php if($application->documents->isEmpty()): ?>
            <div class="text-center py-4">
                <i class="bi bi-folder-x text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-2">No documents uploaded.</p>
            </div>
        <?php else: ?>
            <div class="row g-3">
                <?php $__currentLoopData = $application->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <div class="card-body">
                                <h6 class="fw-bold text-capitalize">
                                    <?php echo e(str_replace('_', ' ', $doc->document_type)); ?>

                                </h6>
                                <small class="text-muted">
                                    <?php echo e(number_format($doc->file_size / 1024, 1)); ?> KB
                                </small>

                                <div class="mt-3 d-flex gap-2">
                                    <a target="_blank" href="<?php echo e(asset('storage/'.$doc->file_path)); ?>"
                                       class="btn btn-outline-primary btn-sm rounded-pill w-50">
                                        <i class="bi bi-eye"></i> View
                                    </a>

                                    <a download href="<?php echo e(asset('storage/'.$doc->file_path)); ?>"
                                       class="btn btn-outline-success btn-sm rounded-pill w-50">
                                        <i class="bi bi-download"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/admin/applications/partials/documents.blade.php ENDPATH**/ ?>