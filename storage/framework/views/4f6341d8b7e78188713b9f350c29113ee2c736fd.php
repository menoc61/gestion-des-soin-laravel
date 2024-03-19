<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Create Invoice')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-3">
        <button class="btn btn-primary" onclick="goBackAndReload()">Retour</button>
    </div>

    <form method="post" action="<?php echo e(route('payment.store', ['id' => $billingId])); ?>">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Invoice Details')); ?></h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="billing_labels">
                            <div class="repeatable">
                                <?php $__currentLoopData = $billing_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $billing_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="field-group row">
                                        <div class="col">
                                            <div class="form-group-custom">
                                                <input type="text" id="strength" name="nom[]" class="form-control"
                                                    placeholder="<?php echo e(__('sentence.Invoice Title')); ?>"
                                                    value="<?php echo e($billing_item->prescription_id); ?>" required>
                                                <input type="hidden" name="billing_item_id[]"
                                                    value="<?php echo e($billing_item->id); ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control"
                                                    placeholder="<?php echo e(__('sentence.Amount')); ?>"
                                                    aria-describedby="basic-addon1" name="invoice_amount[]"
                                                    value="<?php echo e($billing_item->invoice_amount); ?>" required readonly>

                                                <div class="input-group-append">
                                                    <span class="input-group-text"
                                                        id="basic-addon1"><?php echo e(App\Setting::get_option('currency')); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"><i
                                                    class="fa fa-times-circle"></i> <?php echo e(__('sentence.Remove')); ?></a>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                        </fieldset>
                        

                        
                    </div>
                </div>
            </div>

            <div class="col-md-6 tests">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Informations')); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="PatientID"><?php echo e(__('sentence.Patient')); ?> :</label>
                            <option value="<?php echo e($billing->user_id); ?>"><?php echo e($billing->User->name); ?> -
                                <?php echo e(\Carbon\Carbon::parse($billing->User->Patient->birthday)->age); ?> Years</option>
                            <input type="hidden" name="patient_id" value="<?php echo e($billing->user_id); ?>">
                            <input type="hidden" name="billing_id" value="<?php echo e($billing->id); ?>">
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
                            <label for="DepositedAmount"><?php echo e(__('sentence.Already Paid')); ?></label>
                            <input type="number" class="form-control" aria-label="Amount"
                                value="<?php echo e($billing->due_amount); ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="DepositedAmount"><?php echo e(__('sentence.Already Paid')); ?></label>
                            <input class="form-control" type="number" name="deposited_amount" id="DepositedAmount"
                                value="<?php echo e($billing->due_amount); ?>">
                        </div>

                        <div class="form-group">
                            <label for="DueAmount"><?php echo e(__('sentence.Due Balance')); ?></label>
                            <input class="form-control" type="number" name="due_amount" id="DueAmount" readonly>
                        </div>


                        

                        

                        <div class="form-group">
                            <input type="submit" value="<?php echo e(__('sentence.Update Invoice')); ?>"
                                class="btn btn-success btn-block" align="center">
                        </div>
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
          <input type="text" id="strength" name="nom[]"  class="form-control" placeholder="<?php echo e(__('sentence.Invoice Title')); ?>"  required>
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
        setInterval(function() {

            $('.tests').each(function() {
                var totalPoints = 0;
                var DepositedAmount = parseFloat($('#DepositedAmount').val());
                var DueAmount = 0;
                //   var vat = <?php echo e(App\Setting::get_option('vat')); ?>;

                $(this).find('input[aria-label="Amount"]').each(function() {
                    if ($(this).val() !== '') {
                        totalPoints += parseFloat($(this)
                            .val()); //<==== a catch  in here !! read below
                    }
                });

                $('#total_without_tax_income').text(totalPoints);
                //   $('#total_income').text(totalPoints+(totalPoints*vat/100));

                if ($('#DepositedAmount').val() !== '') {
                    $('#DueAmount').val((totalPoints) - DepositedAmount);
                } else {
                    $('#DueAmount').val((totalPoints));
                }

            });

        }, 1000);
    </script>
    <script type="text/javascript">
        // Function to update the invoice title when a patient is selected
        function updateInvoiceTitle() {
            var selectedPatientName = $('#drug option:selected').text();
            var invoiceTitle = "diagnostic de " + selectedPatientName;
            $('input[name="invoice_title[]"]').val(invoiceTitle);
        }

        // Add onchange event to the patient select input
        $('#drug').on('change', function() {
            updateInvoiceTitle();
        });

        // Initial auto-fill when the page loads
        updateInvoiceTitle();

        setInterval(function() {
            $('.tests').each(function() {
                var totalPoints = 0;
                var DepositedAmount = parseFloat($('#DepositedAmount').val());
                var DueAmount = 0;

                $(this).find('input[aria-label="Amount"]').each(function() {
                    if ($(this).val() !== '') {
                        totalPoints += parseFloat($(this).val());
                    }
                });

                $('#total_without_tax_income').text(totalPoints);

                if ($('#DepositedAmount').val() !== '') {
                    $('#DueAmount').val(totalPoints - DepositedAmount);
                } else {
                    $('#DueAmount').val(totalPoints);
                }

            });

        }, 1000);


        function goBackAndReload() {
            window.location.replace(document.referrer);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\HS\gestion-des-soin-laravel\resources\views/billing/payment.blade.php ENDPATH**/ ?>