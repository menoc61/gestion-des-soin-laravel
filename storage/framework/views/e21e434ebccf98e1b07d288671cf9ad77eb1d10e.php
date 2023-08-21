<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.View billing')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800"></h1>
   <button href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm print_prescription"><i class="fas fa-print fa-sm text-white-50"></i> Print</button>
</div>
<div class="row justify-content-center" id="stylesheetd">
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
               <div class="col-4">
                  <p><b><?php echo e(__('sentence.Date')); ?> :</b> <?php echo e($billing->created_at->format('d M Y')); ?><br>
                     <b><?php echo e(__('sentence.Reference')); ?> :</b> <?php echo e($billing->reference); ?><br>
                     <b><?php echo e(__('sentence.Patient Name')); ?> :</b> <?php echo e($billing->User->name); ?>

                  </p>
               </div>
            </div>
            <!-- END ROW : Doctor informations -->
            <!-- ROW : Drugs List -->
            <div class="row justify-content-center">
               <div class="col">
                  <h5 class="text-center mt-5"><b><?php echo e(__('sentence.Invoice')); ?></b></h5>
                  <br><br>
                  <table class="table">
                     <tr style="background: #2e3f50; color: #fff;">
                        <td width="10%">#</td>
                        <td width="60%"><?php echo e(__('sentence.Item')); ?></td>
                        <td width="30%" align="center"><?php echo e(__('sentence.Amount')); ?></td>
                     </tr>
                     <?php $__empty_1 = true; $__currentLoopData = $billing_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $billing_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                     <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($billing_item->invoice_title); ?></td>
                        <td align="center"><?php echo e($billing_item->invoice_amount); ?> <?php echo e(App\Setting::get_option('currency')); ?></td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                     <tr>
                        <td colspan="3"><?php echo e(__('sentence.Empty Invoice')); ?></td>
                     </tr>
                     <?php endif; ?>
                     <?php if(empty(!$billing_item)): ?>
                     <?php if(App\Setting::get_option('vat') > 0): ?>
                     <tr>
                        <td colspan="2"><strong class="float-right"><?php echo e(__('sentence.Sub-Total')); ?></strong></td>
                        <td align="center"><strong><?php echo e($billing_items->sum('invoice_amount')); ?>  <?php echo e(App\Setting::get_option('currency')); ?></strong></td>
                     </tr>
                     <tr>
                        <td colspan="2"><strong class="float-right"><?php echo e(__('sentence.VAT')); ?></strong></td>
                        <td align="center"><strong> <?php echo e(App\Setting::get_option('vat')); ?>%</strong></td>
                     </tr>
                     <?php endif; ?>
                     <tr>
                        <td colspan="2"><strong class="float-right"><?php echo e(__('sentence.Total')); ?></strong></td>
                        <td align="center"><strong><?php echo e($billing_items->sum('invoice_amount') + ($billing_items->sum('invoice_amount') * App\Setting::get_option('vat')/100)); ?>  <?php echo e(App\Setting::get_option('currency')); ?></strong></td>
                     </tr>
                     <?php endif; ?>
                  </table>
                  
               </div>
            </div>
                  <div style="margin-bottom: 250px;"></div>

            <!-- END ROW : Drugs List -->
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
         </div>
      </div>
   </div>
</div>

