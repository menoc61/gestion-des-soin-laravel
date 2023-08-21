<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.Billing List')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
s
<!-- DataTables  -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-8">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.Billing List')); ?></h6>
         </div>
         <div class="col-4">
            <a href="<?php echo e(route('billing.create')); ?>" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> <?php echo e(__('sentence.Create Invoice')); ?></a>
         </div>
      </div>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>ID</th>
                  <th><?php echo e(__('sentence.Patient')); ?></th>
                  <th><?php echo e(__('sentence.Date')); ?></th>
                  <th><?php echo e(__('sentence.Amount')); ?> - <font class="text-danger">Due Balance</font></th>
                  <th><?php echo e(__('sentence.Status')); ?></th>
                  <th><?php echo e(__('sentence.Payment Method')); ?></th>
                  <th><?php echo e(__('sentence.Actions')); ?></th>
               </tr>
            </thead>
            <tbody>
               <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <tr>
                  <td><?php echo e($invoice->id); ?></td>
                  <td><a href="<?php echo e(url('patient/view/'.$invoice->user_id)); ?>"> <?php echo e($invoice->User->name); ?> </a></td>
                  <td><?php echo e($invoice->created_at->format('d M Y')); ?></td>
                  <td> <?php echo e($invoice->total_with_tax); ?> <?php echo e(App\Setting::get_option('currency')); ?> 
                     <?php if($invoice->payment_status == 'Unpaid' OR $invoice->payment_status == 'Partially Paid'): ?>
                     <label class="badge badge-danger-soft"><?php echo e($invoice->due_amount); ?> <?php echo e(App\Setting::get_option('currency')); ?> </label>
                     <?php endif; ?>
                  </td>
                  <td>
                     <?php if($invoice->payment_status == 'Unpaid'): ?>
                     <label class="badge badge-danger-soft">
                     <i class="fas fa-hourglass-start"></i> <?php echo e(__('sentence.Unpaid')); ?>

                     </label>
                     <?php elseif($invoice->payment_status == 'Paid'): ?>
                     <label class="badge badge-success-soft">
                        <i class="fas fa-check"></i> <?php echo e(__('sentence.Paid')); ?>

                     </label>
                     <?php elseif($invoice->payment_status == 'Partially Paid'): ?>
                     <label class="badge badge-warning-soft">
                        <i class="fas fa-hourglass-start"></i> <?php echo e(__('sentence.Partially Paid')); ?>

                     </label>
                     <?php else: ?>
                     
                     <?php endif; ?>
                  </td>
                  <td><label class="badge badge-primary-soft"><i class="fa fa-handshake"></i> <?php echo e($invoice->payment_mode); ?></label></td>
                  <td>
                     <a href="<?php echo e(url('billing/view/'.$invoice->id)); ?>" class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                     <a href="<?php echo e(url('billing/pdf/'.$invoice->id)); ?>" class="btn btn-outline-primary btn-circle btn-sm"><i class="fas fa-print"></i></a>
                     <a href="<?php echo e(url('billing/edit/'.$invoice->id)); ?>" class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                     <a data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(url('billing/delete/'.$invoice->id)); ?>" class="btn btn-outline-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                  </td>
               </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
         </table>
         <span class="float-right mt-3"><?php echo e($invoices->links()); ?></span>

      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v3.4\resources\views/billing/all.blade.php ENDPATH**/ ?>