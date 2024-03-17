@extends('layouts.master')

@section('title')
    {{ __('sentence.Create Invoice') }}
@endsection

@section('content')
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <form method="post" action="{{ route('payment.store', ['id' => $billingId]) }}">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    {{-- <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Invoice Details') }}</h6>
                    </div> --}}
                    <div class="card-body">

                        <input type="text" class="billing_labels" value="{{$billing->due_amount}}" >

                        {{-- <fieldset class="billing_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button" class="btn btn-primary btn-sm add text-white" align="center"><i
                                        class='fa fa-plus'></i> {{ __('sentence.Add Item') }}</a>
                            </div>
                        </fieldset> --}}
                        <div class="d-flex justify-content-between ">
                    {{-- <span class="">Montant sans Taxe : <b id="total_without_tax_income">0 </b> {{ App\Setting::get_option('currency') }}</span><br>
                    <span class="">TVA : <b>{{ App\Setting::get_option('vat') }} %</b> </span><br>
                    <span class="">Montant Total : <b id="total_income">0 </b> {{ App\Setting::get_option('currency') }}</span> --}}
               </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Informations') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="drug">{{ __('sentence.Select Patient') }}</label>
                            <input type="hidden" class="form-control" name="patient_id"  value="{{ $users->id}}" readonly>
                            <input type="text" class="form-control" value="{{ $users->name}}" readonly>
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group">
                            <label for="drug">{{ __('sentence.Select Patient') }}</label>
                            <input type="text" class="form-control" name="billing_id" value="{{ $billingId}}" readonly>
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group">
                            <label for="PaymentMode">{{ __('sentence.Payment Mode') }}</label>
                            <select class="form-control" name="payment_mode" id="PaymentMode">
                                <option value="Cash">{{ __('sentence.Cash') }}</option>
                                <option value="Mobile Transaction">{{ __('sentence.Mobile Transaction') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="DueAmount">{{ __('sentence.Due Balance') }}</label>
                            <input class="form-control" type="number" name="reste_montant" value="{{$billing->due_amount}}" id="DueAmount" readonly>
                        </div>

                        <div class="form-group">
                            <label for="DepositedAmount">{{ __('sentence.Already Paid') }}</label>
                            <input class="form-control" type="number" name="montant_versé" id="DepositedAmount">
                        </div>


                        {{-- choix du statut de paiement --}}

                        {{-- <div class="form-group">
                  <label for="PaymentMode">{{ __('sentence.Payment Status') }}</label>
                  <select class="form-control" name="payment_status">
                     <option value="Paid">{{ __('sentence.Paid') }}</option>
                     <option value="Partially Paid">{{ __('sentence.Partially Paid') }}</option>
                     <option value="Unpaid">{{ __('sentence.Unpaid') }}</option>
                  </select>
               </div> --}}

                        <div class="form-group">
                            <input type="submit" value="{{ __('sentence.Pay Invoice') }}"
                                class="btn btn-success btn-block" align="center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer')
    <script type="text/template" id="billing_labels">
   <div class="field-group row">
    <div class="col">
       <div class="form-group-custom">
          <input type="text" id="strength" name="invoice_title[]"  class="form-control" placeholder="{{ __('sentence.Invoice Title') }}" onchange="updateInvoiceTitle()" required>
       </div>
    </div>
    <div class="col">
       <div class="input-group mb-3">
        <input type="number" class="form-control" placeholder="{{ __('sentence.Amount') }}" aria-label="Amount" aria-describedby="basic-addon1" name="invoice_amount[]" min="0" required>

          <div class="input-group-append">
             <span class="input-group-text" id="basic-addon1">{{ App\Setting::get_option('currency') }}</span>
          </div>
       </div>
    </div>
    <div class="col-md-3">
       <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"><i class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
    </div>
   </div>
</script>

    <script type="text/javascript">
        setInterval(function() {

            $('.billing_labels').each(function() {
                var totalPoints = 0;
                var DepositedAmount = parseFloat($('#DepositedAmount').val());
                var DueAmount = 0;
                //   var vat = {{ App\Setting::get_option('vat') }};

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
            $('.billing_labels').each(function() {
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
    </script>
    @endsection
