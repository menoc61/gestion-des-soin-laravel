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
                  <label for="inputEmail3" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Test Name')); ?><font color="red">*</font></label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputEmail3" name="test_name" value="<?php echo e($test->test_name); ?>">
                     <?php echo e(csrf_field()); ?>

                  </div>
               </div>
               <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Description')); ?></label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputPassword3" name="comment" value="<?php echo e($test->comment); ?>">
                     <input type="hidden" name="test_id" value="<?php echo e($test->id); ?>">
                  </div>
               </div>
               <div class="form-group row">
                <label for="inputSection" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Form Type')); ?></label>
                <div class="col-sm-9">
                    <select id="diagnostic_type" class="form-control <?php $__errorArgs = ['diagnostic_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="diagnostic_type[]" multiple required>
                        <option value="DIAGNOSE PEAU" <?php if(in_array('DIAGNOSE PEAU', explode(',', $test->diagnostic_type))): ?> selected <?php endif; ?>><?php echo e(__('DIAGNOSE PEAU')); ?></option>
                        <option value="DIAGNOSE MAIN" <?php if(in_array('DIAGNOSE MAIN', explode(',', $test->diagnostic_type))): ?> selected <?php endif; ?>><?php echo e(__('DIAGNOSE MAIN')); ?></option>
                        <option value="DIAGNOSE PIED" <?php if(in_array('DIAGNOSE PIED', explode(',', $test->diagnostic_type))): ?> selected <?php endif; ?>><?php echo e(__('DIAGNOSE PIED')); ?></option>
                    </select>
                </div>
            </div>
<div class="form-group row" id="section-DIAGNOSE PEAU" style="display: none;">
    <!-- Content for DIAGNOSE PEAU section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.skin diagnostic sheet')); ?></h6>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="signes-particuliers-peau" class="col-sm-3 col-form-label"><?php echo e(__('sentence.SIGNES PARTICULIERS')); ?></label>
                <div class="col-sm-9">
                    <select id="signes-particuliers-peau" class="form-control" multiple="multiple" name="signes_particuliers_peau[]">
                        <option value="Points noirs" <?php if(in_array('Points noirs', $test->signes_particuliers_peau)): ?> selected <?php endif; ?>>Points noirs</option>
                        <option value="Rosacée" <?php if(in_array('Rosacée', $test->signes_particuliers_peau)): ?> selected <?php endif; ?>>Rosacée</option>
                        <option value="Rousseurs" <?php if(in_array('Rousseurs', $test->signes_particuliers_peau)): ?> selected <?php endif; ?>>Rousseurs</option>
                        <option value="Télangiectasie" <?php if(in_array('Télangiectasie', $test->signes_particuliers_peau)): ?> selected <?php endif; ?>>Télangiectasie</option>
                        <option value="Pustules" <?php if(in_array('Pustules', $test->signes_particuliers_peau)): ?> selected <?php endif; ?>>Pustules</option>
                        <option value="Hypertrichose" <?php if(in_array('Hypertrichose', $test->signes_particuliers_peau)): ?> selected <?php endif; ?>>Hypertrichose</option>
                        <option value="Pigmentations" <?php if(in_array('Pigmentations', $test->signes_particuliers_peau)): ?> selected <?php endif; ?>>Pigmentations</option>
                        <option value="Vitiligo" <?php if(in_array('Vitiligo', $test->signes_particuliers_peau)): ?> selected <?php endif; ?>>Vitiligo</option>
                        <option value="Cicatrice" <?php if(in_array('Cicatrice', $test->signes_particuliers_peau)): ?> selected <?php endif; ?>>Cicatrice</option>
                        <option value="Chéloïdes" <?php if(in_array('Chéloïdes', $test->signes_particuliers_peau)): ?> selected <?php endif; ?>>Chéloïdes</option>
                        <option value="Comédons" <?php if(in_array('Comédons', $test->signes_particuliers_peau)): ?> selected <?php endif; ?>>Comédons</option>
                    </select>
                </div>
            </div>
            <hr>
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
    src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
<!-- Initialize the plugin: -->
<script type="text/javascript">
    $('#signes-particuliers,#signes-particuliers-ongles,#soin').multiselect();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\gestion des soins\v4.0\resources\views/test/edit.blade.php ENDPATH**/ ?>
