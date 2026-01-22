<div class="card border-0 shadow-lg rounded-4 mb-4">
    <div class="card-header bg-white p-4">
        <h3 class="fw-bold fs-4">
            <i class="bi bi-mortarboard me-2 text-primary"></i>
            Academic Information
        </h3>
    </div>

    <div class="card-body p-4">
        <h5 class="fw-bold text-primary mb-3">
            <i class="bi bi-award me-1"></i> Matriculation
        </h5>

        <div class="row g-2 mb-4">
            <div class="col-md-4">
                <small class="text-muted">Board</small>
                <p class="fw-bold"><?php echo e($application->matric_board); ?></p>
            </div>
            <div class="col-md-4">
                <small class="text-muted">Roll No</small>
                <p class="fw-bold"><?php echo e($application->matric_roll_no); ?></p>
            </div>
            <div class="col-md-4">
                <small class="text-muted">Passing Year</small>
                <p class="fw-bold"><?php echo e($application->matric_passing_year); ?></p>
            </div>
            <div class="col-md-4">
                <small class="text-muted">Obtained Marks</small>
                <p class="fw-bold"><?php echo e($application->matric_obtained_marks); ?></p>
            </div>
            <div class="col-md-4">
                <small class="text-muted">Total Marks</small>
                <p class="fw-bold"><?php echo e($application->matric_total_marks); ?></p>
            </div>
            <div class="col-md-4">
                <small class="text-muted">Percentage</small>
                <p class="fw-bold text-success"><?php echo e(number_format($application->matric_percentage,2)); ?>%</p>
            </div>
        </div>

        <h5 class="fw-bold text-primary mb-3">
            <i class="bi bi-award-fill me-1"></i> Intermediate
        </h5>

        <div class="row g-2">
            <div class="col-md-4">
                <small class="text-muted">Board</small>
                <p class="fw-bold"><?php echo e($application->inter_board); ?></p>
            </div>
            <div class="col-md-4">
                <small class="text-muted">Roll No</small>
                <p class="fw-bold"><?php echo e($application->inter_roll_no); ?></p>
            </div>
            <div class="col-md-4">
                <small class="text-muted">Passing Year</small>
                <p class="fw-bold"><?php echo e($application->inter_passing_year); ?></p>
            </div>
            <div class="col-md-4">
                <small class="text-muted">Obtained Marks</small>
                <p class="fw-bold"><?php echo e($application->inter_obtained_marks); ?></p>
            </div>
            <div class="col-md-4">
                <small class="text-muted">Total Marks</small>
                <p class="fw-bold"><?php echo e($application->inter_total_marks); ?></p>
            </div>
            <div class="col-md-4">
                <small class="text-muted">Percentage</small>
                <p class="fw-bold text-success"><?php echo e(number_format($application->inter_percentage,2)); ?>%</p>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/student/application/partials/academic-info.blade.php ENDPATH**/ ?>