<!-- Hidden invoice -->
 <div id="print_area" style="display: none;">
                                 <div class="row">
                                    <div class="col-9">
                                       <?php if(!empty(App\Setting::get_option('logo'))): ?>
                                       <img src="<?php echo e(asset('uploads/'.App\Setting::get_option('logo'))); ?>"><br><br>
                                       <?php endif; ?>
                                       <?php echo clean(App\Setting::get_option('header_left')); ?>

                                    </div>
                                    <div class="col-3">
                                       <p class="float-right"><b><?php echo e(__('sentence.Date')); ?> :</b> <?php echo e($billing->created_at->format('d M Y')); ?><br>
                                          <b><?php echo e(__('sentence.Reference')); ?> :</b> <?php echo e($billing->reference); ?><br>
                                          <b><?php echo e(__('sentence.Patient Name')); ?> :</b> <?php echo e($billing->User->name); ?>

                                       </p>
                                    </div>
                                 </div>
                                 <!-- END ROW : Doctor informations -->
                                 <!-- ROW : Drugs List -->
                                 <div class="row justify-content-center">
                                    <div class="col">
                                       
                                       <h5 class="text-center mt-5"><b><?php echo e(__('sentence.Invoice')); ?></b></h5>
                                       <br><br>
                                       <table class="table">
                                          <tr >
                                             <td width="10%"><b>#</b></td>
                                             <td width="60%"><b><?php echo e(__('sentence.Item')); ?></b></td>
                                             <td width="30%" align="center"><b style="font-weight:bold;"><?php echo e(__('sentence.Amount')); ?></b></td>
                                          </tr>
                                          <?php $__empty_1 = true; $__currentLoopData = $billing_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $billing_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                          <tr>
                                             <td><?php echo e($key+1); ?></td>
                                             <td><?php echo e($billing_item->invoice_title); ?></td>
                                             <td align="center"><?php echo e($billing_item->invoice_amount); ?> <?php echo e(App\Setting::get_option('currency')); ?></td>
                                          </tr>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                          <tr>
                                             <td colspan="3"><?php echo e(__('sentence.Empty Invoice')); ?></td>
                                          </tr>
                                          <?php endif; ?>
                                          <?php if(empty(!$billing_item)): ?>
                                          <?php if(App\Setting::get_option('vat') > 0): ?>
                                          <tr>
                                             <td colspan="2"><strong class="float-right"><?php echo e(__('sentence.Sub-Total')); ?></strong></td>
                                             <td align="center"><strong><?php echo e($billing_items->sum('invoice_amount')); ?>  <?php echo e(App\Setting::get_option('currency')); ?></strong></td>
                                          </tr>
                                          <tr>
                                             <td colspan="2"><strong class="float-right"><?php echo e(__('sentence.VAT')); ?></strong></td>
                                             <td align="center"><strong> <?php echo e(App\Setting::get_option('vat')); ?>%</strong></td>
                                          </tr>
                                          <?php endif; ?>
                                          <tr>
                                             <td colspan="2"><strong class="float-right"><?php echo e(__('sentence.Total')); ?></strong></td>
                                             <td align="center"><strong><?php echo e($billing_items->sum('invoice_amount') + ($billing_items->sum('invoice_amount') * App\Setting::get_option('vat')/100)); ?>  <?php echo e(App\Setting::get_option('currency')); ?></strong></td>
                                          </tr>
                                          <?php endif; ?>
                                       </table>
                                       <hr>
                                    </div>
                                 </div>
                               
                                 <!-- END ROW : Drugs List -->
                                 <!-- ROW : Footer informations -->
                                 <footer class="footer-nassim" style="position: absolute; bottom: 0;">
                                    <hr>
                                    <div class="row">
                                       <div class="col-6">
                                          <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                                       </div>
                                       <div class="col-6">
                                          <p class="float-right font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                                       </div>
                                    </div>
                                    <!-- END ROW : Footer informations -->
                                 </footer>
                              </div>
                        
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link href="<?php echo e(asset('css/print.css')); ?>" rel="stylesheet"  media="all">

<style type="text/css">
   p, u, li {
      color: #444444 !important; 
   }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<script type="text/javascript">
   function PrintPreview(divName) {
      
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}


$(function(){
     $(document).on("click", '.print_prescription',function () {
        PrintPreview('print_area');
        /* 
        $('#print_area').printThis({
         importCSS: true,
                importStyle: true,//thrown in for extra measure 
         loadCSS: "<?php echo e(asset('dashboard/css/sb-admin-2.min.css')); ?>",
         pageTitle: "xxx", 
         copyTagClasses: true, 
          base: true, 
          printContainer: true, 
          removeInline: false,  
        });
        */

      });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v3.4\resources\views/billing/view.blade.php ENDPATH**/ ?>