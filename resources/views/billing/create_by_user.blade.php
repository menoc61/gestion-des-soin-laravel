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
                    <h2 class="m-0 font-weight-bold text-center"> {{ __('sentence.Create Invoice') }} De
                        <span class="m-0 font-weight-bold text-primary text-center">{{ $userName }}</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('billing.store_id', ['id' => $userId]) }}">
        <div class="row justify-content-center my-4">
            <div class="col-md-6">
                <div class="row">
                    @forelse ($appointments as $appointment)
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h6 class="m-0 font-weight-bold text-secondary">{{ $appointment->id }}</h6>
                                        </div>
                                        <div class="col-md-9">
                                            <h6 class="m-0 font-weight-bold text-secondary float-right">{{ $appointment->date->format('d M Y') }}</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    @forelse ($appointment->drugs as $drug)
                                        <div class="row my-4">
                                            <div class="col-md-6">
                                                <h6 class="m-0 font-weight-bold text-primary">
                                                    {{ $drug->trade_name }} : </h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="m-0 font-weight-bold text-primary">
                                                    {{ $drug->amountDrug }} {{ App\Setting::get_option('currency') }}
                                                </h6>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="5" align="center"><img src="{{ asset('img/not-found.svg') }}"
                                                    width="200" />
                                                <br><br>
                                                <b class="text-muted">{{ __('sentence.No appointment available') }}</b>
                                            </td>
                                        </tr>
                                    @endforelse
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="button" class="btn badge badge-primary-soft select-appointment"
                                                data-appointment-id="{{ $appointment->id }}"
                                                data-amount="{{ $appointment->drugs->sum('amountDrug') }}">Payer</button>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="m-0 font-weight-bold text-primary">
                                                Total: {{ $appointment->drugs->sum('amountDrug') }}
                                                {{ App\Setting::get_option('currency') }}
                                            </h6>
                                        </div>
                                    </div>
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
                {{-- @if ($appointments->isNotEmpty())
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Somme totale des soins :
                                {{ $appointments->pluck('drugs')->flatten()->sum('amountDrug') }}
                                {{ App\Setting::get_option('currency') }}
                            </h6>
                        </div>
                    </div>
                @endif --}}
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Informations') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="drug">{{ __('sentence.Select Patient') }}</label>
                                <input type="hidden" class="form-control" value="{{ $userId }}" name="patient_id"
                                    readonly>
                                <input type="text" class="form-control" value="{{ $userName }}" readonly>
                                {{ csrf_field() }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="PaymentMode">{{ __('sentence.Payment Mode') }}</label>
                                <select class="form-control" name="payment_mode" id="PaymentMode">
                                    <option value="Cash">{{ __('sentence.Cash') }}</option>
                                    <option value="Mobile Transaction">{{ __('sentence.Mobile Transaction') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="TotalAmount">{{ __('sentence.Total Amount') }}</label>
                                <input type="number" class="form-control" placeholder="{{ __('sentence.Amount') }}"
                                    aria-label="Amount" aria-describedby="basic-addon1" name="total_amount" id="TotalAmount"
                                    readonly min="0">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Remise">{{ __('sentence.Remise') }}</label>
                                <input class="form-control" type="number" min="0" value="0" name="Remise"
                                    id="Remise">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="DepositedAmount">{{ __('sentence.Already Paid') }}</label>
                                <input class="form-control" type="number" value="0" name="deposited_amount"
                                    id="DepositedAmount">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="DueAmount">{{ __('sentence.Due Balance') }}</label>
                                <input class="form-control" type="number" name="due_amount" id="DueAmount" readonly>
                            </div>
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

@section('footer')
    <script type="text/javascript">
        $(document).ready(function() {
            var totalAmount = 0;

            function updateAmounts() {
                var remise = parseFloat($('#Remise').val()) || 0;
                var depositedAmount = parseFloat($('#DepositedAmount').val()) || 0;
                var finalAmount = totalAmount - remise;
                $('#TotalAmount').val(finalAmount);
                $('#DueAmount').val((finalAmount - depositedAmount));
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
                    $button.addClass('selected badge-danger-soft').removeClass('badge-primary-soft');
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

            $('#DepositedAmount, #Remise').on('input', function() {
                // Update due amount when deposited amount or remise is entered
                updateAmounts();
            });
        });

        function goBackAndReload() {
            window.location.replace(document.referrer);
        }
    </script>
@endsection
