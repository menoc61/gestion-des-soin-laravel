@extends('layouts.master')

@section('title')
    {{ __('sentence.All Patients') }}
@endsection

@section('content')
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <div class="card mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Patients') }}</h6>
                </div>
                <div class="col-4">
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                        action="{{ route('patient.search') }}" method="post">
                        <div class="input-group">
                            <input type="text" name="term" class="form-control bg-light border-0 small"
                                placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2">
                            @csrf
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-2">
                    @can('add patient')
                        <a href="{{ route('patient.create') }}" class="btn btn-primary btn-sm float-right "><i
                                class="fa fa-plus"></i> {{ __('sentence.New Patient') }}</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="">
                <table class="table">
                    <tr>
                        <th>{{ __('sentence.Patient Name') }}
                            <a href="{{ route('patient.all', ['sort' => 'name', 'order' => 'asc']) }}"><i
                                    class="fas fa-sort-up"></i></a>
                            <a href="{{ route('patient.all', ['sort' => 'name', 'order' => 'desc']) }}"><i
                                    class="fas fa-sort-down"></i></a>
                        </th>
                        <th class="text-center">{{ __('sentence.Phone') }}</th>
                        <th class="text-center">{{ __('sentence.Date') }}
                            <a href="{{ route('patient.all', ['sort' => 'created_at', 'order' => 'asc']) }}"><i
                                    class="fas fa-sort-up"></i></a>
                            <a href="{{ route('patient.all', ['sort' => 'created_at', 'order' => 'desc']) }}"><i
                                    class="fas fa-sort-down"></i></a>
                        </th>
                        <th class="text-center">{{ __('sentence.Due Balance') }}
                        </th>
                        <th class="text-center">{{ __('sentence.Actions') }}</th>
                    </tr>
                    @forelse($patients as $key => $patient)
                        <tr>
                            <td><a href="{{ url('patient/view/' . $patient->id) }}"> {{ $patient->name }} </a></td>
                            <td class="text-center"> {{ @$patient->Patient->phone }} </td>
                            <td class="text-center"><label
                                    class="badge badge-primary-soft">{{ $patient->created_at->format('d M Y H:i') }}</label>
                            </td>
                            <td class="text-center">
                                @if (Collect($patient->Billings)->where('payment_status', 'Partially Paid')->sum('due_amount'))
                                    <label
                                        class="badge badge-warning-soft">{{ Collect($patient->Billings)->where('payment_status', 'Partially Paid')->sum('due_amount') }}
                                        {{ App\Setting::get_option('currency') }}</label>
                                @elseif (Collect($patient->Billings)->where('payment_status', 'Unpaid')->sum('due_amount'))
                                    <label
                                        class="badge badge-danger-soft">{{ Collect($patient->Billings)->where('payment_status', 'Unpaid')->sum('due_amount') }}
                                        {{ App\Setting::get_option('currency') }}</label>
                                @endif
                            </td>
                            <td class="text-center">
                                @can('delete patient')
                                    <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                        data-target="#DeleteModal"
                                        data-link="{{ route('patient.destroy', ['id' => $patient->id]) }}"><i
                                            class="fas fa-trash"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" align="center"><img src="{{ asset('img/rest.png') }} " /> <br><br> <b
                                    class="text-muted">Aucun hôte trouvé</b>
                            </td>
                        </tr>
                    @endforelse
                </table>
                <span class="float-right mt-3">{{ $patients->links() }}</span>

            </div>
        </div>
    </div>
@endsection
