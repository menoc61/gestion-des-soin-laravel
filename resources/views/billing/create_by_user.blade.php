@extends('layouts.master')

@section('title')
    {{ __('sentence.Create Invoice') }}
@endsection

@section('content')
    <div class="mb-3">
        <button class="btn btn-primary" onclick="goBackAndReload()">Retour</button>
    </div>

    <form method="post" action="{{ route('billing.store_id', ['id' => $userId]) }}">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="col-md-6">
                    @forelse ($appointments as $appointment)
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">{{ $appointment->reason }}</h6>
                            </div>
                            <div class="card-body">
                                <h6 class="m-0 font-weight-bold text-primary">{{ $appointment->reason }}</h6>
                                <h6 class="m-0 font-weight-bold text-primary">
                                    Total: {{ $appointment->drugs->sum('amountDrug') }}
                                </h6>
                                <button type="button" class="btn btn-primary select-appointment"
                                    data-appointment-id="{{ $appointment->reason }}"
                                    data-amount="{{ $appointment->drugs->sum('amountDrug') }}">Select</button>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" align="center"><img src="{{ asset('img/not-found.svg') }}" width="200" />
                                <br><br>
                                <b class="text-muted">{{ __('sentence.No appointment available') }}</b>
                            </td>
                        </tr>
                    @endforelse
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
                            <input type="hidden" class="form-control" value="{{ $userId }}" name="patient_id"
                                readonly>
                            <input type="text" class="form-control" value="{{ $userName }}" readonly>
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
                            <label for="DepositedAmount">{{ __('sentence.Already Paid') }}</label>
                            <input class="form-control" type="number" name="deposited_amount" id="DepositedAmount">
                        </div>
                        <div class="form-group">
                            <label for="DueAmount">{{ __('sentence.Due Balance') }}</label>
                            <input class="form-control" type="number" name="due_amount" id="DueAmount">
                        </div>

                        <div id="selected-appointments">
                            <!-- Selected appointments will be displayed here -->
                        </div>

                        <div class="form-group">
                            <label for="TotalAmount">{{ __('sentence.Total Amount') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('sentence.Amount') }}"
                                aria-label="Amount" aria-describedby="basic-addon1" name="invoice_amount[]" id="TotalAmount"
                                readonly min="0">
                        </div>

                        <div class="form-group">
                            <label for="SelectedAppointments">{{ __('sentence.Selected Appointments') }}</label>
                            <input type="text" class="form-control" name="nom[]"
                                id="SelectedAppointments" readonly>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="{{ __('sentence.Create Invoice') }}"
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

        {{-- <select class="form-control multiselect-search" name="nom[]" id="prescription" tabindex="-1" aria-hidden="true" required>
            @if (@empty($prescriptions))
                <option value="">{{ __('sentence.Select Test') }}...</option>
            @else
            @foreach($prescriptions as $prescription)
            @if (Auth::user()->role_id == 2 && Auth::user()->id == $prescription->doctor_id )
                <option value="{{ $prescription->id }}">{{ $prescription->nom }}</option>
            @elseif (Auth::user()->role_id == 1)
                <option value="{{ $prescription->id }}">{{ $prescription->nom }}</option>
            @endif
        @endforeach
            @endif

          </select> --}}
          {{-- <input type="text" id="strength" name="nom[]"  class="form-control" placeholder="{{ __('sentence.Invoice Title') }}" onchange="updateInvoiceTitle()" required> --}}
       </div>
    </div>
    <div class="col">
       <div class="input-group mb-3">
        <input type="number" class="form-control" placeholder="{{ __('sentence.Amount') }}" aria-label="Amount" aria-describedby="basic-addon1" name="invoice_amount[]" required min="0">

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
        $(document).ready(function() {
            var totalAmount = 0;
            var selectedAppointments = [];

            $('.select-appointment').on('click', function() {
                var $button = $(this);
                var amount = parseFloat($button.data('amount'));
                var appointmentId = $button.data('appointment-id');
                var card = $button.closest('.card').clone();

                if ($button.hasClass('selected')) {
                    // Deselect and subtract the amount
                    totalAmount -= amount;
                    $button.removeClass('selected');
                    $button.text('Select');
                    $('#selected-appointments').find(`[data-appointment-id="${appointmentId}"]`).remove();
                    selectedAppointments = selectedAppointments.filter(id => id !== appointmentId);
                } else {
                    // Select and add the amount
                    totalAmount += amount;
                    $button.addClass('selected');
                    $button.text('Deselect');
                    card.find('.select-appointment').remove();
                    card.attr('data-appointment-id', appointmentId);
                    card.append(
                        '<button type="button" class="btn btn-danger remove-appointment">Supprimer</button>'
                        );
                    $('#selected-appointments').append(card);
                    selectedAppointments.push(appointmentId);
                }

                // Update the total amount input
                $('#TotalAmount').val(totalAmount.toFixed(2));
                // Update the selected appointments input
                $('#SelectedAppointments').val(selectedAppointments.join(', '));
            });

            $(document).on('click', '.remove-appointment', function() {
                var card = $(this).closest('.card');
                var appointmentId = card.data('appointment-id');
                var $button = $(`.select-appointment[data-appointment-id="${appointmentId}"]`);
                var amount = parseFloat($button.data('amount'));

                totalAmount -= amount;
                $button.removeClass('selected');
                $button.text('Select');
                card.remove();
                selectedAppointments = selectedAppointments.filter(id => id !== appointmentId);

                // Update the total amount input
                $('#TotalAmount').val(totalAmount.toFixed(2));
                // Update the selected appointments input
                $('#SelectedAppointments').val(JSON.stringify(selectedAppointments));
            });
        });
    </script>


    {{-- <script type="text/javascript">
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
    </script> --}}

    <script type="text/javascript">
        // Function to update the invoice title when a patient is selected
        function updateInvoiceTitle() {
            var selectedPatientName = $('#drug option:selected').text();
            var invoiceTitle = "diagnostic de " + selectedPatientName;
            $('input[name="nom[]"]').val(invoiceTitle);
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

        function goBackAndReload() {
            window.location.replace(document.referrer);
        }
    </script>
@endsection
