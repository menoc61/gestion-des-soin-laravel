@extends('layouts.master')

@section('title')
    {{ __('sentence.All Patients') }}
@endsection

@section('content')
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <div class="card shadow mb-4">
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID
                                <a href="{{ route('patient.all', ['sort' => 'id', 'order' => 'asc']) }}"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="{{ route('patient.all', ['sort' => 'id', 'order' => 'desc']) }}"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th>{{ __('sentence.Patient Name') }}
                                <a href="{{ route('patient.all', ['sort' => 'name', 'order' => 'asc']) }}"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="{{ route('patient.all', ['sort' => 'name', 'order' => 'desc']) }}"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th class="text-center">{{ __('sentence.Phone') }}</th>
                            <th class="text-center">{{ __('sentence.Appointment') }}</th>
                            {{-- <th class="text-center">{{ __('sentence.Address') }}</th>
                            <th class="text-center">{{ __('sentence.Allergies') }}</th>
                            <th class="text-center">{{ __('sentence.Type of patient') }}</th>
                            <th class="text-center">{{ __('sentence.Morphology') }}</th>
                            <th class="text-center">{{ __('sentence.Alimentation') }}</th>
                            <th class="text-center">{{ __('sentence.Digestion') }}</th> --}}
                            <th class="text-center">{{ __('sentence.Date') }}
                                <a href="{{ route('patient.all', ['sort' => 'created_at', 'order' => 'asc']) }}"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="{{ route('patient.all', ['sort' => 'created_at', 'order' => 'desc']) }}"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th class="text-center">{{ __('sentence.Due Balance') }}
                            </th>
                            {{-- <th class="text-center">{{ __('sentence.Prescription') }}</th>
                            <th class="text-center">{{ __('sentence.Test') }}</th> --}}
                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $key => $patient)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ url('patient/view/' . $patient->id) }}"> {{ $patient->name }} </a></td>
                                <td class="text-center"> {{ @$patient->Patient->phone }} </td>
                                <td class="text-center"> {{ @$patient->Patient->phone }} </td>
                                {{-- <td class="text-center"> {{ @\Carbon\Carbon::parse($patient->Patient->birthday)->age }}ans
                                </td> --}}

                                {{-- <td class="text-center"> {{ @$patient->Patient->adress }} </td>
                                <td class="text-center"> {{ @$patient->Patient->allergie }} </td>
                                <td class="text-center"> @isset($patient->Patient->type_patient)
                                        @php
                                            $type_patientArray = json_decode($patient->Patient->type_patient);
                                        @endphp

                                        @if (is_array($type_patientArray))
                                            @foreach ($type_patientArray as $item)
                                                <label class="badge badge-primary-soft">{{ $item }}</label>
                                            @endforeach
                                        @else
                                            <span>Aucune donnée trouvée.</span>
                                        @endif
                                    @endisset
                                </td>
                                <td class="text-center"> @isset($patient->Patient->morphology)
                                        @php
                                            $morphologyArray = json_decode($patient->Patient->morphology);
                                        @endphp

                                        @if (is_array($morphologyArray))
                                            @foreach ($morphologyArray as $item)
                                                <label class="badge badge-primary-soft">{{ $item }}</label>
                                            @endforeach
                                        @else
                                            <span>Aucune donnée trouvée.</span>
                                        @endif
                                    @endisset
                                </td>
                                <td class="text-center"> @isset($patient->Patient->alimentation)
                                        @php
                                            $alimentationArray = json_decode($patient->Patient->alimentation);
                                        @endphp

                                        @if (is_array($alimentationArray))
                                            @foreach ($alimentationArray as $item)
                                                <label class="badge badge-success-soft">{{ $item }}</label>
                                            @endforeach
                                        @else
                                            <span>Aucune donnée trouvée.</span>
                                        @endif
                                    @endisset
                                </td>
                                <td class="text-center"> {{ @$patient->Patient->digestion }} </td> --}}
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
                                </td>
                        @endif

                        {{-- <td class="text-center">
                                    @can('view patient')
                                        <a href="{{ route('prescription.view_for_user', ['id' => $patient->id]) }}"
                                            class="btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i> Voir</a>
                                    @endcan
                                </td>
                                <td class="text-center">
                                    @can('view patient')
                                        <a href="{{ route('test.view_diagnostic', ['id' => $patient->id]) }}"
                                            class="btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i> Voir</a>
                                    @endcan
                                </td> --}}
                        <td class="text-center">
                            {{-- @can('view patient')
                                        <a href="{{ route('patient.view', ['id' => $patient->id]) }}"
                                            class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                    @endcan
                                    @can('edit patient')
                                        <a href="{{ route('patient.edit', ['id' => $patient->id]) }}"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan --}}
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

                    </tbody>
                </table>
                <span class="float-right mt-3">{{ $patients->links() }}</span>

            </div>
        </div>
    </div>
@endsection
