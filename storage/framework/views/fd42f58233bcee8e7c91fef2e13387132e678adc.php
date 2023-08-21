<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.Prescription Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Prescription Settings')); ?></h6>
         </div>
         <div class="card-body">
            <form method="post" action="<?php echo e(route('prescription_settings.store')); ?>">
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputEmail4">Header (Left)</label>
                     <textarea class="form-control" id="inputPassword4" name="header_left"><?php echo e(App\Setting::get_option('header_left')); ?></textarea>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputPassword4">Header (Right)</label>
                     <textarea class="form-control" id="inputPassword4" name="header_right"><?php echo e(App\Setting::get_option('header_right')); ?></textarea>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputEmail4">Footer (Left)</label>
                     <textarea class="form-control" id="inputPassword4" name="footer_left"><?php echo e(App\Setting::get_option('footer_left')); ?></textarea>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputPassword4">Footer (Right)</label>
                     <textarea class="form-control" id="inputPassword4" name="footer_right"><?php echo e(App\Setting::get_option('footer_right')); ?></textarea>
                     <?php echo e(csrf_field()); ?>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v3.4\resources\views/settings/prescription_settings.blade.php ENDPATH**/ ?>