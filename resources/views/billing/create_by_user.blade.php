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
                                    data-appointment-id="{{ $appointment->id }}"
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
                            <input type="hidden" class="form-control" value="{{ $userId }}" name="patient_id" readonly>
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
                                aria-label="Amount" aria-describedby="basic-addon1" name="total_amount" id="TotalAmount"
                                readonly min="0">
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
    <script type="text/javascript">
        $(document).ready(function() {
            var totalAmount = 0;

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
                    $('#selected-appointments').find(`.selected-appointment[data-appointment-id="${appointmentId}"]`).remove();
                } else {
                    // Select and add the amount
                    totalAmount += amount;
                    $button.addClass('selected');
                    $button.text('Deselect');
                    card.find('.select-appointment').remove();
                    card.append(
                        '<button type="button" class="btn btn-danger remove-appointment">Supprimer</button>'
                    );
                    $('#selected-appointments').append(`<div class="selected-appointment" data-appointment-id="${appointmentId}">
                        <input type="hidden" name="nom[]" value="${appointmentId}">
                        <input type="hidden" name="invoice_amount[]" value="${amount}">
                        ${card.html()}
                    </div>`);
                }

                // Update the total amount input
                $('#TotalAmount').val(totalAmount.toFixed(2));
            });

            $(document).on('click', '.remove-appointment', function() {
                var card = $(this).closest('.selected-appointment');
                var appointmentId = card.data('appointment-id');
                var amount = parseFloat($(`.select-appointment[data-appointment-id="${appointmentId}"]`).data('amount'));

                totalAmount -= amount;
                $(`.select-appointment[data-appointment-id="${appointmentId}"]`).removeClass('selected').text('Select');
                card.remove();

                // Update the total amount input
                $('#TotalAmount').val(totalAmount.toFixed(2));
            });
        });

        function goBackAndReload() {
            window.location.replace(document.referrer);
        }
    </script>
@endsection
