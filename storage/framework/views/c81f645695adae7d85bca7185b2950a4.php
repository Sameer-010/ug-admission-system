<div class="card border-0 shadow-lg rounded-4 mb-4">
    <div class="card-header bg-white p-4">
        <h3 class="fw-bold fs-4">
            <i class="bi bi-person-vcard me-2 text-primary"></i>
            Student Information
        </h3>
    </div>

    <div class="card-body p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label text-muted fw-bold">Student Name</label>
                <p class="fw-bold fs-5"><?php echo e($application->user->name); ?></p>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted fw-bold">Email</label>
                <p class="fw-bold fs-5"><?php echo e($application->user->email); ?></p>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted fw-bold">Father's Name</label>
                <p class="fw-bold fs-5"><?php echo e($application->father_name); ?></p>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted fw-bold">Father CNIC</label>
                <p class="fw-bold fs-5"><?php echo e($application->father_cnic); ?></p>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted fw-bold">Date of Birth</label>
                <p class="fw-bold fs-5"><?php echo e($application->date_of_birth->format('M d, Y')); ?></p>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted fw-bold">Gender</label>
                <p class="fw-bold fs-5 text-capitalize"><?php echo e($application->gender); ?></p>
            </div>

            <div class="col-12">
                <label class="form-label text-muted fw-bold">Domicile</label>
                <p class="fw-bold fs-5"><?php echo e($application->domicile); ?></p>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/admin/applications/partials/student-info.blade.php ENDPATH**/ ?>