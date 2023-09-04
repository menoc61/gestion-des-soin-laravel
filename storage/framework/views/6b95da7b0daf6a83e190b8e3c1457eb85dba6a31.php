<?php $__env->startSection('header'); ?>
    <style>
        .hidden-section {
            display: none;
        }
    </style>
    <link rel="stylesheet" type="text/css"
        href="https://davidstutz.github.io/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Edit Patient')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">

                    <div class="row">
                        <div class="col-8">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Edit Patient')); ?></h6>
                        </div>
                        <div class="col-4">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view patient')): ?>
                                <a href="<?php echo e(route('patient.view', ['id' => $patient->id])); ?>"
                                    class="btn btn-primary btn-sm float-right "><i class="fa fa-eye"></i>
                                    <?php echo e(__('sentence.View Patient')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo e(route('patient.store_edit')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"><?php echo e(__('sentence.Full Name')); ?><font color="red">*</font></label>
                                <input type="text" class="form-control" id="Name" name="name"
                                    value="<?php echo e($patient->name); ?>">
                                <input type="hidden" class="form-control" name="user_id" value="<?php echo e($patient->id); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4"><?php echo e(__('sentence.Email Adress')); ?><font color="red">*</font>
                                </label>
                                <input type="email" class="form-control" id="Email" name="email"
                                    value="<?php echo e($patient->email); ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2"><?php echo e(__('sentence.Phone')); ?></label>
                                <input type="text" class="form-control" id="Phone" name="phone"
                                    value="<?php echo e($patient->Patient->phone); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress"><?php echo e(__('sentence.Birthday')); ?><font color="red">*</font>
                                </label>
                                <input type="date" class="form-control" id="Birthday" name="birthday"
                                    value="<?php echo e($patient->Patient->birthday); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress2"><?php echo e(__('sentence.Address')); ?></label>
                                <input type="text" class="form-control" id="Address" name="adress"
                                    value="<?php echo e($patient->Patient->adress); ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputCity"><?php echo e(__('sentence.Gender')); ?><font color="red">*</font></label><br>
                                <select class="form-control" name="gender" id="Gender">
                                    <?php $__currentLoopData = ['Male', 'Female']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($option); ?>" <?php echo e($patient->Patient->gender === $option ? 'selected' : ''); ?>>
                                            <?php echo e($option); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-row col-md-10 ml-10">
                                <div class="form-group col-md-3">
                                    <label for="morphology_patient"><?php echo e(__('sentence.Morphology')); ?><font color="red">*
                                        </font></label>
                                    <div class="col-md-3">
                                        <select class="form-control" id="morphology_patient" multiple="multiple"
                                            name="morphology[]">
                                            <?php $__currentLoopData = ['Grand(e)', 'Svelte', 'Petit(e)', 'Mince', 'Maigre', 'Rondeur', 'Enveloppé(e)']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($option); ?>"
                                                    <?php echo e(in_array($option, json_decode($patient->Patient->morphology)) ? 'selected' : ''); ?>>
                                                    <?php echo e($option); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="alimentation_patient"><?php echo e(__('sentence.Alimentation')); ?><font
                                            color="red">*</font></label>
                                    <div class="col-md-3">
                                        <select class="form-control" id="alimentation_patient" multiple="multiple"
                                            name="alimentation[]">
                                            <?php $__currentLoopData = ['Viande', 'Poisson', 'Légumes', 'Céréales', 'Tubercules', 'Fruits', 'Alcool', 'Pas d\'alcool', 'Fumeur', 'Non-fumeur']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($option); ?>"
                                                    <?php echo e(in_array($option, json_decode($patient->Patient->alimentation)) ? 'selected' : ''); ?>>
                                                    <?php echo e($option); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="digestion_patient"><?php echo e(__('sentence.Digestion')); ?><font color="red">*
                                        </font></label>
                                    <div class="col-md-3">
                                        <select class="form-control" id="digestion_patient" name="digestion">
                                            <?php $__currentLoopData = ['Bonne', 'Alternée', 'Médiocre']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($option); ?>" <?php echo e($patient->Patient->digestion === $option ? 'selected' : ''); ?>>
                                                    <?php echo e($option); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="typ_patient"><?php echo e(__('sentence.Type of patient')); ?><font color="red">*
                                        </font></label>
                                    <div class="col-md-3">
                                        <select class="form-control" id="typ_patient" multiple="multiple"
                                            name="typ_patient[]">
                                            <?php $__currentLoopData = ['Aucune', 'Grand(e)', 'Svelte', 'Petit(e)', 'Mince', 'Maigre', 'Rondeur', 'Enveloppé(e)']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($option); ?>"
                                                    <?php echo e(in_array($option, json_decode($patient->Patient->type_patient)) ? 'selected' : ''); ?>>
                                                    <?php echo e($option); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="hobbie"><?php echo e(__('sentence.Hobbies')); ?><font color="red">*</font></label>
                                <input type="text" class="form-control" id="hobbie" name="hobbie"
                                    value="<?php echo e($patient->Patient->hobbie); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="medication"><?php echo e(__('sentence.Medication')); ?><font color="red">*</font>
                                </label>
                                <input type="text" class="form-control" id="medication" name="medication"
                                    value="<?php echo e($patient->Patient->medication); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="allergie"><?php echo e(__('sentence.Allergies')); ?><font color="red">*</font></label>
                                <input type="text" class="form-control" id="allergie" name="allergie"
                                    value="<?php echo e($patient->Patient->allergie); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="request"><?php echo e(__('sentence.Special Requests')); ?><font color="red">*</font>
                                </label>
                                <input type="text" class="form-control" id="request" name="demande"
                                    value="<?php echo e($patient->Patient->demande); ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputState"><?php echo e(__('sentence.Profil')); ?></label>
                                <label for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i>
                                </label>
                                <input type="file" class="form-control" id="file-upload" name="image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary"><?php echo e(__('sentence.Save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <style type="text/css">
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script type="text/javascript"
        src="https://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
        $('#morphology_patient, #alimentation_patient, #digestion_patient, #typ_patient,#Gender').multiselect();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\gestion des soins\v4.0\resources\views/patient/edit.blade.php ENDPATH**/ ?>