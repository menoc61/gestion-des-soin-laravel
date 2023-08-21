<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.All Tests')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-8">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.All Tests')); ?></h6>
         </div>
         <div class="col-4">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create diagnostic test')): ?>
            <a href="<?php echo e(route('test.create')); ?>" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> <?php echo e(__('sentence.Add Test')); ?></a>
            <?php endif; ?>
         </div>
      </div>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>ID</th>
                  <th><?php echo e(__('sentence.Test Name')); ?></th>
                  <th><?php echo e(__('sentence.Description')); ?></th>
                  <th class="text-center"><?php echo e(__('sentence.Total Use')); ?></th>
                  <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
               </tr>
            </thead>
            <tbody>
               <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <tr>
                  <td><?php echo e($test->id); ?></td>
                  <td><?php echo e($test->test_name); ?></td>
                  <td> <?php echo e($test->comment); ?> </td>
                  <td align="center"><?php echo e(__('sentence.In Prescription')); ?> : <?php echo e($test->Prescription->count()); ?> <?php echo e(__('sentence.time use')); ?></td>
                  <td class="text-center">
                     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit diagnostic test')): ?>
                     <a href="<?php echo e(url('test/edit/'.$test->id)); ?>" class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                     <?php endif; ?>
                     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete diagnostic test')): ?>
                     <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(url('test/delete/'.$test->id)); ?>"><i class="fa fa-trash"></i></a>
                     <?php endif; ?>
                  </td>
               </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v4.0\resources\views/test/all.blade.php ENDPATH**/ ?>