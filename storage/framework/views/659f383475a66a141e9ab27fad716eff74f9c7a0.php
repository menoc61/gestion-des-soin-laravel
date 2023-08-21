<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.View Prescription')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800"></h1>
   <button href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm print_prescription"><i class="fas fa-print fa-sm text-white-50"></i> Print</button>
</div>
<div class="row justify-content-center">
   <div class="col-10">
      <div class="card shadow mb-4">
         <div class="card-body">
            <!-- ROW : Doctor informations -->
            <div class="row">
               <div class="col">
                  <?php if(!empty(App\Setting::get_option('logo'))): ?>
                  <img src="<?php echo e(asset('uploads/'.App\Setting::get_option('logo'))); ?>"><br><br>
                  <?php endif; ?>
                  <?php echo clean(App\Setting::get_option('header_left')); ?>

               </div>
               <div class="col-md-3">
                  <p><b><?php echo e(__('sentence.Date')); ?> :</b> <?php echo e($prescription->created_at->format('d M Y')); ?></p>
                  <p><b><?php echo e(__('sentence.Reference')); ?> :</b> <?php echo e($prescription->reference); ?></p>
               </div>
            </div>
            <!-- END ROW : Doctor informations -->
            <!-- ROW : Patient informations -->
            <div class="row">
               <div class="col">
                  <hr>
                  <p>
                     <b><?php echo e(__('sentence.Patient Name')); ?> :</b> <?php echo e($prescription->User->name); ?>

                     <?php if(isset($prescription->User->Patient->birthday)): ?>
                     - <b><?php echo e(__('sentence.Age')); ?> :</b> <?php echo e($prescription->User->Patient->birthday); ?> (<?php echo e(\Carbon\Carbon::parse($prescription->User->Patient->birthday)->age); ?> Years)
                     <?php endif; ?>
                     <?php if(isset($prescription->User->Patient->gender)): ?>
                     - <b><?php echo e(__('sentence.Gender')); ?> :</b> <?php echo e(__('sentence.'.$prescription->User->Patient->gender)); ?>

                     <?php endif; ?>
                     <?php if(isset($prescription->User->Patient->weight)): ?>
                     - <b><?php echo e(__('sentence.Patient Weight')); ?> :</b> <?php echo e($prescription->User->Patient->weight); ?> Kg
                     <?php endif; ?>
                     <?php if(isset($prescription->User->Patient->height)): ?>
                     - <b><?php echo e(__('sentence.Patient Height')); ?> :</b> <?php echo e($prescription->User->Patient->height); ?>

                     <?php endif; ?>
                  </p>
                  <hr>
               </div>
            </div>
            <!-- END ROW : Patient informations -->
            <?php if(count($prescription_drugs) > 0): ?>
            <!-- ROW : Drugs List -->
            <div class="row justify-content-center">
               <div class="col">
                  <?php $__currentLoopData = $prescription_drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><?php echo e($drug->type); ?> - <?php echo e($drug->Drug->trade_name); ?> <?php echo e($drug->strength); ?> - <?php echo e($drug->dose); ?> - <?php echo e($drug->duration); ?> <br> <?php echo e($drug->drug_advice); ?></li>
                  <?php if($loop->last): ?>
                  <div style="margin-bottom: 150px;"></div>
                  <hr>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </div>
            </div>
            <?php endif; ?>
            <?php if(count($prescription_tests) > 0): ?>
            <!-- ROW : Tests List -->
            <div class="row justify-content-center">
               <div class="col">
                  <strong><u><?php echo e(__('sentence.Test to do')); ?> </u></strong><br><br>
                  <?php $__currentLoopData = $prescription_tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><?php echo e($test->Test->test_name); ?> <?php if(empty(!$test->description)): ?> - <?php echo e($test->description); ?> <?php endif; ?></li>
                  <?php if($loop->last): ?>
                  <div style="margin-bottom: 150px;"></div>
                  <hr>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <hr>
               </div>
            </div>
            <!-- END ROW : Tests List -->
            <?php endif; ?>
            <?php if(!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right'))): ?>
            <!-- ROW : Footer informations -->
            <div class="row">
               <div class="col">
                  <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
               </div>
               <div class="col">
                  <p class="float-right font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
               </div>
            </div>
            <!-- END ROW : Footer informations -->
            <?php elseif(empty(App\Setting::get_option('footer_left'))): ?>
            <!-- ROW : Footer informations -->
            <div class="row">
               <div class="col">
                  <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
               </div>
            </div>
            <!-- END ROW : Footer informations -->
            <?php elseif(empty(App\Setting::get_option('footer_right'))): ?>
            <!-- ROW : Footer informations -->
            <div class="row">
               <div class="col">
                  <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
               </div>
            </div>
            <!-- END ROW : Footer informations -->
            <?php else: ?>
            <?php endif; ?>
         </div>
      </div>
   </div>
</div>
<!-- Hidden prescription -->
<div id="print_area" style="display: none;">
   <!-- ROW : Doctor informations -->
   <div class="row">
      <div class="col-9">
         <?php if(!empty(App\Setting::get_option('logo'))): ?>
         <img src="<?php echo e(asset('uploads/'.App\Setting::get_option('logo'))); ?>"><br><br>
         <?php endif; ?>
         <?php echo clean(App\Setting::get_option('header_left')); ?>

      </div>
      <div class="col-3">
         <?php echo e(__('sentence.On')); ?> <?php echo e($prescription->created_at->format('d M Y')); ?>

      </div>
   </div>
   <!-- END ROW : Doctor informations -->
   <hr>
   <!-- ROW : Patient informations -->
   <div class="row">
      <div class="col">
         <p>
            <b><?php echo e(__('sentence.Patient Name')); ?> :</b> <?php echo e($prescription->User->name); ?>

            <?php if(isset($prescription->User->Patient->birthday)): ?>
            - <b><?php echo e(__('sentence.Age')); ?> :</b> <?php echo e($prescription->User->Patient->birthday); ?> (<?php echo e(\Carbon\Carbon::parse($prescription->User->Patient->birthday)->age); ?> <?php echo e(__('sentence.Years')); ?>)
            <?php endif; ?>
            <?php if(isset($prescription->User->Patient->gender)): ?>
            - <b><?php echo e(__('sentence.Gender')); ?> :</b> <?php echo e(__('sentence.'.$prescription->User->Patient->gender)); ?>

            <?php endif; ?>
            <?php if(isset($prescription->User->Patient->weight)): ?>
            - <b><?php echo e(__('sentence.Patient Weight')); ?> :</b> <?php echo e($prescription->User->Patient->weight); ?> Kg
            <?php endif; ?>
            <?php if(isset($prescription->User->Patient->height)): ?>
            - <b><?php echo e(__('sentence.Patient Height')); ?> :</b> <?php echo e($prescription->User->Patient->height); ?>

            <?php endif; ?>
         </p>
         <hr>
         <h5 class="text-center"><b><?php echo e(__('sentence.Prescription')); ?></b></h5>
         <hr>
      </div>
   </div>
   <!-- END ROW : Patient informations -->
   <?php if(count($prescription_drugs) > 0): ?>
   <!-- ROW : Drugs List -->
   <div class="row justify-content-center">
      <div class="col">
         <?php $__currentLoopData = $prescription_drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <li><?php echo e($drug->type); ?> - <?php echo e($drug->Drug->trade_name); ?> <?php echo e($drug->strength); ?> - <?php echo e($drug->dose); ?> - <?php echo e($drug->duration); ?> <br> <?php echo e($drug->drug_advice); ?></li>
         <?php if($loop->last): ?>
         <div style="margin-bottom: 150px;"></div>
         <hr>
         <?php endif; ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
   </div>
   <?php endif; ?>
   <?php if(count($prescription_tests) > 0): ?>
   <!-- ROW : Tests List -->
   <div class="row justify-content-center">
      <div class="col">
         <strong><u><?php echo e(__('sentence.Test to do')); ?> </u></strong><br><br>
         <?php $__currentLoopData = $prescription_tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <li><?php echo e($test->Test->test_name); ?> <?php if(empty(!$test->description)): ?> - <?php echo e($test->description); ?> <?php endif; ?></li>
         <?php if($loop->last): ?>
         <div style="margin-bottom: 150px;"></div>
         <hr>
         <?php endif; ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <hr>
      </div>
   </div>
   <!-- END ROW : Tests List -->
   <?php endif; ?>
   <!-- ROW : Footer informations -->
   <footer style="position: absolute; bottom: 0;">
      <hr >
      <?php if(!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right'))): ?>
      <!-- ROW : Footer informations -->
      <div class="row">
         <div class="col">
            <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
         </div>
         <div class="col">
            <p class="float-right font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
         </div>
      </div>
      <!-- END ROW : Footer informations -->
      <?php elseif(empty(App\Setting::get_option('footer_left'))): ?>
      <!-- ROW : Footer informations -->
      <div class="row">
         <div class="col">
            <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
         </div>
      </div>
      <!-- END ROW : Footer informations -->
      <?php elseif(empty(App\Setting::get_option('footer_right'))): ?>
      <!-- ROW : Footer informations -->
      <div class="row">
         <div class="col">
            <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
         </div>
      </div>
      <!-- END ROW : Footer informations -->
      <?php else: ?>
      <?php endif; ?>
   </footer>
   <!-- END ROW : Footer informations -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
<style type="text/css">
   p, u, li {
   color: #444444 !important; 
   }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<script type="text/javascript">
   function printDiv(divName) {
      
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
   
     document.body.innerHTML = printContents;
   
     window.print();
   
     document.body.innerHTML = originalContents;
   }
   
   
   $(function(){
     $(document).on("click", '.print_prescription',function () {
        printDiv('print_area');
      });
   });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v4.0\resources\views/prescription/view.blade.php ENDPATH**/ ?>