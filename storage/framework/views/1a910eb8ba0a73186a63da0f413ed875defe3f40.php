<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.All documents')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

   <!-- DataTable -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
               <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.All documents')); ?></h6>
                </div>
                <div class="col-4">
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th><?php echo e(__('sentence.Title')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Note')); ?></th>
                      <th><?php echo e(__('sentence.Patient')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Document Type')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($document->id); ?></td>
                      <td> <?php echo e($document->title); ?></td>
                      <td class="text-center"> <?php echo e($document->note); ?> </td>
                      <td><a href="<?php echo e(url('patient/view/'.$document->user_id)); ?>"> <?php echo e($document->Patient->name); ?> </a></td>
                      <td class="text-center"> <?php echo e($document->document_type); ?> </td>
                      <td class="text-center">
                        <a href="<?php echo e(url('/uploads/'.$document->file)); ?>" class="btn btn-success btn-circle btn-sm" download><i class="fa fa-eye"></i></a>
                        <a href="#" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v4.0\resources\views/document/all.blade.php ENDPATH**/ ?>