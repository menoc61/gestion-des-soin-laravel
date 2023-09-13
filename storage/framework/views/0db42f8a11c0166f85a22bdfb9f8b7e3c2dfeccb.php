<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Edit Test')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Edit Test')); ?></h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo e(route('test.store_edit')); ?>">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Test Name')); ?><font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail3" name="test_name"
                                    value="<?php echo e($test->test_name); ?>">
                                <?php echo e(csrf_field()); ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3"
                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.Description')); ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputPassword3" name="comment"
                                    value="<?php echo e($test->comment); ?>">
                                <input type="hidden" name="test_id" value="<?php echo e($test->id); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputSection" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Form Type')); ?></label>
                            <div class="col-sm-9">
                                <select multiple="multiple" class="form-control" id="inputSection" name="diagnostic_type[]">
                                    <?php $__currentLoopData = ['DIAGNOSE PEAU', 'DIAGNOSE MAIN', 'DIAGNOSE PIED']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $isSelected = in_array($option, json_decode($test->diagnostic_type));
                                            $isDisabled = !$isSelected ? 'disabled' : '';
                                        ?>
                                        <option value="<?php echo e($option); ?>" <?php echo e($isSelected ? 'selected' : ''); ?> <?php echo e($isDisabled); ?>>
                                            <?php echo e($option); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
<?php echo e($test->signes_particuliers_peau); ?>

                        <div class="form-group row " id="section-DIAGNOSE PEAU" style="display : none;">
                            <!-- Content for DIAGNOSE PEAU section -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <?php echo e(__('sentence.skin diagnostic sheet')); ?>

                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="signes-particuliers-peau"
                                            class="col-sm-3 col-form-label"><?php echo e(__('sentence.SIGNES PARTICULIERS')); ?></label>
                                        <div class="col-sm-9">
                                            <select id="signes-particuliers" class="form-control" multiple="multiple"
                                                name="signes_particuliers_peau[]">

                                                <?php $__currentLoopData = ['Points noirs', 'Rosacée', 'Rousseurs', 'Télangiectasie', 'Pustules', 'Hypertrichose', 'Pigmentations', 'Vitiligo', 'Cicatrice', 'Chéloïdes', 'Comédons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($option); ?>"
                                                        <?php echo e(in_array($option, json_decode($test->signes_particuliers_peau)) ? 'selected' : ''); ?>>
                                                        <?php echo e($option); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row " id="section-DIAGNOSE MAIN" style="display: none;">
                            <!-- Content for DIAGNOSE MAIN section -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <?php echo e(__('sentence.hand diagnostic sheet')); ?>

                                    </h6>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group row " id="section-DIAGNOSE PIED" style="display : none;">
                            <!-- Content for DIAGNOSE PIED section -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <?php echo e(__('sentence.foot diagnostic sheet')); ?></h6>
                                </div>
                                
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" defer>
        window.addEventListener('DOMContentLoaded', function() {
            var sections = document.querySelectorAll('.form-group.row[id^="section-"]');

            sections.forEach(function(section) {
                section.style.display = 'none';
            });

            document.getElementById('inputSection').addEventListener('change', function() {
                var selectedOptions = Array.from(this.selectedOptions).map(option => option.value);

                sections.forEach(function(section) {
                    if (selectedOptions.includes(section.id.replace('section-', ''))) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <script type="text/javascript"
        src="https://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
        $('#signes-particuliers,#signes-particuliers-ongles,#soin').multiselect();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Desktop\gestion des soins\v1.0\resources\views/test/edit.blade.php ENDPATH**/ ?>