@extends('layouts.master')

@section('title')
    {{ __('sentence.Edit Invoice') }}
@endsection

@section('content')
    <div class="">
        <div class="mb-3">
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-12">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-center"> {{ __('sentence.Edit Invoice') }}

                    </h2>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('billing.update') }}">
        <div class="row justify-content-center my-4">
            <div class="col-md-6">
                <div class="row">
                    @forelse ($appointments as $appointment)
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h6 class="m-0 font-weight-bold text-primary">{{ $appointment->reason }}</h6>
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        Total: {{ $appointment->drugs->sum('amountDrug') }}
                                    </h6>
                                    <button type="button" class="btn badge badge-primary-soft select-appointment"
                                        data-appointment-id="{{ $appointment->id }}"
                                        data-amount="{{ $appointment->drugs->sum('amountDrug') }}">Payer</button>
                                </div>
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
                            <input class="form-control" type="number" name="due_amount" id="DueAmount" readonly>
                        </div>

                        <div class="form-group">
                            <label for="TotalAmount">{{ __('sentence.Total Amount') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('sentence.Amount') }}"
                                aria-label="Amount" aria-describedby="basic-addon1" name="total_amount" id="TotalAmount"
                                readonly min="0">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="{{ __('sentence.Create Invoice') }}"
                                class="btn btn-success btn-block" align="center">
                        </div>
                    </div>
                </div>
                <input type="hidden" id="selected-appointments">
            </div>
        </div>
    </form>
@endsection

{{-- @section('content') --}}
    {{-- <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div> --}}
    {{-- <form method="post" action="{{ route('billing.update') }}">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Invoice Details') }}</h6>
                    </div>
                    <div class="card-body">
                        {{-- <fieldset class="billing_labels">
                            <div class="repeatable">
                                @foreach ($billing_items as $billing_item)
                                    <div class="field-group row">
                                        <div class="col">
                                            <div class="form-group-custom">
                                                <input type="text" id="strength" name="invoice_title[]"
                                                    class="form-control" placeholder="{{ __('sentence.Invoice Title') }}"
                                                    value="{{ $billing_item->invoice_title }}" required>
                                                <input type="hidden" name="billing_item_id[]"
                                                    value="{{ $billing_item->id }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control"
                                                    placeholder="{{ __('sentence.Amount') }}" aria-label="Amount"
                                                    aria-describedby="basic-addon1" name="invoice_amount[]"
                                                    value="{{ $billing_item->invoice_amount }}" min="0" required>

                                                <div class="input-group-append">
                                                    <span class="input-group-text"
                                                        id="basic-addon1">{{ App\Setting::get_option('currency') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"><i
                                                    class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn btn-primary btn-sm add text-white" align="center"><i
                                        class='fa fa-plus'></i> {{ __('sentence.Add Item') }}</a>
                            </div>
                        </fieldset> --}}
                        {{-- information concernant la TVA, le prix avec TVA et prix sans TVA --}}

                        {{-- <div class="d-flex justify-content-between ">
                            <span class="">Montant sans Taxe : <b id="total_without_tax_income">0 </b>
                                {{ App\Setting::get_option('currency') }}</span><br>
                            <span class="">TVA : <b>{{ App\Setting::get_option('vat') }} %</b> </span><br>
                            <span class="">Montant Total : <b id="total_income">0 </b>
                                {{ App\Setting::get_option('currency') }}</span>
                        </div> --}}
                    {{-- </div>
                </div>
            </div> --}}

            {{-- <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Informations') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="PatientID">{{ __('sentence.Patient') }} :</label>
                            <option value="{{ $billing->user_id }}">{{ $billing->User->name }} -
                                {{ \Carbon\Carbon::parse($billing->User->Patient->birthday)->age }} Years</option>
                            <input type="hidden" name="patient_id" value="{{ $billing->user_id }}">
                            <input type="hidden" name="billing_id" value="{{ $billing->id }}">
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group">
                            <label for="PaymentMode">{{ __('sentence.Payment Mode') }}</label>
                            <select class="form-control" name="payment_mode" id="PaymentMode">
                                <option value="Cash">{{ __('sentence.Cash') }}</option>
                                <option value="Cheque">{{ __('sentence.Cheque') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="DepositedAmount">{{ __('sentence.Already Paid') }}</label>
                            <input class="form-control" type="number" name="deposited_amount" id="DepositedAmount"
                                value="{{ $billing->deposited_amount }}">
                        </div>

                        <div class="form-group">
                            <label for="DueAmount">{{ __('sentence.Due Balance') }}</label>
                            <input class="form-control" type="number" name="due_amount" id="DueAmount">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="{{ __('sentence.Update Invoice') }}"
                                class="btn btn-success btn-block" align="center">
                        </div>
                    </div>
                </div>
            </div> --}}
        {{-- </div>
    </form>  --}}
{{-- @endsection --}}


@section('footer')
    <script type="text/javascript">
        $(document).ready(function() {
            var totalAmount = 0;

            function updateAmounts() {
                $('#TotalAmount').val(totalAmount.toFixed(2));
                var depositedAmount = parseFloat($('#DepositedAmount').val()) || 0;
                $('#DueAmount').val((totalAmount - depositedAmount).toFixed(2));
            }

            $('.select-appointment').on('click', function() {
                var $button = $(this);
                var amount = parseFloat($button.data('amount'));
                var appointmentId = $button.data('appointment-id');

                if ($button.hasClass('selected')) {
                    // Deselect and subtract the amount
                    totalAmount -= amount;
                    $button.removeClass('selected badge-danger-soft').addClass('badge-primary-soft');
                    $button.text('Payer');
                    $('#selected-appointments').find(
                        `.selected-appointment[data-appointment-id="${appointmentId}"]`).remove();
                } else {
                    // Select and add the amount
                    totalAmount += amount;
                    $button.addClass('selected badge-danger-soft').removeClass('b badge-primary-soft');
                    $button.text('Retirer');
                    $('#selected-appointments').append(`<div class="selected-appointment" data-appointment-id="${appointmentId}">
                        <input type="hidden" name="nom[]" value="${appointmentId}">
                        <input type="hidden" name="invoice_amount[]" value="${amount}">
                    </div>`);
                }

                // Update the total and due amounts
                updateAmounts();
            });

            $(document).on('click', '.remove-appointment', function() {
                var card = $(this).closest('.selected-appointment');
                var appointmentId = card.data('appointment-id');
                var amount = parseFloat($(`.select-appointment[data-appointment-id="${appointmentId}"]`)
                    .data('amount'));

                totalAmount -= amount;
                $(`.select-appointment[data-appointment-id="${appointmentId}"]`).removeClass(
                        'selected btn-danger')
                    .addClass('btn-primary').text('Payer');
                card.remove();

                // Update the total and due amounts
                updateAmounts();
            });

            $('#DepositedAmount').on('input', function() {
                // Update due amount when deposited amount is entered
                updateAmounts();
            });
        });

        function goBackAndReload() {
            window.location.replace(document.referrer);
        }
    </script>
@endsection
