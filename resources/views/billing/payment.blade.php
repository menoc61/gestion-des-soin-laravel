@extends('layouts.master')

@section('title')
    {{ __('sentence.Create Invoice') }}
@endsection

@section('content')
    <div class="">
        <div class="mb-3">
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-12">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-center"> {{ __('sentence.Buy billing') }} De
                        <span class="m-0 font-weight-bold text-primary text-center">{{ $users->name }}</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('payment.store', ['id' => $billing->id]) }}">
        {{ csrf_field() }}
        <div class="row justify-content-center my-4">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Invoice Details') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="payment_amount">{{ __('Montant du paiement') }}</label>
                            <input type="number" class="form-control" id="deposited_amount" name="deposited_amount"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="payment_date">{{ __('Date du paiement') }}</label>
                            <input type="date" class="form-control" id="payment_date" name="payment_date"
                                value="{{ now()->toDateString() }}" required readonly>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="{{ __('sentence.Buy billing') }}" class="btn btn-success btn-block"
                                align="center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

{{-- @section('footer')
    <script type="text/template" id="billing_labels">
   <div class="field-group row">
    <div class="col">
       <div class="form-group-custom">
          <input type="text" id="strength" name="nom[]"  class="form-control" placeholder="{{ __('sentence.Invoice Title') }}"  required>
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

            $('.tests').each(function() {
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
@endsection --}}

@section('footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let totalAmount = 0;
            let selectedAppointments = [];

            document.querySelectorAll('.select-appointment').forEach(button => {
                button.addEventListener('click', function() {
                    const appointmentId = this.dataset.appointmentId;
                    const amount = parseFloat(this.dataset.amount);

                    if (selectedAppointments.includes(appointmentId)) {
                        selectedAppointments = selectedAppointments.filter(id => id !==
                            appointmentId);
                        totalAmount -= amount;
                        this.classList.remove('btn-danger');
                        this.classList.add('btn-primary');
                        this.textContent = 'Payer';
                    } else {
                        selectedAppointments.push(appointmentId);
                        totalAmount += amount;
                        this.classList.remove('btn-primary');
                        this.classList.add('btn-danger');
                        this.textContent = 'Retirer';
                    }

                    document.getElementById('TotalAmount').value = totalAmount;
                    document.getElementById('selected-appointments').value = selectedAppointments
                        .join(',');
                    updateDueAmount();
                });
            });

            document.getElementById('DepositedAmount').addEventListener('input', updateDueAmount);
            document.getElementById('Remise').addEventListener('input', updateDueAmount);
            document.getElementById('PaymentAmount').addEventListener('input', updateDueAmount);

            function updateDueAmount() {
                const totalAmount = parseFloat(document.getElementById('TotalAmount').value) || 0;
                const depositedAmount = parseFloat(document.getElementById('DepositedAmount').value) || 0;
                const paymentAmount = parseFloat(document.getElementById('PaymentAmount').value) || 0;
                const remise = parseFloat(document.getElementById('Remise').value) || 0;

                const dueAmount = totalAmount - depositedAmount - paymentAmount - remise;
                document.getElementById('DueAmount').value = dueAmount;
            }
        });
    </script>
@endsection
