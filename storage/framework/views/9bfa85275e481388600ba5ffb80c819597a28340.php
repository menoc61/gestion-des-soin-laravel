<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.All Drugs')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<!-- DataTales Example -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-8">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.All Drugs')); ?></h6>
         </div>
         <div class="col-4">
            <a href="<?php echo e(route('drug.create')); ?>" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> <?php echo e(__('sentence.Add Drug')); ?></a>
         </div>
      </div>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>ID</th>
                  <th><?php echo e(__('sentence.Trade Name')); ?></th>
                  <th><?php echo e(__('sentence.Generic Name')); ?></th>
                  <th class="text-center"><?php echo e(__('sentence.Total Use')); ?></th>
                  <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
               </tr>
            </thead>
            <tbody>
               <?php $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <tr>
                  <td><?php echo e($drug->id); ?></td>
                  <td><?php echo e($drug->trade_name); ?></td>
                  <td><?php echo e($drug->generic_name); ?></td>
                  <td align="center"><?php echo e(__('sentence.In Prescription')); ?> : <?php echo e($drug->Prescription->count()); ?> <?php echo e(__('sentence.time use')); ?></td>
                  <td class="text-center">
                     <a href="<?php echo e(url('drug/edit/'.$drug->id)); ?>" class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                     <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(url('test/delete/'.$drug->id)); ?>"><i class="fas fa-trash"></i></a>
                  </td>
               </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v3.4\resources\views/drug/all.blade.php ENDPATH**/ ?>