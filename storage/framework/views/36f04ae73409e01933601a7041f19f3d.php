

<?php $__env->startSection('content'); ?>
<div class="bg-light min-vh-100 py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Progress Header -->
                <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden" style="background: linear-gradient(135deg, #003d82 0%, #0052a8 100%);">
                    <div class="card-body p-4 p-md-5 text-white">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3">
                                    <i class="bi bi-pencil-square me-2"></i>Application Form
                                </div>
                                <h1 class="h2 fw-bold mb-2">New Application</h1>
                                <p class="lead mb-0 opacity-90">Complete all sections to submit your application</p>
                            </div>
                            <div class="col-lg-4 text-center d-none d-lg-block">
                                <i class="bi bi-clipboard2-check" style="font-size: 5rem; opacity: 0.2;"></i>
                            </div>
                        </div>
                        
                        <!-- Progress Steps -->
                        <div class="row mt-4 g-3">
                            <div class="col-3">
                                <div class="text-center">
                                    <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px;">
                                        <span class="fw-bold">1</span>
                                    </div>
                                    <p class="small mb-0">Program</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="text-center">
                                    <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px;">
                                        <span class="fw-bold">2</span>
                                    </div>
                                    <p class="small mb-0">Personal</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="text-center">
                                    <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px;">
                                        <span class="fw-bold">3</span>
                                    </div>
                                    <p class="small mb-0">Matric</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="text-center">
                                    <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px;">
                                        <span class="fw-bold">4</span>
                                    </div>
                                    <p class="small mb-0">Inter</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="<?php echo e(route('student.application.store')); ?>" method="POST" id="applicationForm">
                    <?php echo csrf_field(); ?>

                    <!-- Step 1: Program Selection -->
                    <div class="card border-0 shadow-lg rounded-4 mb-4">
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <span class="text-white fw-bold">1</span>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1 h5">Select Program</h4>
                                    <p class="text-muted mb-0 small">Choose your desired undergraduate program</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <label class="form-label fw-bold mb-3">
                                <i class="bi bi-mortarboard-fill text-primary me-2"></i>
                                Choose Program <span class="text-danger">*</span>
                            </label>
                            <select name="program_id" class="form-select <?php $__errorArgs = ['program_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" required>
                                <option value="">-- Select Your Program --</option>
                                <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($program->id); ?>" <?php echo e(($selectedProgram && $selectedProgram->id == $program->id) ? 'selected' : ''); ?>>
                                        <?php echo e($program->name); ?> (<?php echo e($program->code); ?>) - <?php echo e($program->total_seats); ?> Seats Available
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['program_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Step 2: Personal Information -->
                    <div class="card border-0 shadow-lg rounded-4 mb-4">
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <span class="text-white fw-bold">2</span>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1 h5">Personal Information</h4>
                                    <p class="text-muted mb-0 small">Provide your personal and family details</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-person text-success me-2"></i>
                                        Father's Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="father_name" class="form-control <?php $__errorArgs = ['father_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('father_name')); ?>" placeholder="Enter father's full name" required>
                                    <?php $__errorArgs = ['father_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-card-text text-success me-2"></i>
                                        Father's CNIC <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="father_cnic" class="form-control <?php $__errorArgs = ['father_cnic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('father_cnic')); ?>" placeholder="XXXXX-XXXXXXX-X" required maxlength="13" pattern="\d{13}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <?php $__errorArgs = ['father_cnic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <small class="form-text text-muted">Enter 13 digits without dashes</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-briefcase text-success me-2"></i>
                                        Father's Occupation
                                    </label>
                                    <input type="text" name="father_occupation" class="form-control <?php $__errorArgs = ['father_occupation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('father_occupation')); ?>" placeholder="e.g., Teacher, Businessman">
                                    <?php $__errorArgs = ['father_occupation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-calendar-event text-success me-2"></i>
                                        Date of Birth <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="date_of_birth" class="form-control <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('date_of_birth')); ?>" required>
                                    <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-gender-ambiguous text-success me-2"></i>
                                        Gender <span class="text-danger">*</span>
                                    </label>
                                    <select name="gender" class="form-select <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" required>
                                        <option value="">-- Select Gender --</option>
                                        <option value="male" <?php echo e(old('gender') == 'male' ? 'selected' : ''); ?>>Male</option>
                                        <option value="female" <?php echo e(old('gender') == 'female' ? 'selected' : ''); ?>>Female</option>
                                        <option value="other" <?php echo e(old('gender') == 'other' ? 'selected' : ''); ?>>Other</option>
                                    </select>
                                    <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-geo-alt text-success me-2"></i>
                                        Domicile <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="domicile" class="form-control <?php $__errorArgs = ['domicile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('domicile')); ?>" placeholder="e.g., Gwadar, Balochistan" required>
                                    <?php $__errorArgs = ['domicile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Matric Information -->
                    <div class="card border-0 shadow-lg rounded-4 mb-4">
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <span class="text-dark fw-bold">3</span>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1 h5">Matric / SSC Details</h4>
                                    <p class="text-muted mb-0 small">Enter your matriculation examination details</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-building text-warning me-2"></i>
                                        Board Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="matric_board" class="form-control <?php $__errorArgs = ['matric_board'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('matric_board')); ?>" placeholder="e.g., BISE Quetta" required>
                                    <?php $__errorArgs = ['matric_board'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-123 text-warning me-2"></i>
                                        Roll Number <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="matric_roll_no" class="form-control <?php $__errorArgs = ['matric_roll_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('matric_roll_no')); ?>" placeholder="Enter roll number" required>
                                    <?php $__errorArgs = ['matric_roll_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-trophy text-warning me-2"></i>
                                        Total Marks <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="matric_total_marks" class="form-control <?php $__errorArgs = ['matric_total_marks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('matric_total_marks')); ?>" placeholder="e.g., 1100" required min="1" oninput="this.value = Math.abs(this.value)">
                                    <?php $__errorArgs = ['matric_total_marks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-check-circle text-warning me-2"></i>
                                        Obtained Marks <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="matric_obtained_marks" class="form-control <?php $__errorArgs = ['matric_obtained_marks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('matric_obtained_marks')); ?>" placeholder="e.g., 950" required min="0">
                                    <?php $__errorArgs = ['matric_obtained_marks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-calendar-date text-warning me-2"></i>
                                        Passing Year <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="matric_passing_year" class="form-control <?php $__errorArgs = ['matric_passing_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('matric_passing_year')); ?>" min="2000" max="<?php echo e(date('Y')); ?>" placeholder="<?php echo e(date('Y')); ?>" required>
                                    <?php $__errorArgs = ['matric_passing_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Inter Information -->
                    <div class="card border-0 shadow-lg rounded-4 mb-4">
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-info rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <span class="text-white fw-bold">4</span>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1 h5">Intermediate / HSSC Details</h4>
                                    <p class="text-muted mb-0 small">Enter your intermediate examination details</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-building text-info me-2"></i>
                                        Board Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="inter_board" class="form-control <?php $__errorArgs = ['inter_board'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('inter_board')); ?>" placeholder="e.g., BISE Quetta" required>
                                    <?php $__errorArgs = ['inter_board'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-123 text-info me-2"></i>
                                        Roll Number <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="inter_roll_no" class="form-control <?php $__errorArgs = ['inter_roll_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('inter_roll_no')); ?>" placeholder="Enter roll number" required>
                                    <?php $__errorArgs = ['inter_roll_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-trophy text-info me-2"></i>
                                        Total Marks <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="inter_total_marks" class="form-control <?php $__errorArgs = ['inter_total_marks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('inter_total_marks')); ?>" placeholder="e.g., 1100" required min="1" oninput="this.value = Math.abs(this.value)">
                                    <?php $__errorArgs = ['inter_total_marks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-check-circle text-info me-2"></i>
                                        Obtained Marks <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="inter_obtained_marks" class="form-control <?php $__errorArgs = ['inter_obtained_marks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('inter_obtained_marks')); ?>" placeholder="e.g., 950" required min="0">
                                    <?php $__errorArgs = ['inter_obtained_marks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="bi bi-calendar-date text-info me-2"></i>
                                        Passing Year <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="inter_passing_year" class="form-control <?php $__errorArgs = ['inter_passing_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" value="<?php echo e(old('inter_passing_year')); ?>" min="2000" max="<?php echo e(date('Y')); ?>" placeholder="<?php echo e(date('Y')); ?>" required>
                                    <?php $__errorArgs = ['inter_passing_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                        <div class="card-body p-4 text-center text-white">
                            <i class="bi bi-check-circle-fill mb-3" style="font-size: 3rem;"></i>
                            <h4 class="fw-bold mb-2 h5">Ready to Submit?</h4>
                            <p class="mb-3 opacity-90">Review your information and click below to continue</p>
                            <button type="submit" class="btn btn-light btn-lg px-4 py-2 rounded-pill shadow fw-bold">
                                <i class="bi bi-arrow-right-circle-fill me-2"></i>Save & Continue to Documents
                            </button>
                            <p class="small mt-3 mb-0 opacity-75">
                                <i class="bi bi-info-circle me-2"></i>You can upload documents in the next step
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Format CNIC input to show dashes while maintaining 13 digits internally
    const cnicInput = document.querySelector('input[name="father_cnic"]');
    
    if (cnicInput) {
        cnicInput.addEventListener('input', function(e) {
            // Remove all non-digits
            let value = this.value.replace(/\D/g, '');
            
            // Limit to 13 digits
            if (value.length > 13) {
                value = value.substring(0, 13);
            }
            
            // Store the numeric value
            this.value = value;
        });
        
        // Validate on form submit
        document.getElementById('applicationForm').addEventListener('submit', function(e) {
            const cnicValue = cnicInput.value.replace(/\D/g, '');
            if (cnicValue.length !== 13) {
                e.preventDefault();
                alert('Father\'s CNIC must be exactly 13 digits.');
                cnicInput.focus();
            }
        });
    }
    
    // Prevent negative values for total marks
    const totalMarksInputs = [
        document.querySelector('input[name="matric_total_marks"]'),
        document.querySelector('input[name="inter_total_marks"]')
    ];
    
    totalMarksInputs.forEach(input => {
        if (input) {
            input.addEventListener('input', function() {
                if (this.value < 1) {
                    this.value = Math.abs(this.value) || 1;
                }
            });
            
            input.addEventListener('blur', function() {
                if (this.value < 1) {
                    this.value = 1;
                }
            });
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/student/application/create.blade.php ENDPATH**/ ?>