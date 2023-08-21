<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.All Patients')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- DataTales  -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-8">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.Upcoming Appointments')); ?></h6>
         </div>
         <div class="col-4">
            <a href="<?php echo e(route('appointment.create')); ?>" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> <?php echo e(__('sentence.New Appointment')); ?></a>
         </div>
      </div>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th class="text-center">ID</th>
                  <th><?php echo e(__('sentence.Patient Name')); ?></th>
                  <th><?php echo e(__('sentence.Schedule Info')); ?></th>
                  <th class="text-center"><?php echo e(__('sentence.Status')); ?></th>
                  <th class="text-center"><?php echo e(__('sentence.Created at')); ?></th>
                  <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
               </tr>
            </thead>
            <tbody>
               <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <tr>
                  <td class="text-center"><?php echo e($appointment->id); ?></td>
                  <td><a href="<?php echo e(url('patient/view/'.$appointment->user_id)); ?>"> <?php echo e($appointment->User->name); ?> </a></td>
                  <td> 
                     <label class="badge badge-primary-soft">
                        <i class="fas fa-calendar"></i> <?php echo e($appointment->date->format('d M Y')); ?>

                     </label>
                      <label class="badge badge-primary-soft">
                        <i class="fa fa-clock"></i> <?php echo e($appointment->time_start); ?> - <?php echo e($appointment->time_end); ?>

                     </label>
                  </td>
                  <td class="text-center">
                     <?php if($appointment->visited == 0): ?>
                     <label class="badge badge-warning-soft">
                     <i class="fas fa-hourglass-start"></i> <?php echo e(__('sentence.Not Yet Visited')); ?>

                     </label>
                     <?php elseif($appointment->visited == 1): ?>
                     <label class="badge badge-success-soft">
                     <i class="fas fa-check"></i> <?php echo e(__('sentence.Visited')); ?>

                     </label>
                     <?php else: ?>
                     <label class="badge badge-danger-soft">
                     <i class="fas fa-user-times"></i> <?php echo e(__('sentence.Cancelled')); ?>

                     </label>
                     <?php endif; ?>
                  </td>
                  <td class="text-center"><?php echo e($appointment->created_at->format('d M Y H:i')); ?></td>
                  <td align="center">
                     <a data-rdv_id="<?php echo e($appointment->id); ?>" data-rdv_date="<?php echo e($appointment->date->format('d M Y')); ?>" data-rdv_time_start="<?php echo e($appointment->time_start); ?>" data-rdv_time_end="<?php echo e($appointment->time_end); ?>" data-patient_name="<?php echo e($appointment->User->name); ?>" class="btn btn-outline-success btn-circle btn-sm" data-toggle="modal" data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
                     <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(url('appointment/delete/'.$appointment->id)); ?>"><i class="fas fa-trash"></i></a>
                  </td>
               </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
         </table>

         <span class="float-right mt-3"><?php echo e($appointments->links()); ?></span>
      </div>
   </div>
</div>
<!--EDIT Appointment Modal-->
<div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('sentence.You are about to modify an appointment')); ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <p><b><?php echo e(__('sentence.Patient')); ?> :</b> <span id="patient_name"></span></p>
            <p><b><?php echo e(__('sentence.Date')); ?> :</b> <label class="badge badge-primary-soft" id="rdv_date"></label></p>
            <p><b><?php echo e(__('sentence.Time Slot')); ?> :</b> <label class="badge badge-primary-soft" id="rdv_time"></label></p>
         </div>
         <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo e(__('sentence.Close')); ?></button>
            <a class="btn btn-primary text-white" onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();"><?php echo e(__('sentence.Confirm Appointment')); ?></a>
            <form id="rdv-form-confirm" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST" class="d-none">
               <input type="hidden" name="rdv_id" id="rdv_id">
               <input type="hidden" name="rdv_status" value="1">
               <?php echo csrf_field(); ?>
            </form>
            <a class="btn btn-danger text-white" onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();"><?php echo e(__('sentence.Cancel Appointment')); ?></a>
            <form id="rdv-form-cancel" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST" class="d-none">
               <input type="hidden" name="rdv_id" id="rdv_id2">
               <input type="hidden" name="rdv_status" value="2">
               <?php echo csrf_field(); ?>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<style type="text/css">
   td > a {
      font-weight: 600;
      font-size: 15px;
   }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v4.0\resources\views/appointment/pending.blade.php ENDPATH**/ ?>