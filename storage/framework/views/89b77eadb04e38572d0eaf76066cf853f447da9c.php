<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.Doctorino Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Doctorino Settings')); ?></h6>
         </div>
         <div class="card-body">
            <form method="post" action="<?php echo e(route('doctorino_settings.store')); ?>" enctype="multipart/form-data">
               <div class="form-group row">
                  <label for="system_name" class="col-sm-3 col-form-label"><?php echo e(__('sentence.System Name')); ?> </label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="system_name" name="system_name" value="<?php echo e(App\Setting::get_option('system_name')); ?>" required>
                     <?php echo e(csrf_field()); ?>

                  </div>
               </div>
               <div class="form-group row">
                  <label for="Title" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Title')); ?></label>
                  <div class="col-sm-9">
                     <input type="title" class="form-control" id="Title" name="title" value="<?php echo e(App\Setting::get_option('title')); ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="logo" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Logo')); ?></label>
                  <div class="col-sm-9">
                     <input type="file" class="form-control" id="logo" name="logo" value="<?php echo e(App\Setting::get_option('logo')); ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Address" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Address')); ?></label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="Address" name="address" value="<?php echo e(App\Setting::get_option('address')); ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Phone" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Phone')); ?> </label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="Phone" name="phone" value="<?php echo e(App\Setting::get_option('phone')); ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="hospital_email" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Hospital Email')); ?></label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="hospital_email" name="hospital_email" value="<?php echo e(App\Setting::get_option('hospital_email')); ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Currency" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Currency')); ?></label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="Currency" name="currency" value="<?php echo e(App\Setting::get_option('currency')); ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Currency" class="col-sm-3 col-form-label"><?php echo e(__('sentence.VAT')); ?></label>
                  <div class="col-sm-9">
                     <input type="number" class="form-control" id="Currency" name="vat" value="<?php echo e(App\Setting::get_option('vat')); ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Language" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Language')); ?></label>
                  <div class="col-sm-9">
                     <select class="form-control" name="language" id="Language" required>
                        <option value="<?php echo e(App\Setting::get_option('language')); ?>"><?php echo e($language[App\Setting::get_option('language')]); ?></option>
                        <option value="en">English</option>
                        <option value="es">Spanish</option>
                        <option value="fr">French</option>
                        <option value="de">Dutch</option>
                        <option value="it">Italian</option>
                        <option value="pt">Portuguese</option>
                        <option value="in">Hindi</option>
                        <option value="bn">Bengali</option>
                        <option value="id">Indonesian</option>
                        <option value="tr">Turkish</option>
                        <option value="ru">Russian</option>
                        <option value="ar">Arabic</option>
                     </select>
                  </div>
               </div>
               <hr>
               <div class="form-group row">
                  <label for="appointment_interval" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Appointment Interval')); ?></label>
                  <div class="col-sm-9">
                     <select class="form-control" name="appointment_interval" id="appointment_interval" required>
                        <option value="<?php echo e(App\Setting::get_option('appointment_interval')); ?>"><?php echo e(App\Setting::get_option('appointment_interval')); ?> mn</option>
                        <option value="10">10 mn</option>
                        <option value="15">15 mn</option>
                        <option value="20">20 mn</option>
                        <option value="25">25 mn</option>
                        <option value="30">30 mn</option>
                        <option value="35">35 mn</option>
                        <option value="40">40 mn</option>
                        <option value="45">45 mn</option>
                        <option value="50">50 mn</option>
                        <option value="55">55 mn</option>
                        <option value="60">60 mn</option>
                     </select>
                     <small id="emailHelp" class="form-text text-muted"><?php echo e(__('sentence.Modifying the interval will distort the dates of the appointments')); ?></small>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Saturday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('sentence.Saturday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Saturday" name="saturday_from" value="<?php echo e(App\Setting::get_option('saturday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Saturday" name="saturday_to" value="<?php echo e(App\Setting::get_option('saturday_to')); ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Sunday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('sentence.Sunday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Sunday" name="sunday_from" value="<?php echo e(App\Setting::get_option('sunday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Sunday" name="sunday_to" value="<?php echo e(App\Setting::get_option('sunday_to')); ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Monday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('sentence.Monday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Monday" name="monday_from" value="<?php echo e(App\Setting::get_option('monday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Monday" name="monday_to" value="<?php echo e(App\Setting::get_option('monday_to')); ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Tuesday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('sentence.Tuesday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Tuesday" name="tuesday_from" value="<?php echo e(App\Setting::get_option('tuesday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Tuesday" name="tuesday_to" value="<?php echo e(App\Setting::get_option('tuesday_to')); ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Wednseday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('sentence.Wednseday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Wednseday" name="wednesday_from" value="<?php echo e(App\Setting::get_option('wednesday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Wednseday" name="wednesday_to" value="<?php echo e(App\Setting::get_option('wednesday_to')); ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Thurday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('sentence.Thurday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Thurday" name="thursday_from" value="<?php echo e(App\Setting::get_option('thursday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Thurday" name="thursday_to" value="<?php echo e(App\Setting::get_option('thursday_to')); ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Friday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('sentence.Friday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Friday" name="friday_from" value="<?php echo e(App\Setting::get_option('friday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Friday" name="friday_to" value="<?php echo e(App\Setting::get_option('friday_to')); ?>">
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v3.4\resources\views/settings/doctorino_settings.blade.php ENDPATH**/ ?>