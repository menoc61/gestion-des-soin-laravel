<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Doctorino - <?php echo e(__('sentence.View Invoice')); ?> 
      </title>
      <!-- Custom styles for this template-->
      <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
   </head>
   <body id="page-top">
      <div id="app">
         <!-- Page Wrapper -->
         <div id="wrapper">
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
               <!-- Main Content -->
               <div id="content">
                  <!-- Begin Page Content -->
                  <div class="container-fluid">
                     <div class="row justify-content-center">
                        <div class="col">
                           <div class="card shadow mb-4">
                              <div class="card-body">
                                 <!-- ROW : Doctor informations -->
                                 <div class="row">
                                    <div class="col-md-9">
                                       <?php echo clean(App\Setting::get_option('header_left')); ?>

                                    </div>
                                    <div class="col-md-3">
                                       <p class="float-right"><b><?php echo e(__('sentence.Date')); ?> :</b> <?php echo e($billing->created_at->format('d-m-Y')); ?><br>
                                          <b><?php echo e(__('sentence.Reference')); ?> :</b> <?php echo e($billing->reference); ?><br>
                                          <b><?php echo e(__('sentence.Patient Name')); ?> :</b> <?php echo e($billing->User->name); ?>

                                       </p>
                                    </div>
                                 </div>
                                 <!-- END ROW : Doctor informations -->
                                 <!-- ROW : Drugs List -->
                                 <div class="row justify-content-center">
                                    <div class="col">
                                       <hr>
                                       <h5 class="text-center"><b><?php echo e(__('sentence.Invoice')); ?></b></h5>
                                       <br><br>
                                       <table class="table">
                                          <tr>
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
                                             <td colspan="2"><strong><?php echo e(__('sentence.Sub-Total')); ?></strong></td>
                                             <td align="center"><strong><?php echo e($billing_items->sum('invoice_amount')); ?>  <?php echo e(App\Setting::get_option('currency')); ?></strong></td>
                                          </tr>
                                          <tr>
                                             <td colspan="2"><strong><?php echo e(__('sentence.VAT')); ?></strong></td>
                                             <td align="center"><strong> <?php echo e(App\Setting::get_option('vat')); ?>%</strong></td>
                                          </tr>
                                          <?php endif; ?>
                                          <tr>
                                             <td colspan="2"><strong><?php echo e(__('sentence.Total')); ?></strong></td>
                                             <td align="center"><strong><?php echo e($billing_items->sum('invoice_amount') + ($billing_items->sum('invoice_amount') * App\Setting::get_option('vat')/100)); ?>  <?php echo e(App\Setting::get_option('currency')); ?></strong></td>
                                          </tr>
                                          <?php endif; ?>
                                       </table>
                                       <hr>
                                    </div>
                                 </div>
                                 <!-- ROW : Drugs List -->
                                 <div class="row justify-content-center">
                                    <div class="col">
                                    </div>
                                 </div>
                                 <!-- END ROW : Drugs List -->
                                 <!-- ROW : Footer informations -->
                                 <footer class="footer-nassim">
                                    <hr>
                                    <div class="row">
                                       <div class="col-md-6">
                                          <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                                       </div>
                                       <div class="col-md-6">
                                          <p class="float-right font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                                       </div>
                                    </div>
                                    <!-- END ROW : Footer informations -->
                                 </footer>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.container-fluid -->
               </div>
               <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->
         </div>
         <!-- End of Page Wrapper -->
      </div>
   </body>
</html><?php /**PATH C:\xampp\htdocs\doctorino\v3.4\resources\views/billing/pdf_view.blade.php ENDPATH**/ ?>