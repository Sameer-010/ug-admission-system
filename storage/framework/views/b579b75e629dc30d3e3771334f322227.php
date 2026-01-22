

<?php $__env->startSection('content'); ?>
<div class="bg-light min-vh-100">
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #003d82 0%, #0052a8 100%);">
                    <div class="card-body p-4 p-md-5">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="badge bg-warning text-dark px-3 px-md-4 py-2 rounded-pill mb-3 fs-6">
                                    <i class="bi bi-mortarboard me-2"></i>Program Management
                                </div>
                                <h1 class="display-5 fw-bold text-white mb-3">Academic Programs</h1>
                                <p class="lead text-white opacity-90 mb-4 fs-5">Manage degree programs and admission criteria</p>
                            </div>
                            <div class="col-lg-4 text-center d-none d-lg-block">
                                <div class="bg-white bg-opacity-10 rounded-circle p-3 p-md-4 d-inline-block">
                                    <i class="bi bi-book text-white" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-3 fs-4"></i>
                    <div>
                        <strong>Success!</strong> <?php echo e(session('success')); ?>

                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                    <div>
                        <strong>Error!</strong> <?php echo e(session('error')); ?>

                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            </div>
        <?php endif; ?>

        <!-- Quick Stats -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-lg rounded-4 h-100 border-start border-primary border-5">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-opacity-10 rounded-3 p-3 mb-3 d-inline-flex">
                            <i class="bi bi-mortarboard-fill text-primary fs-2"></i>
                        </div>
                        <h2 class="fw-bold text-primary mb-1"><?php echo e($programs->count()); ?></h2>
                        <p class="text-muted fw-semibold small">Total Programs</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-lg rounded-4 h-100 border-start border-success border-5">
                    <div class="card-body text-center">
                        <div class="bg-success bg-opacity-10 rounded-3 p-3 mb-3 d-inline-flex">
                            <i class="bi bi-check-circle-fill text-success fs-2"></i>
                        </div>
                        <h2 class="fw-bold text-success mb-1"><?php echo e($programs->where('is_active', true)->count()); ?></h2>
                        <p class="text-muted fw-semibold small">Active Programs</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-lg rounded-4 h-100 border-start border-warning border-5">
                    <div class="card-body text-center">
                        <div class="bg-warning bg-opacity-10 rounded-3 p-3 mb-3 d-inline-flex">
                            <i class="bi bi-person-plus-fill text-warning fs-2"></i>
                        </div>
                        <h2 class="fw-bold text-warning mb-1"><?php echo e($programs->sum('total_seats')); ?></h2>
                        <p class="text-muted fw-semibold small">Total Seats</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-lg rounded-4 h-100 border-start border-info border-5">
                    <div class="card-body text-center">
                        <div class="bg-info bg-opacity-10 rounded-3 p-3 mb-3 d-inline-flex">
                            <i class="bi bi-clock-fill text-info fs-2"></i>
                        </div>
                        <h2 class="fw-bold text-info mb-1"><?php echo e($programs->sum('duration_years')); ?></h2>
                        <p class="text-muted fw-semibold small">Total Years</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">

                        <!-- ✅ Working Search Form -->
                        <form action="<?php echo e(route('admin.programs.index')); ?>" method="GET" class="d-flex" style="max-width: 400px;">
                            <input 
                                type="text" 
                                name="search" 
                                class="form-control rounded-pill" 
                                placeholder="Search programs..." 
                                value="<?php echo e(request('search')); ?>"
                            >
                            <button class="btn btn-primary rounded-pill ms-2" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>

                        
                        <?php if(auth()->user()->role === 'admin'): ?>
                            <a href="<?php echo e(route('admin.programs.create')); ?>" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-plus-circle me-2"></i>Add New Program
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Programs Grid -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header bg-white border-0 p-4">
                        <h3 class="fw-bold mb-0 fs-4">
                            <i class="bi bi-grid-3x3-gap me-3 text-primary"></i>
                            Programs List
                            <?php if(request('search')): ?>
                                <span class="text-muted fs-6 ms-2">Results for "<?php echo e(request('search')); ?>"</span>
                            <?php endif; ?>
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <?php if($programs->isEmpty()): ?>
                            <div class="text-center py-5">
                                <i class="bi bi-journal-text text-muted" style="font-size: 4rem;"></i>
                                <?php if(request('search')): ?>
                                    <h4 class="fw-bold text-muted mt-4">No Results Found</h4>
                                    <p class="text-muted mb-4">No programs matched "<?php echo e(request('search')); ?>".</p>
                                <?php else: ?>
                                    <h4 class="fw-bold text-muted mt-4">No Programs Found</h4>
                                    <p class="text-muted mb-4">Get started by creating your first academic program.</p>
                                <?php endif; ?>

                                
                                <?php if(auth()->user()->role === 'admin'): ?>
                                    <a href="<?php echo e(route('admin.programs.create')); ?>" class="btn btn-primary btn-lg rounded-pill">
                                        <i class="bi bi-plus-circle me-2"></i>Create Program
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="row g-4">
                                <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card border-0 shadow-sm h-100 rounded-4">
                                            <div class="card-header text-white border-0 p-4" style="background: linear-gradient(135deg, #003d82 0%, #0052a8 100%);">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div>
                                                        <h5 class="fw-bold mb-1"><?php echo e($program->code); ?></h5>
                                                        <p class="mb-0 opacity-75 small"><?php echo e($program->name); ?></p>
                                                    </div>
                                                    <div class="bg-white bg-opacity-25 rounded-3 p-2">
                                                        <i class="bi bi-laptop-fill fs-4"></i>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <?php if($program->is_active): ?>
                                                        <span class="badge bg-success rounded-pill">
                                                            <i class="bi bi-check-circle me-1"></i>Active
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary rounded-pill">
                                                            <i class="bi bi-pause-circle me-1"></i>Inactive
                                                        </span>
                                                    <?php endif; ?>
                                                    <span class="badge bg-warning text-dark rounded-pill">
                                                        <?php echo e($program->total_seats); ?> Seats
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="card-body p-4">
                                                <p class="text-muted mb-4"><?php echo e($program->description ?? 'No description available.'); ?></p>
                                                <ul class="list-unstyled mb-4">
                                                    <li class="mb-2 d-flex align-items-center">
                                                        <i class="bi bi-clock-fill text-primary me-2"></i>
                                                        <span><strong><?php echo e($program->duration_years); ?></strong> Years Duration</span>
                                                    </li>
                                                    <li class="mb-2 d-flex align-items-center">
                                                        <i class="bi bi-people-fill text-success me-2"></i>
                                                        <span><strong><?php echo e($program->total_seats); ?></strong> Total Seats</span>
                                                    </li>
                                                    <li class="mb-2 d-flex align-items-center">
                                                        <i class="bi bi-calendar-check-fill text-warning me-2"></i>
                                                        <span>Admissions <strong><?php echo e($program->is_active ? 'Open' : 'Closed'); ?></strong></span>
                                                    </li>
                                                </ul>

                                                
                                                <?php if(auth()->user()->role === 'admin'): ?>
                                                    <div class="d-flex gap-2">
                                                        <a href="<?php echo e(route('admin.programs.edit', $program->id)); ?>" class="btn btn-outline-primary w-50 rounded-pill">
                                                            <i class="bi bi-pencil me-2"></i>Edit
                                                        </a>
                                                        <form action="<?php echo e(route('admin.programs.destroy', $program->id)); ?>" method="POST" class="d-inline w-50" onsubmit="return confirm('Are you sure you want to delete this program?')">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                                                                <i class="bi bi-trash me-2"></i>Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="text-center text-muted small fw-semibold">
                                                        View Only Access
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/admin/programs/index.blade.php ENDPATH**/ ?>