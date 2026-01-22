

<?php $__env->startSection('content'); ?>
<div class="bg-light min-vh-100 py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Success!</strong> <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Error!</strong> <?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                
                <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden"
                     style="background: linear-gradient(135deg, #003d82 0%, #0052a8 100%);">
                    <div class="card-body p-4 p-md-5 text-white">
                        <h1 class="h2 fw-bold mb-2">Upload Required Documents</h1>
                        <p class="lead mb-0 opacity-90">
                            Application ID: <strong>#<?php echo e($application->id); ?></strong> |
                            Program: <strong><?php echo e($application->program->code); ?></strong>
                        </p>
                    </div>
                </div>

                
                <div class="card border-0 shadow-lg rounded-4 mb-4">
                    <div class="card-body p-4">
                        <form action="<?php echo e(route('student.documents.store', $application->id)); ?>"
                              method="POST"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Document Type *</label>
                                    <select name="document_type" class="form-select shadow-sm" required>
                                        <option value="">-- Select Document Type --</option>

                                        <option value="photo" <?php echo e($application->documents->where('document_type','photo')->count() ? 'disabled' : ''); ?>>📷 Passport Photo</option>

                                        <option value="cnic_front" <?php echo e($application->documents->where('document_type','cnic_front')->count() ? 'disabled' : ''); ?>>🆔 CNIC Front</option>

                                        <option value="cnic_back" <?php echo e($application->documents->where('document_type','cnic_back')->count() ? 'disabled' : ''); ?>>🆔 CNIC Back</option>

                                        <option value="matric_certificate" <?php echo e($application->documents->where('document_type','matric_certificate')->count() ? 'disabled' : ''); ?>>📜 Matric Certificate</option>

                                        <option value="inter_certificate" <?php echo e($application->documents->where('document_type','inter_certificate')->count() ? 'disabled' : ''); ?>>📜 Intermediate Certificate</option>

                                        <option value="domicile" <?php echo e($application->documents->where('document_type','domicile')->count() ? 'disabled' : ''); ?>>📄 Domicile Certificate</option>

                                        <option value="paid_challan" <?php echo e($application->documents->where('document_type','paid_challan')->count() ? 'disabled' : ''); ?>>💳 Paid Fee Challan</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Choose File *</label>
                                    <input type="file" name="document" class="form-control shadow-sm" required>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary rounded-pill px-4">
                                        <i class="bi bi-cloud-upload-fill me-2"></i>Upload
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                
                <div class="card border-0 shadow-lg rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <?php $__currentLoopData = $application->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6">
                                    <div class="card border-success h-100">
                                        <div class="card-body">
                                            <h6 class="fw-bold">
                                                <?php switch($document->document_type):
                                                    case ('photo'): ?> 📷 Passport Photo <?php break; ?>
                                                    <?php case ('cnic_front'): ?> 🆔 CNIC Front <?php break; ?>
                                                    <?php case ('cnic_back'): ?> 🆔 CNIC Back <?php break; ?>
                                                    <?php case ('matric_certificate'): ?> 📜 Matric Certificate <?php break; ?>
                                                    <?php case ('inter_certificate'): ?> 📜 Inter Certificate <?php break; ?>
                                                    <?php case ('domicile'): ?> 📄 Domicile <?php break; ?>
                                                    <?php case ('paid_challan'): ?> 💳 Paid Fee Challan <?php break; ?>
                                                <?php endswitch; ?>
                                            </h6>

                                            <div class="d-flex gap-2">
                                                <a href="<?php echo e(asset('storage/'.$document->file_path)); ?>"
                                                   target="_blank"
                                                   class="btn btn-sm btn-primary rounded-pill">
                                                    View
                                                </a>

                                                <form action="<?php echo e(route('student.documents.destroy', [$application->id, $document->id])); ?>"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this document?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button class="btn btn-sm btn-danger rounded-pill">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                
                <div class="card border-0 shadow-lg rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="row g-2">
                            <?php $__currentLoopData = [
                                'photo' => '📷 Passport Photo',
                                'cnic_front' => '🆔 CNIC Front',
                                'cnic_back' => '🆔 CNIC Back',
                                'matric_certificate' => '📜 Matric Certificate',
                                'inter_certificate' => '📜 Intermediate Certificate',
                                'domicile' => '📄 Domicile Certificate',
                                'paid_challan' => '💳 Paid Fee Challan'
                            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6">
                                    <div class="p-2 rounded <?php echo e($application->documents->where('document_type',$type)->count() ? 'bg-success bg-opacity-10' : 'bg-light'); ?>">
                                        <?php echo $label; ?>

                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                
                <?php if($application->documents->whereIn('document_type',[
                    'photo','cnic_front','cnic_back','matric_certificate','inter_certificate','domicile','paid_challan'
                ])->count() === 7): ?>
                    <div class="text-center mb-4">
                        <form action="<?php echo e(route('student.application.submit', $application->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-success rounded-pill px-4">
                                <i class="bi bi-send-fill me-2"></i>Submit Application
                            </button>
                        </form>
                    </div>
                <?php endif; ?>

                <div class="text-center">
                    <a href="<?php echo e(route('student.dashboard')); ?>" class="btn btn-outline-primary rounded-pill">
                        ← Back to Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/student/documents/upload.blade.php ENDPATH**/ ?>