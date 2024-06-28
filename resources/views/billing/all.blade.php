@extends('layouts.master')

@section('title')
    {{ __('sentence.Billing List') }}
@endsection

@section('content')
    <div class="">
        <div class="mb-3">
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-12">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary text-center"> {{ __('sentence.Payment History') }}

                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables  -->
    <div class="card shadow mt-4 mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.Billing List') }}</h6>
                </div>
                <div class="col-2">
                    <div>
                        <form action="{{ route('envoyer.MailInvoiceNotificationAll') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-info btn-circle btn-sm" data-toggle="tooltip"
                                data-placement="top" title="Envoyer un mail aux hôtes"><i class="fas fa-envelope"></i></button>
                        </form>
                        <span class="text-info">maïl</span>
                    </div>
                </div>
                {{-- <div class="col-2">
                    @can('create invoice')
                        <a href="{{ route('billing.create') }}" class="btn btn-primary btn-sm float-right"><i
                                class="fa fa-plus"></i> {{ __('sentence.Create Invoice') }}</a>
                    @endcan
                </div> --}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ __('sentence.Reference') }}
                                <a href="{{ route('billing.all', ['sort' => 'reference', 'order' => 'asc']) }}"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="{{ route('billing.all', ['sort' => 'reference', 'order' => 'desc']) }}"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th>{{ __('sentence.Patients') }} </th>
                            <th>{{ __('sentence.Praticiens') }} </th>
                            <th>{{ __('sentence.Date') }}
                                <a href="{{ route('billing.all', ['sort' => 'created_at', 'order' => 'asc']) }}"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="{{ route('billing.all', ['sort' => 'created_at', 'order' => 'desc']) }}"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th class="text-center">{{ __('sentence.Amount') }} - <font class="text-danger">
                                    {{ __('sentence.Due Balance') }}</font>
                                <a href="{{ route('billing.all', ['sort' => 'due_amount', 'order' => 'asc']) }}"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="{{ route('billing.all', ['sort' => 'due_amount', 'order' => 'desc']) }}"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th class="text-center">{{ __('sentence.Status') }}</th>
                            <th class="text-center">{{ __('sentence.Payment Method') }}</th>
                            <th>{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->reference }}</td>
                                <td><a href="{{ url('patient/view/' . $invoice->user_id) }}"> {{ $invoice->User->name }}
                                    </a></td>
                                <td> {{ $invoice->UserSessions->name }} </a></td>
                                <td>{{ $invoice->created_at->format('d M Y h:m:s') }}</td>
                                <td class="text-center"> {{ $invoice->total_with_tax }}
                                    {{-- <td class="text-center"> {{ $invoice->total_with_tax }} {{ App\Setting::get_option('currency') }} --}}
                                    @if ($invoice->payment_status == 'Unpaid' or $invoice->payment_status == 'Partially Paid')
                                        <label class="badge badge-danger-soft">{{ $invoice->due_amount }}</label>
                                        {{-- <label class="badge badge-danger-soft">{{ $invoice->due_amount }} {{ App\Setting::get_option('currency') }} </label> --}}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($invoice->payment_status == 'Unpaid')
                                        <label class="badge badge-danger-soft">
                                            <i class="fas fa-hourglass-start"></i> {{ __('sentence.Unpaid') }}
                                        </label>
                                    @elseif($invoice->payment_status == 'Paid')
                                        <label class="badge badge-success-soft">
                                            <i class="fas fa-check"></i> {{ __('sentence.Paid') }}
                                        </label>
                                    @elseif($invoice->payment_status == 'Partially Paid')
                                        <label class="badge badge-warning-soft">
                                            <i class="fas fa-hourglass-start"></i> {{ __('sentence.Partially Paid') }}
                                        </label>
                                    @else
                                    @endif
                                </td>
                                <td class="text-center"><label class="badge badge-primary-soft"><i
                                            class="fa fa-handshake"></i> {{ $invoice->payment_mode }}</label></td>
                                <td>
                                    @can('view invoice')
                                        <a href="{{ url('billing/view/' . $invoice->id) }}"
                                            class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                    @endcan
                                    {{-- @can('edit invoice')
                                        <a href="{{ url('billing/edit/' . $invoice->id) }}"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                    @endcan --}}
                                    @can('delete invoice')
                                        <a data-toggle="modal" data-target="#DeleteModal"
                                            data-link="{{ url('billing/delete/' . $invoice->id) }}"
                                            class="btn btn-outline-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center"><img src="{{ asset('img/not-found.svg') }}"
                                        width="200" /> <br><br> <b class="text-muted">Aucune facture trouvé</b></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <span class="float-right mt-3">{{ $invoices->links() }}</span>

            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
