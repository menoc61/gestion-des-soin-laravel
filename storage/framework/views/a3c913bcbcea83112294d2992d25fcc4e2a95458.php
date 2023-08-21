<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.Add Test')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Add Test')); ?></h6>
         </div>
         <div class="card-body">
            <form method="post" action="<?php echo e(route('test.create')); ?>">
               <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Test Name')); ?><font color="red">*</font></label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputEmail3" name="test_name">
                     <?php echo e(csrf_field()); ?>

                  </div>
               </div>
               <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Description')); ?></label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputPassword3" name="comment">
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v4.0\resources\views/test/create.blade.php ENDPATH**/ ?>