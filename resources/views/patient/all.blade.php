@extends('layouts.master')

@section('title')
    {{ __('sentence.All Patients') }}
@endsection

@section('content')
    <div class="">
        <div class="d-flex justify-content-center">
            <div class="card col-md-12">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-dark text-center"> {{ __('sentence.All Patients') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 mt-4">
        <div class="card-header py-3">
            <div class="row mb-4">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-dark w-75 p-2">{{ __('sentence.All Patients') }}</h6>
                </div>
                <div class="col-4">
                    <form action="{{ route('patient.search') }}" method="post" class="d-inline-block form-inline">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="term" class="form-control bg-light border-0 small" placeholder="Rechercher...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center text-primary"><b>{{ __('sentence.Patient Name') }}</b></th>
                            <th class="text-center text-primary"><b>{{ __('sentence.Phone') }}</b></th>
                            <th class="text-center text-primary"><b>{{ __('sentence.Email') }}</b></th>
                            <th class="text-center text-primary"><b>{{ __('sentence.Due Balance') }}</b></th>
                            <th class="text-center text-primary"><b>{{ __('sentence.Actions') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                            <tr>
                                <td class="text-center"><a href="{{ url('patient/view/' . $patient->id) }}" class="text-dark">{{ $patient->name }}</a></td>
                                <td class="text-center">{{ $patient->phone }}</td>
                                <td class="text-center">{{ $patient->email }}</td>
                                <td class="text-center">
                                    @if (Collect($patient->Billings)->where('payment_status', 'Partially Paid')->sum('due_amount'))
                                        <label class="badge badge-warning-soft">
                                            {{ Collect($patient->Billings)->where('payment_status', 'Partially Paid')->sum('due_amount') }} {{ App\Setting::get_option('currency') }}
                                        </label>
                                    @elseif (Collect($patient->Billings)->where('payment_status', 'Unpaid')->sum('due_amount'))
                                        <label class="badge badge-danger-soft">
                                            {{ Collect($patient->Billings)->where('payment_status', 'Unpaid')->sum('due_amount') }} {{ App\Setting::get_option('currency') }}
                                        </label>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @can('delete patient')
                                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal" data-link="{{ route('patient.destroy', ['id' => $patient->id]) }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center"><img src="{{ asset('img/rest.png') }}" alt="Aucun patient trouvé"> <br><br>
                                    <b class="text-muted">Aucun hôte trouvé</b>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <span class="float-right mt-3">{{ $patients->links() }}</span>
            </div>
        </div>
    </div>
@endsection
