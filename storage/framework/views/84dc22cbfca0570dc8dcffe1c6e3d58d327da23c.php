<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.Doctorino Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.SMS Gateway Setup')); ?></h6>
         </div>
         <div class="card-body">
            <form method="post" action="<?php echo e(route('sms_settings.store')); ?>">
               <div class="form-group row">
                  <label for="NEXMO_KEY" class="col-sm-3 col-form-label"><?php echo e(__('sentence.NEXMO_KEY')); ?> </label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="NEXMO_KEY" name="NEXMO_KEY" value="<?php echo e(App\Setting::get_option('NEXMO_KEY')); ?>" required>
                     <?php echo e(csrf_field()); ?>

                  </div>
               </div>
               <div class="form-group row">
                  <label for="NEXMO_SECRET" class="col-sm-3 col-form-label"><?php echo e(__('sentence.NEXMO_SECRET')); ?></label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="NEXMO_SECRET" name="NEXMO_SECRET" value="<?php echo e(App\Setting::get_option('NEXMO_SECRET')); ?>" required>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v4.0\resources\views/settings/sms_settings.blade.php ENDPATH**/ ?>