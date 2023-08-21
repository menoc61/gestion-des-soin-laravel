<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.Create Invoice')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<form method="post" action="<?php echo e(route('billing.store')); ?>">
   <div class="row justify-content-center">
      <div class="col-md-4">
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Informations')); ?></h6>
            </div>
            <div class="card-body">
               <div class="form-group">
                  <label for="drug"><?php echo e(__('sentence.Select Patient')); ?></label>
                  <select class="form-control select2 select2-hidden-accessible" id="drug" tabindex="-1" name="patient_id" aria-hidden="true">
                     <option></option>
                     <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($patient->id); ?>"><?php echo e($patient->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <?php echo e(csrf_field()); ?>

               </div>
               <div class="form-group">
                  <label for="PaymentMode"><?php echo e(__('sentence.Payment Mode')); ?></label>
                  <select class="form-control" name="payment_mode" id="PaymentMode">
                     <option value="Cash"><?php echo e(__('sentence.Cash')); ?></option>
                     <option value="Cheque"><?php echo e(__('sentence.Cheque')); ?></option>
                  </select>
               </div>

               <div class="form-group">
                  <label for="DepositedAmount">Deposited Amount</label>
                  <input class="form-control" type="number" name="deposited_amount" id="DepositedAmount">
               </div>

               <div class="form-group">
                  <label for="DueAmount">Due Amount</label>
                  <input class="form-control" type="number" name="due_amount" id="DueAmount">
               </div>


               <div class="form-group">
                  <label for="PaymentMode"><?php echo e(__('sentence.Payment Status')); ?></label>
                  <select class="form-control" name="payment_status">
                     <option value="Paid"><?php echo e(__('sentence.Paid')); ?></option>
                     <option value="Partially Paid"><?php echo e(__('sentence.Partially Paid')); ?></option>
                     <option value="Unpaid"><?php echo e(__('sentence.Unpaid')); ?></option>
                  </select>
               </div>
               <div class="form-group">
                  <input type="submit" value="<?php echo e(__('sentence.Create Invoice')); ?>" class="btn btn-warning btn-block" align="center">
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-8">
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Invoice Details')); ?></h6>
            </div>
            <div class="card-body">
               <fieldset class="billing_labels">
                  <div class="repeatable"></div>
                  <div class="form-group">
                     <a type="button" class="btn btn-primary btn-sm add text-white" align="center"><i class='fa fa-plus'></i> <?php echo e(__('sentence.Add Item')); ?></a>
                  </div>
               </fieldset>
               <span class="float-right">Total excl. tax : <b id="total_without_tax_income">0 </b> <?php echo e(App\Setting::get_option('currency')); ?></span><br>
               <span class="float-right">VAT :  <?php echo e(App\Setting::get_option('vat')); ?> %</span><br>
               <span class="float-right">Total incl. tax : <b id="total_income">0 </b> <?php echo e(App\Setting::get_option('currency')); ?></span>
            </div>
         </div>
      </div>
   </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<script type="text/template" id="billing_labels">
   <div class="field-group row">
    <div class="col">
       <div class="form-group-custom">
          <input type="text" id="strength" name="invoice_title[]"  class="form-control" placeholder="<?php echo e(__('sentence.Invoice Title')); ?>" required>
       </div>
    </div>
    <div class="col">
       <div class="input-group mb-3">
        <input type="number" class="form-control" placeholder="<?php echo e(__('sentence.Amount')); ?>" aria-label="Amount" aria-describedby="basic-addon1" name="invoice_amount[]" required>

          <div class="input-group-append">
             <span class="input-group-text" id="basic-addon1"><?php echo e(App\Setting::get_option('currency')); ?></span>
          </div>
       </div>
    </div>
    <div class="col-md-3">
       <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"><i class="fa fa-times-circle"></i> <?php echo e(__('sentence.Remove')); ?></a>
    </div>
   </div>
</script>

<script type="text/javascript">
setInterval(function(){

$('.billing_labels').each(function(){
  var totalPoints = 0;
  var DepositedAmount = parseFloat($('#DepositedAmount').val());
  var DueAmount = 0;
  var vat = <?php echo e(App\Setting::get_option('vat')); ?>;

  $(this).find('input[aria-label="Amount"]').each(function(){
      if($(this).val() !== ''){
         totalPoints += parseFloat($(this).val()); //<==== a catch  in here !! read below
      }
  });

      $('#total_without_tax_income').text(totalPoints);
      $('#total_income').text(totalPoints+(totalPoints*vat/100));

      if($('#DepositedAmount').val() !== ''){
         $('#DueAmount').val((totalPoints+(totalPoints*vat/100))-DepositedAmount);
      }else{
         $('#DueAmount').val((totalPoints+(totalPoints*vat/100)));
      }

});

}, 1000);

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v3.4\resources\views/billing/create.blade.php ENDPATH**/ ?>