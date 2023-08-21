<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.All Patients')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- DataTales  -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-8">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.All Appointments')); ?></h6>
         </div>
         <div class="col-4">
            <a href="<?php echo e(route('appointment.create')); ?>" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> <?php echo e(__('sentence.New Appointment')); ?></a>
         </div>
      </div>
   </div>
   <div class="card-body">
      <div id="calendar"></div>
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
<link href='https://www.jqueryscript.net/demo/Full-Size-Drag-Drop-Calendar-Plugin-FullCalendar/fullcalendar.min.css' rel='stylesheet' />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<script src='https://www.jqueryscript.net/demo/Full-Size-Drag-Drop-Calendar-Plugin-FullCalendar/fullcalendar.min.js'></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v3.4\resources\views/appointment/calendar.blade.php ENDPATH**/ ?>