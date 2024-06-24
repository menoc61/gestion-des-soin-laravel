@extends('layouts.master')

@section('title')
    {{ $patient->name }}
@endsection

@section('content')
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="card profile">
                                <div class="card-body">
                                    <div class="text-center">
                                        @empty(!$patient->image)
                                            <img src="{{ asset('uploads/' . $patient->image) }}" alt="profil-img"
                                                class="rounded-circle img-thumbnail avatar-xl">
                                        @else
                                            <img src="{{ asset('img/default-image.jpeg') }}" alt="profil-img"
                                                class="rounded-circle img-thumbnail avatar-xl">
                                        @endempty
                                        <div class="online-circle">
                                            <i class="fa fa-circle text-success"></i>
                                        </div>
                                        <h4 class="mt-2">{{ $patient->name }}</h4>

                                        <a href="{{ route('patient.SendPassword', ['id' => $patient->id]) }}"
                                            class="btn btn-doctorino btn-sm btn-round px-3">
                                            {{ __('sentence.Send Credentials') }}</a>
                                        <a href="{{ url('patient/edit/' . $patient->id) }}"
                                            class="btn btn-danger btn-sm btn-round px-3"> <i class="fa fa-pen"></i></a>
                                        <ul class="list-unstyled list-inline mt-3 text-muted">
                                            <li class="list-inline-item font-size-13 me-3">
                                                <label class="badge badge-success-soft"><strong
                                                        class="text-dark">{{ $appointments->count() }}</strong>
                                                    {{ __('sentence.Appointment') }}</label>
                                            </li>
                                            <li class="list-inline-item font-size-13">
                                                <label class="badge badge-success-soft"><strong
                                                        class="text-dark">{{ $invoices->count() }}</strong>
                                                    {{ __('sentence.Invoices') }}</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-striped table-align-center">
                                    <tr>
                                        @isset($patient->Patient->birthday)
                                            <td>
                                                <p><b>{{ __('sentence.Birthday') }} :</b></p>
                                            </td>
                                            <td>
                                                <p><label class="badge badge-success-soft">{{ $patient->Patient->birthday }}
                                                        ({{ \Carbon\Carbon::parse($patient->Patient->birthday)->age }}
                                                        ANS)</label>
                                                </p>
                                            </td>
                                        @endisset
                                    </tr>

                                    <tr>
                                        @isset($patient->Patient->gender)
                                            <td>
                                                <p><b>{{ __('sentence.Gender') }} :</b></p>
                                            </td>
                                            <td>
                                                <p><label
                                                        class="badge badge-success-soft">{{ $patient->Patient->gender }}</label>
                                                </p>
                                            </td>
                                        @endisset
                                    </tr>

                                    <tr>
                                        @isset($patient->Patient->phone)
                                            <td>
                                                <p><b>{{ __('sentence.Phone') }} :</b></p>
                                            </td>
                                            <td>
                                                <p><label
                                                        class="badge badge-success-soft">{{ $patient->Patient->phone }}</label>
                                                </p>
                                            </td>
                                        @endisset
                                    </tr>

                                    <tr>
                                        @isset($patient->Patient->adress)
                                            <td>
                                                <p><b>{{ __('sentence.Address') }} :</b></p>
                                            </td>
                                            <td>
                                                <p><label
                                                        class="badge badge-success-soft">{{ $patient->Patient->adress }}</label>
                                                </p>
                                            </td>
                                        @endisset
                                    </tr>

                                    {{-- <tr>
                                        @isset($patient->Patient->allergie)
                                            <td>
                                                <p><b>{{ __('sentence.Allergies') }} :</b></p>
                                            </td>
                                            <td>
                                                <p><label
                                                        class="badge badge-success-soft">{{ $patient->Patient->allergie }}</label>
                                                </p>
                                            </td>
                                        @endisset
                                    </tr>

                                    <tr>
                                        @isset($patient->Patient->hobbie)
                                            <td>
                                                <p><b>{{ __('sentence.Hobbies') }} :</b></p>
                                            </td>
                                            <td>
                                                <p><label class="badge badge-success-soft">{{ $patient->Patient->hobbie }}</label>
                                                </p>
                                            </td>
                                        @endisset
                                    </tr>

                                    <tr>
                                        @isset($patient->Patient->demande)
                                            <td>
                                                <p><b>{{ __('sentence.Special Requests') }} :</b></p>
                                            </td>
                                            <td>
                                                <p><label class="badge badge-success-soft">{{ $patient->Patient->demande }}</label>
                                                </p>
                                            </td>
                                        @endisset
                                    </tr>
                                    <hr>
                                    <tr>
                                        @isset($patient->Patient->morphology)
                                            <td>
                                                <p><b>{{ __('sentence.Morphology') }} :</b>

                                                </p>
                                            </td>
                                            <td>
                                                @php
                                                    $morphologyArray = json_decode($patient->Patient->morphology);
                                                @endphp

                                                @if (is_array($morphologyArray))
                                                    @foreach ($morphologyArray as $item)
                                                        <label class="badge badge-success-soft">{{ $item }}</label>
                                                    @endforeach
                                                @else
                                                    <span>No morphology data available.</span>
                                                @endif
                                            </td>
                                        @endisset
                                    </tr>

                                    <tr>
                                        @isset($patient->Patient->alimentation)
                                            <td>
                                                <p><b>{{ __('sentence.Alimentation') }} :</b>

                                                </p>
                                            </td>
                                            <td>
                                                @php
                                                    $alimentationArray = json_decode($patient->Patient->alimentation);
                                                @endphp

                                                @if (is_array($alimentationArray))
                                                    @foreach ($alimentationArray as $item)
                                                        <label class="badge badge-success-soft">{{ $item }}</label>
                                                    @endforeach
                                                @else
                                                    <span>No alimentation data available.</span>
                                                @endif
                                            </td>
                                        @endisset
                                    </tr>

                                    <tr>
                                        @isset($patient->Patient->type_patient)
                                            <td>
                                                <p><b>{{ __('sentence.Type of patient') }} :</b>

                                                </p>
                                            </td>
                                            <td>
                                                @php
                                                    $type_patientArray = json_decode($patient->Patient->type_patient);
                                                @endphp

                                                @if (is_array($type_patientArray))
                                                    @foreach ($type_patientArray as $item)
                                                        <label class="badge badge-success-soft">{{ $item }}</label>
                                                    @endforeach
                                                @else
                                                    <span>No patient type data available.</span>
                                                @endif
                                            </td>
                                        @endisset
                                    </tr> --}}
                                </table>
                            </div>

                        </div>
                        <div class="col-md-8 col-sm-6">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile"
                                        role="tab" aria-controls="Profile"
                                        aria-selected="true">{{ __('sentence.Health History') }}</a>
                                </li> --}}
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="appointements-tab" data-toggle="tab"
                                        href="#appointements" role="tab" aria-controls="appointements"
                                        aria-selected="false">{{ __('sentence.Appointment') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link " id="tests-tab" data-toggle="tab" href="#tests" role="tab"
                                        aria-controls="tests" aria-selected="false">{{ __('sentence.Test') }}</a>
                                </li>
                                @if (Auth::user()->role_id != 2)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="psychotest-tab" data-toggle="tab" href="#psychotest"
                                            role="tab" aria-controls="psychotest"
                                            aria-selected="true">{{ __('sentence.Test Pshycho') }}</a>
                                    </li>
                                @endif
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="prescriptions-tab" data-toggle="tab" href="#prescriptions"
                                        role="tab" aria-controls="prescriptions"
                                        aria-selected="false">{{ __('sentence.Prescriptions') }}</a>
                                </li>
                                @if (Auth::user()->role_id != 2)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="Psycho-tab" data-toggle="tab" href="#Psycho" role="tab"
                                            aria-controls="Psycho" aria-selected="false">{{ __('sentence.Psycho') }}</a>
                                    </li>
                                @endif
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents"
                                        role="tab" aria-controls="documents" aria-selected="false">Fichier Médical</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="Billing-tab" data-toggle="tab" href="#Billing"
                                        role="tab" aria-controls="Billing"Alert
                                        aria-selected="false">{{ __('sentence.Billings') }}</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                {{-- <div class="tab-pane fade " id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">

                                    <div class="row">
                                        <div class="col">
                                            @can('create health history')
                                                <button type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                    data-toggle="modal" data-target="#MedicalHistoryModel"><i
                                                        class="fa fa-plus"></i> {{ __('sentence.Add New') }}</button>
                                            @endcan
                                        </div>
                                    </div>

                                    @forelse($historys as $history)
                                        <div class="alert alert-danger">
                                            <p class="text-danger font-size-12">
                                                {!! clean($history->title) !!} - {{ $history->created_at }}
                                                @can('delete health history')
                                                    <span class="float-right"><i class="fa fa-trash" data-toggle="modal"
                                                            data-target="#DeleteModal"
                                                            data-link="{{ url('history/delete/' . $history->id) }}"></i></span>
                                                @endcan
                                            </p>
                                            {!! clean($history->note) !!}
                                        </div>
                                    @empty
                                        <center><img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <b
                                                class="text-muted">Aucun Historique Trouvé</b></center>
                                    @endforelse

                                </div> --}}


                                {{-- ---------------------------------------------------------- Start Test  ------------------------------------------------------------------------ --}}
                                <div class="tab-pane fade " id="tests" role="tabpanel" aria-labelledby="tests-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="btn btn-primary btn-sm my-4 float-right"
                                                href="{{ route('test.create_by', ['id' => $patient->id]) }}"><i
                                                    class="fa fa-pen"></i>
                                                {{ __('sentence.Add Test') }}</a>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover " id="dataTable"
                                                width="100%" cellspacing="0">
                                                <tr>
                                                    <td align="center"><b>Id</b></td>
                                                    <td align="center"><b> Nom Diagnose</b> </td>
                                                    <td align="center"><b>Description</b> </td>
                                                    {{-- <td align="center"><b> Utilisation </b></td> --}}
                                                    <td align="center"><b> Action</b> </td>
                                                </tr>
                                                @forelse($tests as $key => $test)
                                                    {{-- @if (Auth::user()->role_id == 2)
                                                        <tr>
                                                            <td align="center">{{ $key + 1 }}</td>
                                                            <td align="center"><label class="badge badge-primary-soft">
                                                                    {{ $test->test_name }}
                                                                </label></td>
                                                            <td align="center"><label class="badge badge-primary-soft">
                                                                    {{ $test->comment }}
                                                                </label></td>
                                                            <td align="center">{{ __('sentence.time use') }} :
                                                                {{ $test->Prescription->count() }}
                                                                {{ __('sentence.In Prescription') }}
                                                            </td>
                                                            <td class="text-center">

                                                                <a href="{{ url('test/view/' . $test->id) }}"
                                                                    class="btn btn-outline-primary btn-circle btn-sm"><i
                                                                        class="fa fa-eye"></i></a>

                                                                @can('edit diagnostic test')
                                                                    <a href="{{ url('test/edit/' . $test->id) }}"
                                                                        class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                            class="fa fa-pen"></i></a>
                                                                @endcan
                                                                @can('delete diagnostic test')
                                                                    <a class="btn btn-outline-danger btn-circle btn-sm"
                                                                        data-toggle="modal" data-target="#DeleteModal"
                                                                        data-link="{{ url('test/delete/' . $test->id) }}"><i
                                                                            class="fa fa-trash"></i></a>
                                                                @endcan
                                                            </td>
                                                        </tr> --}}
                                                    @if (Auth::user()->role_id == 3 && Auth::user()->id == $test->user_id)
                                                        <tr>
                                                            <td align="center">{{ $key + 1 }}</td>
                                                            <td align="center"><label class="badge badge-primary-soft">
                                                                    {{ $test->test_name }}
                                                                </label></td>
                                                            <td align="center"><label class="badge badge-primary-soft">
                                                                    {{ $test->comment }}
                                                                </label></td>
                                                            {{-- <td align="center">{{ __('sentence.In Prescription') }} :
                                                                {{ $test->Prescription->count() }}
                                                                {{ __('sentence.time use') }}
                                                            </td> --}}
                                                            <td class="text-center">
                                                                <a href="{{ url('test/view/' . $test->id) }}"
                                                                    class="btn btn-outline-primary btn-circle btn-sm"><i
                                                                        class="fa fa-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td align="center">{{ $key + 1 }}</td>
                                                            <td align="center"><label class="badge badge-primary-soft">
                                                                    {{ $test->test_name }}
                                                                </label></td>
                                                            <td align="center"><label class="badge badge-primary-soft">
                                                                    {{ $test->comment }}
                                                                </label></td>
                                                            {{-- <td align="center">{{ __('sentence.time use') }} :
                                                                {{ $test->Prescription->count() }}
                                                                {{ __('sentence.In Prescription') }}
                                                            </td> --}}
                                                            <td class="text-center">

                                                                <a href="{{ url('test/view/' . $test->id) }}"
                                                                    class="btn btn-outline-primary btn-circle btn-sm"><i
                                                                        class="fa fa-eye"></i></a>

                                                                @can('edit diagnostic test')
                                                                    <a href="{{ url('test/edit/' . $test->id) }}"
                                                                        class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                            class="fa fa-pen"></i></a>
                                                                @endcan
                                                                @can('delete diagnostic test')
                                                                    <a class="btn btn-outline-danger btn-circle btn-sm"
                                                                        data-toggle="modal" data-target="#DeleteModal"
                                                                        data-link="{{ url('test/delete/' . $test->id) }}"><i
                                                                            class="fa fa-trash"></i></a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endif

                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center"><img
                                                                src="{{ asset('img/not-found.svg') }}" width="200" />
                                                            <br><br>
                                                            <b class="text-muted">pas de diagnostic trouvé</b>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </table>
                                            <span class="float-right mt-3">{{ $tests->links() }}</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- ------------------------------------------------------------ End Test  ------------------------------------------------------------------------ --}}



                                <div class="tab-pane fade show active" id="appointements" role="tabpanel"
                                    aria-labelledby="appointements-tab">

                                    {{-- --------------------------------------------------------- Start Rendez-vous  ------------------------------------------------------------------ --}}
                                    <div class="row">
                                        <div class="col">
                                            @can('create appointment')
                                                <a type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                    href="{{ route('appointment.create_by', ['id' => $patient->id]) }}"><i
                                                        class="fa fa-plus"></i>
                                                    {{ __('sentence.New Appointment') }}</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <tr>
                                                    {{-- <td align="center">Id</td> --}}
                                                    <td align="center">{{ __('sentence.Date') }}</td>
                                                    <td align="center">{{ __('sentence.Time Slot') }}</td>
                                                    <td align="center">{{ __('sentence.Praticien') }}</td>
                                                    <td align="center">{{ __('sentence.Status') }}</td>
                                                    {{-- <td class="text-center">{{ __('sentence.Created at') }}</td> --}}
                                                    <td class="text-center">{{ __('sentence.Visited At') }}</td>
                                                    <td align="center">{{ __('sentence.Actions') }}</td>
                                                </tr>
                                                @forelse($appointments as  $key => $appointment)
                                                    @if (Auth::user()->role_id == 3 && Auth::user()->id == $appointment->user_id)
                                                        <tr>
                                                            {{-- <td align="center">{{ $key + 1 }} </td> --}}
                                                            <td align="center"><label class="badge badge-primary-soft"><i
                                                                        class="fas fa-calendar"></i>
                                                                    {{ $appointment->date->format('d M Y') }} </label>
                                                            </td>
                                                            <td align="center"><label class="badge badge-primary-soft"><i
                                                                        class="fa fa-clock"></i>
                                                                    {{ $appointment->time_start }} -
                                                                    {{ $appointment->time_end }} </label></td>
                                                            <td align="center"><label class="badge badge-primary-soft"><i
                                                                        class="fa fa-user-injured"></i>
                                                                    {{ $appointment->Doctor->name }} </label></td>
                                                            <td class="text-center">
                                                                @if ($appointment->visited == 0)
                                                                    <label class="badge badge-warning-soft">
                                                                        <i class="fas fa-hourglass-start"></i>
                                                                        {{ __('sentence.Not Yet Visited') }}
                                                                    </label>
                                                                @elseif($appointment->visited == 1)
                                                                    <label class="badge badge-success-soft">
                                                                        <i class="fas fa-check"></i>
                                                                        {{ __('sentence.Visited') }}
                                                                    </label>
                                                                @else
                                                                    <label class="badge badge-danger-soft">
                                                                        <i class="fas fa-user-times"></i>
                                                                        {{ __('sentence.Cancelled') }}
                                                                    </label>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($appointment->visited == 1)
                                                                    <label class="badge badge-primary-soft">
                                                                        <i class="fas fa-calendar"></i>
                                                                        {{ $appointment->updated_at->format('d M Y H:i') }}
                                                                    </label>
                                                                @endif
                                                            </td>
                                                            <td align="center">
                                                                <a class="btn btn-outline-primary btn-circle btn-sm view-details-btn"
                                                                    data-date="{{ $appointment->date->format('d M Y') }}"
                                                                    data-time="{{ $appointment->time_start }} - {{ $appointment->time_end }}"
                                                                    data-doctor="{{ $appointment->Doctor->name }}"
                                                                    data-prescription="{{ $appointment->Prescription ? $appointment->Prescription->nom : '' }}"
                                                                    data-drugs="{{ $appointment->drugs->pluck('trade_name')->implode(', ') }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                @can('edit appointment')
                                                                    <a data-rdv_id="{{ $appointment->id }}"
                                                                        data-rdv_date="{{ $appointment->date->format('d M Y') }}"
                                                                        data-rdv_time_start="{{ $appointment->time_start }}"
                                                                        data-rdv_time_end="{{ $appointment->time_end }}"
                                                                        data-patient_name="{{ $appointment->User->name }}"
                                                                        class=" btn btn-outline-success btn-circle btn-sm
                                                                {{ $appointment->visited == 1 ? ' disabled opacity-button' : '' }}"
                                                                        data-toggle="modal" data-target="#EDITRDVModal">
                                                                        <i class="fas fa-check"></i>
                                                                    </a>
                                                                @endcan
                                                                @can('delete appointment')
                                                                    @if ($appointment->visited != 1)
                                                                        <a href="{{ url('appointment/delete/' . $appointment->id) }}"
                                                                            class="btn btn-outline-danger btn-circle btn-sm">
                                                                            <i class="fas fa-trash"></i>
                                                                        </a>
                                                                    @endif
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            {{-- <td align="center">{{ $key + 1 }} </td> --}}
                                                            <td align="center">
                                                                <label class="badge badge-primary-soft"><i
                                                                        class="fas fa-calendar"></i>
                                                                    {{ $appointment->date->format('d M Y') }} </label>
                                                            </td>
                                                            <td align="center"><label
                                                                    class="badge badge-primary-soft text-dark"><i
                                                                        class="fa fa-clock"></i>
                                                                    {{ $appointment->time_start }} -
                                                                    {{ $appointment->time_end }} </label></td>
                                                            <td align="center"><label class="badge badge-primary-soft"><i
                                                                        class="fa fa-user-injured"></i>
                                                                    {{ $appointment->Doctor->name }} </label></td>
                                                            <td class="text-center">
                                                                @if ($appointment->visited == 0)
                                                                    <label class="badge badge-warning-soft">
                                                                        <i class="fas fa-hourglass-start"></i>
                                                                        {{ __('sentence.Not Yet Visited') }}
                                                                    </label>
                                                                @elseif($appointment->visited == 1)
                                                                    <label class="badge badge-success-soft">
                                                                        <i class="fas fa-check"></i>
                                                                        {{ __('sentence.Visited') }}
                                                                    </label>
                                                                @else
                                                                    <label class="badge badge-danger-soft">
                                                                        <i class="fas fa-user-times"></i>
                                                                        {{ __('sentence.Cancelled') }}
                                                                    </label>
                                                                @endif
                                                            </td>
                                                            {{-- <td class="text-center">
                                                            {{ $appointment->created_at->format('d M Y H:i') }}</td> --}}
                                                            <td class="text-center">
                                                                @if ($appointment->visited == 1)
                                                                    <label class="badge badge-primary-soft">
                                                                        <i class="fas fa-calendar"></i>
                                                                        {{ $appointment->updated_at->format('d M Y H:i') }}
                                                                    </label>
                                                                @endif
                                                            </td>
                                                            <td align="center">
                                                                <a class="btn btn-outline-primary btn-circle btn-sm view-details-btn"
                                                                    data-id="{{ $appointment->id }}"
                                                                    data-date="{{ $appointment->date->format('d M Y') }}"
                                                                    data-time="{{ $appointment->time_start }} - {{ $appointment->time_end }}"
                                                                    data-doctor="{{ $appointment->Doctor->name }}"
                                                                    data-read="{{ $appointment->is_read }}"
                                                                    data-visited="{{ $appointment->visited }}"
                                                                    data-prescription="{{ $appointment->Prescription ? $appointment->Prescription->nom : '' }}"
                                                                    data-drugs="{{ $appointment->drugs->pluck('trade_name')->implode(', ') }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                @can('edit appointment')
                                                                    <a data-rdv_id="{{ $appointment->id }}"
                                                                        data-rdv_date="{{ $appointment->date->format('d M Y') }}"
                                                                        data-rdv_time_start="{{ $appointment->time_start }}"
                                                                        data-rdv_time_end="{{ $appointment->time_end }}"
                                                                        data-patient_name="{{ $appointment->User->name }}"
                                                                        class=" btn btn-outline-success btn-circle btn-sm
                                                            {{ $appointment->visited == 1 ? ' disabled opacity-button' : '' }}"
                                                                        data-toggle="modal" data-target="#EDITRDVModal">
                                                                        <i class="fas fa-check"></i>
                                                                    </a>
                                                                @endcan
                                                                @can('delete appointment')
                                                                    @if ($appointment->visited != 1)
                                                                        <a href="{{ url('appointment/delete/' . $appointment->id) }}"
                                                                            class="btn btn-outline-danger btn-circle btn-sm">
                                                                            <i class="fas fa-trash"></i>
                                                                        </a>
                                                                    @endif
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                    <tr>
                                                        <td colspan="6" align="center"><img
                                                                src="{{ asset('img/not-found.svg') }}" width="200" />
                                                            <br><br>
                                                            <b
                                                                class="text-muted">{{ __('sentence.No appointment available') }}</b>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </table>
                                            <span class="float-right mt-3">{{ $appointments->links() }}</span>
                                        </div>
                                    </div>
                                    {{-- ---------------------------------------------------------- End Rendez-vous  -------------------------------------------------------------------- --}}




                                    {{-- ----------------------------------------------------------- Start Prescription  --------------------------------------------------------------- --}}
                                    <div class="tab-pane fade" id="prescriptions" role="tabpanel"
                                        aria-labelledby="prescriptions-tab">
                                        <div class="row">
                                            <div class="col">
                                                @if (Auth::user()->role_id == 3)
                                                    <div class="col-md-12">
                                                        <div class="card-body h-25">
                                                        </div>
                                                        <div class="card-body h-25">
                                                        </div>
                                                    </div>
                                                @else
                                                    @can('create prescription')
                                                        <a type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                            href="{{ route('prescription.create_by', ['id' => $patient->id]) }}"><i
                                                                class="fa fa-pen"></i>
                                                            {{ __('sentence.Create Prescription') }}</a>
                                                    @endcan
                                                @endif
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover " id="dataTable"
                                                    width="100%" cellspacing="0">
                                                    <tr>
                                                        <td align="center">{{ __('sentence.Reference') }}</td>
                                                        <td class="text-center">{{ __('sentence.Name') }}</td>
                                                        <td align="center">{{ __('sentence.Created at') }}</td>
                                                        @if (Auth::user()->role_id == 3)
                                                        @else
                                                            <td align="center">{{ __('sentence.follow') }}</td>
                                                        @endif
                                                        <td align="center">{{ __('sentence.Actions') }}</td>
                                                    </tr>
                                                    @forelse($prescriptions as $prescription)
                                                        @if (Auth::user()->role_id == 3 && Auth::user()->id == $prescription->user_id)
                                                            <tr>
                                                                <td align="center">{{ $prescription->reference }} </td>
                                                                <td align="center"><label
                                                                        class="badge badge-primary-soft">{{ $prescription->nom }}</label>
                                                                </td>
                                                                <td align="center"><label
                                                                        class="badge badge-primary-soft">{{ $prescription->created_at }}</label>
                                                                </td>
                                                                {{-- <td align="center">
                                                                    <a href="{{ url('prescription/follow/' . $prescription->id) }}"
                                                                        class="btn btn-outline-primary btn-circle btn-sm">
                                                                        <i class="fa fa-id-card"></i>
                                                                    </a>
                                                                </td> --}}
                                                                <td align="center">
                                                                    @can('view prescription')
                                                                        <a href="{{ url('prescription/view/' . $prescription->id) }}"
                                                                            class="btn btn-outline-success btn-circle btn-sm"><i
                                                                                class="fa fa-eye"></i></a>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td align="center">{{ $prescription->reference }} </td>
                                                                <td align="center"><label
                                                                        class="badge badge-primary-soft">{{ $prescription->nom }}</label>
                                                                </td>

                                                                <td align="center"><label
                                                                        class="badge badge-primary-soft">{{ $prescription->created_at }}</label>
                                                                </td>

                                                                <td align="center">
                                                                    <a href="{{ url('prescription/follow/' . $prescription->id) }}"
                                                                        class="btn btn-outline-primary btn-circle btn-sm">
                                                                        <i class="fa fa-id-card"></i>
                                                                    </a>
                                                                </td>
                                                                <td align="center">
                                                                    @can('view prescription')
                                                                        <a href="{{ url('prescription/view/' . $prescription->id) }}"
                                                                            class="btn btn-outline-success btn-circle btn-sm"><i
                                                                                class="fa fa-eye"></i></a>
                                                                    @endcan
                                                                    @can('edit prescription')
                                                                        <a href="{{ url('prescription/edit/' . $prescription->id) }}"
                                                                            class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                                class="fas fa-pen"></i></a>
                                                                    @endcan
                                                                    @can('delete prescription')
                                                                        <a href="{{ url('prescription/delete/' . $prescription->id) }}"
                                                                            class="btn btn-outline-danger btn-circle btn-sm"><i
                                                                                class="fas fa-trash"></i></a>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                            <br>
                                                        @endif
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" align="center"> <img
                                                                    src="{{ asset('img/not-found.svg') }}" width="200" />
                                                                <br><br>
                                                                <b class="text-muted">
                                                                    {{ __('sentence.No prescription available') }}</b>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </table>
                                                <span class="float-right mt-3">{{ $prescriptions->links() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- --------------------------------------------------------- End Prescription  ------------------------------------------------------------------- --}}

                                    @if (Auth::user()->role_id != 2)
                                        {{-- ----------------------------------------------------------- Start test Psychothérapeutique  --------------------------------------------------------------- --}}
                                        <div class="tab-pane fade" id="psychotest" role="tabpanel"
                                            aria-labelledby="psychotest-tab">
                                            <div class="row">
                                                <div class="col">
                                                    <a class="btn btn-primary btn-sm my-4 float-right"
                                                        href="{{ route('test.psychotherapie', ['id' => $patient->id]) }}"><i
                                                            class="fa fa-pen"></i>
                                                        {{ __('sentence.Create Psycho') }}</a>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-hover "
                                                        id="dataTable" width="100%" cellspacing="0">
                                                        <tr>
                                                            <td align="center"><b>Id</b></td>
                                                            <td align="center"><b> Nom Diagnose</b> </td>
                                                            {{-- <td align="center"><b>Description</b> </td> --}}
                                                            <td align="center"><b> Action</b> </td>
                                                        </tr>
                                                        @forelse($testpshychos as $key => $testpshycho)
                                                            <tr>
                                                                <td align="center">{{ $key + 1 }}</td>
                                                                <td align="center"><label class="badge badge-primary-soft">
                                                                        {{ $testpshycho->test_name }}
                                                                    </label></td>
                                                                {{-- <td align="center"><label class="badge badge-primary-soft">
                                                                        {{ $testpshycho->comment }}
                                                                    </label></td> --}}
                                                                <td class="text-center">
                                                                    <a href="{{ url('test/view/' . $testpshycho->id) }}"
                                                                        class="btn btn-outline-primary btn-circle btn-sm"><i
                                                                            class="fa fa-eye"></i></a>
                                                                    @can('edit diagnostic test')
                                                                        <a href="{{ url('test/edit/' . $testpshycho->id) }}"
                                                                            class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                                class="fa fa-pen"></i></a>
                                                                    @endcan
                                                                    @can('delete diagnostic test')
                                                                        <a class="btn btn-outline-danger btn-circle btn-sm"
                                                                            data-toggle="modal" data-target="#DeleteModal"
                                                                            data-link="{{ url('test/delete/' . $testpshycho->id) }}"><i
                                                                                class="fa fa-trash"></i></a>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6" class="text-center"><img
                                                                        src="{{ asset('img/not-found.svg') }}"
                                                                        width="200" />
                                                                    <br><br>
                                                                    <b class="text-muted">pas de diagnostic trouvé</b>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </table>
                                                    <span class="float-right mt-3">{{ $testpshychos->links() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- --------------------------------------------------------- End test Psychothérapeutique  ------------------------------------------------------------------- --}}
                                    @endif


                                    {{-- ----------------------------------------------------------- Start Document --------------------------------------------------------------------- --}}
                                    <div class="tab-pane fade" id="documents" role="tabpanel"
                                        aria-labelledby="documents-tab">
                                        <div class="row">
                                            <div class="col">
                                                @if (Auth::user()->role_id == 3)
                                                    <div class="col-md-12">
                                                        <div class="card-body h-25">
                                                        </div>
                                                        <div class="card-body h-25">
                                                        </div>
                                                    </div>
                                                @else
                                                    @can('edit patient')
                                                        <button type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                            data-toggle="modal" data-target="#NewDocumentModel"><i
                                                                class="fa fa-plus"></i> {{ __('sentence.Add New') }}</button>
                                                    @endcan
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row">
                                            @forelse($documents as $document)
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        @if ($document->document_type == 'pdf')
                                                            <img src="{{ asset('img/pdf.jpg') }}" class="card-img-top">
                                                        @elseif($document->document_type == 'docx')
                                                            <img src="{{ asset('img/docx.png') }}" class="card-img-top">
                                                        @else
                                                            <a class="example-image-link"
                                                                href="{{ url('/uploads/' . $document->file) }}"
                                                                data-lightbox="example-1"><img
                                                                    src="{{ url('/uploads/' . $document->file) }}"
                                                                    class="card-img-top" width="209" height="209"></a>
                                                            <img src="{{ asset('img/pdf.jpg') }}" class="card-img-top">
                                                        @endif
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $document->title }}</h5>
                                                            <p class="font-size-12">{{ $document->note }}</p>
                                                            <p class="font-size-11"><label
                                                                    class="badge badge-primary-soft">{{ $document->created_at }}</label>
                                                            </p>
                                                            <a href="{{ url('/uploads/' . $document->file) }}"
                                                                class="btn btn-primary btn-sm" download><i
                                                                    class="fa fa-cloud-download-alt"></i> Télécharger</a>
                                                            @can('edit patient')
                                                                <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                                    data-target="#DeleteModal"
                                                                    data-link="{{ url('document/delete/' . $document->id) }}"><i
                                                                        class="fa fa-trash"></i></a>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col text-center">
                                                    <img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br>
                                                    <b class="text-muted"> {{ __('sentence.No document available') }} </b>
                                                </div>
                                            @endforelse

                                        </div>
                                    </div>
                                    {{-- ------------------------------------------------------- End Documents --------------------------------------------------------------------- --}}





                                    {{-- ------------------------------------------------------- Start Facturation --------------------------------------------------------------------- --}}
                                    <div class="tab-pane fade" id="Billing" role="tabpanel" aria-labelledby="Billing-tab">
                                        <div class="row mt-4">
                                            <div class="col-lg-3 mb-4">
                                                @php
                                                    $totalAmount =
                                                        $appointExist->pluck('drugs')->flatten()->sum('amountDrug') +
                                                        $invoices->sum('total_with_tax');
                                                @endphp
                                                <div class="card badge-primary-soft text-dark shadow">
                                                    <div class="card-body">
                                                        {{ __('sentence.Total With Tax') }}
                                                        <div class="text-dark big">
                                                            <b>{{ $totalAmount }}
                                                                {{ App\Setting::get_option('currency') }}</b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <div class="card bg-secondary text-white shadow">
                                                    <div class="card-body">
                                                        {{ __('sentence.Already Paid') }}
                                                        <div class="text-white big">
                                                            <b> {{ $invoices->sum('deposited_amount') }}
                                                                {{ App\Setting::get_option('currency') }}</b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                <div class="card badge-warning-soft text-dark shadow">
                                                    <div class="card-body">
                                                        {{ __('sentence.Total Remise') }}
                                                        <div class="text-dark big">
                                                            <b> {{ $invoices->sum('Remise') }}
                                                                {{ App\Setting::get_option('currency') }}</b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-4">
                                                @php
                                                    $totalAmount =
                                                        $appointExist->pluck('drugs')->flatten()->sum('amountDrug') +
                                                        $invoices
                                                            ->whereIn('payment_status', ['Partially Paid', 'Unpaid'])
                                                            ->sum('due_amount');
                                                @endphp
                                                <div class="card bg-danger text-white shadow">
                                                    <div class="card-body">
                                                        {{ __('sentence.Due Balance') }}
                                                        <div class="text-white big">
                                                            <b>{{ $totalAmount }}
                                                                {{ App\Setting::get_option('currency') }}</b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                @if (Auth::user()->role_id == 3)
                                                    <div class="col-md-12">
                                                        <div class="card-body h-25">
                                                        </div>
                                                        <div class="card-body h-25">
                                                        </div>
                                                    </div>
                                                @else
                                                    @can('create invoice')
                                                        <a type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                            href="{{ route('billing.create_by', ['id' => $patient->id]) }}"><i
                                                                class="fa fa-plus"></i>
                                                            {{ __('sentence.Create Invoice') }}</a>
                                                    @endcan
                                                @endif
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover">
                                                    <tr>
                                                        <th class="text-center">{{ __('sentence.Invoice') }}</th>
                                                        <th class="text-center">{{ __('sentence.Date') }}</th>
                                                        <th class="text-center">{{ __('sentence.Amount') }}</th>
                                                        <th class="text-center">{{ __('sentence.Status') }}</th>
                                                        <th class="text-center">{{ __('sentence.Actions') }}</th>
                                                    </tr>
                                                    @forelse($invoices as $invoice)
                                                        @if (Auth::user()->role_id == 2)
                                                            <tr>
                                                                <td class="text-center"><a
                                                                        href="{{ url('billing/view/' . $invoice->id) }}">{{ $invoice->reference }}</a>
                                                                </td>
                                                                <td class="text-center"><label
                                                                        class="badge badge-primary-soft">{{ $invoice->created_at->format('d M Y h:m:s') }}</label>
                                                                </td>
                                                                <td class="text-center"> {{ $invoice->total_with_tax }}
                                                                    {{ App\Setting::get_option('currency') }}
                                                                    @if ($invoice->payment_status == 'Unpaid' or $invoice->payment_status == 'Partially Paid')
                                                                        <label
                                                                            class="badge badge-danger-soft">{{ $invoice->due_amount }}
                                                                            {{ App\Setting::get_option('currency') }} </label>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($invoice->payment_status == 'Unpaid')
                                                                        <label class="badge badge-danger-soft">
                                                                            <i class="fas fa-hourglass-start"></i>
                                                                            {{ __('sentence.Unpaid') }}
                                                                        </label>
                                                                    @elseif($invoice->payment_status == 'Paid')
                                                                        <label class="badge badge-success-soft">
                                                                            <i class="fas fa-check"></i>
                                                                            {{ __('sentence.Paid') }}
                                                                        </label>
                                                                    @else
                                                                        <label class="badge badge-warning-soft">
                                                                            <i class="fas fa-user-times"></i>
                                                                            {{ __('sentence.Partially Paid') }}
                                                                        </label>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @can('view invoice')
                                                                        <a href="{{ url('billing/view/' . $invoice->id) }}"
                                                                            class="btn btn-outline-success btn-circle btn-sm"><i
                                                                                class="fas fa-print"></i></a>
                                                                    @endcan
                                                                    {{-- @can('edit invoice')
                                                                        <a href="{{ url('billing/edit/' . $invoice->id) }}"
                                                                            class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                                class="fas fa-pen"></i></a>
                                                                    @endcan --}}
                                                                    @can('delete invoice')
                                                                        <a href="{{ url('billing/delete/' . $invoice->id) }}"
                                                                            class="btn btn-outline-danger btn-circle btn-sm"><i
                                                                                class="fas fa-trash"></i></a>
                                                                    @endcan
                                                                    <a href="{{ url('payment/create/' . $invoice->id) }}"
                                                                        class="btn btn-outline-secondary btn-circle btn-sm"><i
                                                                            class="fas fa-fw fa-dollar-sign"></i></a>

                                                                </td>
                                                            </tr>
                                                        @elseif (Auth::user()->role_id == 1)
                                                            <tr>
                                                                <td class="text-center"><a
                                                                        href="{{ url('billing/view/' . $invoice->id) }}">{{ $invoice->reference }}</a>
                                                                </td>
                                                                <td class="text-center"><label
                                                                        class="badge badge-primary-soft">{{ $invoice->created_at->format('d M Y h:m:s') }}</label>
                                                                </td>
                                                                <td class="text-center"> {{ $invoice->total_with_tax }}
                                                                    {{ App\Setting::get_option('currency') }}
                                                                    @if ($invoice->payment_status == 'Unpaid' or $invoice->payment_status == 'Partially Paid')
                                                                        <label
                                                                            class="badge badge-danger-soft">{{ $invoice->due_amount }}
                                                                            {{ App\Setting::get_option('currency') }} </label>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($invoice->payment_status == 'Unpaid')
                                                                        <label class="badge badge-danger-soft">
                                                                            <i class="fas fa-hourglass-start"></i>
                                                                            {{ __('sentence.Unpaid') }}
                                                                        </label>
                                                                    @elseif($invoice->payment_status == 'Paid')
                                                                        <label class="badge badge-success-soft">
                                                                            <i class="fas fa-check"></i>
                                                                            {{ __('sentence.Paid') }}
                                                                        </label>
                                                                    @else
                                                                        <label class="badge badge-warning-soft">
                                                                            <i class="fas fa-user-times"></i>
                                                                            {{ __('sentence.Partially Paid') }}
                                                                        </label>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @can('view invoice')
                                                                        <a href="{{ url('billing/view/' . $invoice->id) }}"
                                                                            class="btn btn-outline-success btn-circle btn-sm"><i
                                                                                class="fas fa-print"></i></a>
                                                                    @endcan
                                                                    {{-- @can('edit invoice')
                                                                            <a href="{{ url('billing/edit/' . $invoice->id) }}"
                                                                                class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                                    class="fas fa-pen"></i></a>
                                                                        @endcan --}}
                                                                    @can('delete invoice')
                                                                        <a href="{{ url('billing/delete/' . $invoice->id) }}"
                                                                            class="btn btn-outline-danger btn-circle btn-sm"><i
                                                                                class="fas fa-trash"></i></a>
                                                                    @endcan
                                                                    <a href="{{ url('payment/create/' . $invoice->id) }}"
                                                                        class="btn btn-outline-secondary btn-circle btn-sm"><i
                                                                            class="fas fa-fw fa-dollar-sign"></i></a>
                                                                </td>
                                                            </tr>
                                                        @elseif (Auth::user()->role_id == 3 && Auth::user()->id == $invoice->user_id)
                                                            <tr>
                                                                <td class="text-center"><a
                                                                        href="{{ url('billing/view/' . $invoice->id) }}">{{ $invoice->reference }}</a>
                                                                </td>
                                                                <td class="text-center"><label
                                                                        class="badge badge-primary-soft">{{ $invoice->created_at->format('d M Y h:m:s') }}</label>
                                                                </td>
                                                                <td class="text-center"> {{ $invoice->total_with_tax }}
                                                                    {{ App\Setting::get_option('currency') }}
                                                                    @if ($invoice->payment_status == 'Unpaid' or $invoice->payment_status == 'Partially Paid')
                                                                        <label
                                                                            class="badge badge-danger-soft">{{ $invoice->due_amount }}
                                                                            {{ App\Setting::get_option('currency') }} </label>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($invoice->payment_status == 'Unpaid')
                                                                        <label class="badge badge-danger-soft">
                                                                            <i class="fas fa-hourglass-start"></i>
                                                                            {{ __('sentence.Unpaid') }}
                                                                        </label>
                                                                    @elseif($invoice->payment_status == 'Paid')
                                                                        <label class="badge badge-success-soft">
                                                                            <i class="fas fa-check"></i>
                                                                            {{ __('sentence.Paid') }}
                                                                        </label>
                                                                    @else
                                                                        <label class="badge badge-warning-soft">
                                                                            <i class="fas fa-user-times"></i>
                                                                            {{ __('sentence.Partially Paid') }}
                                                                        </label>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @can('view invoice')
                                                                        <a href="{{ url('billing/view/' . $invoice->id) }}"
                                                                            class="btn btn-outline-success btn-circle btn-sm"><i
                                                                                class="fas fa-print"></i></a>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @empty
                                                        <tr>
                                                        </tr>
                                                        <td colspan="6" align="center"><img
                                                                src="{{ asset('img/not-found.svg') }}" width="200" />
                                                            <br><br> <b
                                                                class="text-muted">{{ __('sentence.No Invoices Available') }}</b>
                                                        </td>
                                                    @endforelse
                                                </table>
                                                <span class="float-right mt-3">{{ $invoices->links() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ------------------------------------------------------- End Facturation ----------------------------------------------------------------------- --}}



                                    {{-- ------------------------------------------------------- Start Psychothérapie --------------------------------------------------------------------- --}}
                                    <div class="tab-pane fade" id="Psycho" role="tabpanel" aria-labelledby="Psycho-tab">
                                        <div class="row">
                                            <div class="col">
                                                @if (Auth::user()->role_id == 3)
                                                    <div class="col-md-12">
                                                        <div class="card-body h-25">
                                                        </div>
                                                        <div class="card-body h-25">
                                                        </div>
                                                    </div>
                                                @else
                                                    @can('create prescription')
                                                        <a type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                            href="{{ route('prescription.psycho_by', ['id' => $patient->id]) }}"><i
                                                                class="fa fa-pen"></i>
                                                            {{ __('sentence.Create Prescription') }}</a>
                                                    @endcan
                                                @endif
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover">
                                                    <tr>
                                                        <td align="center">{{ __('sentence.Reference') }}</td>
                                                        <td class="text-center">{{ __('sentence.Name') }}</td>
                                                        <td align="center">{{ __('sentence.Created at') }}</td>
                                                        @if (Auth::user()->role_id == 3)
                                                        @else
                                                            <td align="center">{{ __('sentence.follow') }}</td>
                                                        @endif
                                                        <td align="center">{{ __('sentence.Actions') }}</td>
                                                    </tr>
                                                    @forelse($psychos as $psycho)
                                                        <tr>
                                                            <td align="center">{{ $psycho->reference }} </td>
                                                            <td align="center"><label
                                                                class="badge badge-primary-soft">{{ $psycho->nom }}</label>
                                                        </td>
                                                            <td align="center"><label
                                                                    class="badge badge-primary-soft">{{ $psycho->created_at }}</label>
                                                            </td>
                                                            @if (Auth::user()->role_id == 3)
                                                            @else
                                                                <td align="center">
                                                                    <a href="{{ url('prescription/follow/' . $psycho->id) }}"
                                                                        class="btn btn-outline-primary btn-circle btn-sm">
                                                                        <i class="fa fa-id-card"></i>
                                                                    </a>
                                                                </td>
                                                            @endif
                                                            <td align="center">
                                                                @can('view prescription')
                                                                    <a href="{{ url('prescription/view/' . $psycho->id) }}"
                                                                        class="btn btn-outline-success btn-circle btn-sm"><i
                                                                            class="fa fa-eye"></i></a>
                                                                @endcan
                                                                @if (Auth::user()->role_id == 3)
                                                                @else
                                                                    @can('edit prescription')
                                                                        <a href="{{ url('prescription/edit/' . $psycho->id) }}"
                                                                            class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                                class="fas fa-pen"></i></a>
                                                                    @endcan
                                                                    @can('delete prescription')
                                                                        <a href="{{ url('prescription/delete/' . $psycho->id) }}"
                                                                            class="btn btn-outline-danger btn-circle btn-sm"><i
                                                                                class="fas fa-trash"></i></a>
                                                                    @endcan
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <br>
                                                    @empty
                                                        <tr>
                                                        </tr>
                                                        <td colspan="6" align="center"><img
                                                                src="{{ asset('img/not-found.svg') }}" width="200" />
                                                            <br><br> <b
                                                                class="text-muted">{{ __('sentence.No Psycho Available') }}</b>
                                                        </td>
                                                    @endforelse
                                                </table>
                                                <span class="float-right mt-3">{{ $psychos->links() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ------------------------------------------------------- End Psychothérapie ----------------------------------------------------------------------- --}}

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Modal-->
        <div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ __('sentence.You are about to modify an appointment') }}</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient_name"></span></p>
                        <p><b>{{ __('sentence.Date') }} :</b> <label class="badge badge-primary-soft"
                                id="rdv_date"></label></p>
                        <p><b>{{ __('sentence.Time Slot') }} :</b> <label class="badge badge-primary-soft"
                                id="rdv_time"></span></label>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button"
                            data-dismiss="modal">{{ __('sentence.Close') }}</button>
                        <a class="btn btn-primary text-white"
                            onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();">{{ __('sentence.Confirm Appointment') }}</a>
                        <form id="rdv-form-confirm" action="{{ route('appointment.store_edit') }}" method="POST"
                            class="d-none">
                            <input type="hidden" name="rdv_id" id="rdv_id">
                            <input type="hidden" name="rdv_status" value="1">
                            <input type="hidden" name="is_read" value="1">
                            @csrf
                        </form>
                        <a class="btn btn-danger text-white"
                            onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();">{{ __('sentence.Cancel Appointment') }}</a>
                        <form id="rdv-form-cancel" action="{{ route('appointment.store_edit') }}" method="POST"
                            class="d-none">
                            <input type="hidden" name="rdv_id" id="rdv_id2">
                            <input type="hidden" name="rdv_status" value="2">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Document Modal -->
        <div id="NewDocumentModel" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un Fichier / Note</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="{{ route('document.store') }}" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="title" placeholder="Titre" required>
                                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                    {{ csrf_field() }}
                                </div>
                                <div class="col">
                                    <input type="file" class="form-control-file" name="file"
                                        id="exampleFormControlFile1" required>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <textarea class="form-control" name="note" placeholder="Note"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button"
                                data-dismiss="modal">{{ __('sentence.Close') }}</button>
                            <button class="btn btn-primary text-white" type="submit">{{ __('sentence.Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <!--Document Modal -->
        <div id="MedicalHistoryModel" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('sentence.New Medical Info') }}</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="{{ route('history.store') }}" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="title" placeholder="Titre" required>
                                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                    {{ csrf_field() }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <textarea class="form-control" name="note" placeholder="Note" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button"
                                data-dismiss="modal">{{ __('sentence.Close') }}</button>
                            <button class="btn btn-primary text-white" type="submit">{{ __('sentence.Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
        </div>

        {{-- Detail RDV Modal --}}
        <div class="modal fade" id="RdvDetailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Show Modal RDV Contain-->
        <div class="modal fade" id="viewDetailsModal" tabindex="-1" role="dialog" aria-labelledby="viewDetailsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="viewDetailsModalLabel">Détail du Rendez vous</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <tr>
                                    <td><b>ID: </b></td>
                                    <td> <label class="badge badge-primary-soft" id="appointmentID"></label></td>
                                </tr>
                                <tr>
                                    <td><b>Consulter</b></td>
                                    <td> <label class="badge badge-primary-soft" id="appointmentRead"></label></td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('sentence.Praticien') }} : </b></td>
                                    <td> <label class="badge badge-primary-soft" id="appointmentDoctor"></label></td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('sentence.Date') }} : </b></td>
                                    <td><label class="badge badge-primary-soft" id="appointmentDate"></label></td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('sentence.Time Slot') }} : </b></td>
                                    <td><label class="badge badge-primary-soft" id="appointmentTime"></span></label></td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('sentence.Prescription') }} : </b></td>
                                    <td><label class="badge badge-primary-soft" id="appointmentPrescription"></span></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('sentence.Drug') }} : </b></td>
                                    <td><span id="appointmentPrescriptiondrug"></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if (Auth::user()->role_id == 3)
                            <button class="btn btn-primary" type="button" data-dismiss="modal">OK</button>
                        @else
                            <a class="btn btn-primary text-white"
                                onclick="event.preventDefault(); document.getElementById('rdv-form').submit();"> OK </a>
                            <form id="rdv-form" action="{{ route('appointment.store_edit') }}" method="POST"
                                class="d-none">
                                <input type="hidden" name="rdv_id" id="rdvId">
                                <input type="hidden" name="is_read" value="1">
                                <input type="hidden" name="rdv_status" id="rdvStatus">
                                @csrf
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('header')
        <link rel="stylesheet" href="{{ asset('dashboard/css/lightbox.css') }}" />
    @endsection
    @section('footer')
        <script type="text/javascript" src="{{ asset('dashboard/js/lightbox.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.view-details-btn').on('click', function() {
                    var id = $(this).data('id');
                    var date = $(this).data('date');
                    var time = $(this).data('time');
                    var doctor = $(this).data('doctor');
                    var prescription = $(this).data('prescription');
                    var drugs = $(this).data('drugs');
                    var read = $(this).data('read');
                    var visited = $(this).data('visited');


                    $('#appointmentDate').text(date);
                    $('#appointmentTime').text(time);
                    $('#appointmentRead').text(read);
                    $('#appointmentID').text(id);
                    $('#appointmentDoctor').text(doctor);
                    $('#appointmentPrescription').text(prescription);

                    // Clear previous drug badges
                    $('#appointmentPrescriptiondrug').empty();

                    // Split drugs string into an array and create badges
                    var drugArray = drugs.split(', ');
                    drugArray.forEach(function(drug) {
                        var badge = $('<label>').addClass('badge badge-primary-soft').text(drug);
                        $('#appointmentPrescriptiondrug').append(badge).append(' ');
                    });

                    $('#rdvId').val(id);
                    $('#rdvStatus').val(visited);

                    $('#viewDetailsModal').modal('show');
                });
            });
        </script>
    @endsection
