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
                                        <img src="{{ asset('uploads/'.$patient->image) }}" alt="profil-img" class="rounded-circle img-thumbnail avatar-xl">
                                        @else
                                        <img src="{{ asset('img/default-image.jpeg') }}" alt="profil-img" class="rounded-circle img-thumbnail avatar-xl">
                                        @endempty
                                        <div class="online-circle">
                                            <i class="fa fa-circle text-success"></i>
                                        </div>
                                        <h4 class="mt-2">{{ $patient->name }}</h4>

                                        <a href="{{ route('patient.SendPassword', ['id' => $patient->id]) }}" class="btn btn-doctorino btn-sm btn-round px-3"> {{ __('Send Credentials') }}</a>
                                        <a href="{{ url('patient/edit/' . $patient->id) }}" class="btn btn-danger btn-sm btn-round px-3"> <i class="fa fa-pen"></i></a>
                                        <ul class="list-unstyled list-inline mt-3 text-muted">
                                            <li class="list-inline-item font-size-13 me-3">
                                                <strong class="text-dark">{{ $appointments->count() }}</strong> {{ __('Appointments') }}
                                            </li>
                                            <li class="list-inline-item font-size-13">
                                                <strong class="text-dark">{{ $invoices->count() }}</strong> {{ __('Invoices') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <table class="table table-striped">
                                <tr>
                                    @isset($patient->Patient->birthday)
                                        <td>
                                            <p><b>{{ __('sentence.Birthday') }} :</b> {{ $patient->Patient->birthday }}
                                                ({{ \Carbon\Carbon::parse($patient->Patient->birthday)->age }} ANS)</p>
                                        </td>
                                    @endisset
                                </tr>

                                <tr>
                                    @isset($patient->Patient->gender)
                                        <td>
                                            <p><b>{{ __('sentence.Gender') }} :</b> {{ $patient->Patient->gender }}</p>
                                        </td>
                                    @endisset
                                </tr>

                                <tr>
                                    @isset($patient->Patient->phone)
                                        <td>
                                            <p><b>{{ __('sentence.Phone') }} :</b> {{ $patient->Patient->phone }}</p>
                                        </td>
                                    @endisset
                                </tr>

                                <tr>
                                    @isset($patient->Patient->adress)
                                        <td>
                                            <p><b>{{ __('sentence.Address') }} :</b> {{ $patient->Patient->adress }}</p>
                                        </td>
                                    @endisset
                                </tr>

                                <tr>
                                    @isset($patient->Patient->allergie)
                                        <td>
                                            <p><b>{{ __('sentence.Allergies') }} :</b> {{ $patient->Patient->allergie }}</p>
                                        </td>
                                    @endisset
                                </tr>

                                <tr>
                                    @isset($patient->Patient->hobbie)
                                        <td>
                                            <p><b>{{ __('sentence.Hobbies') }} :</b> {{ $patient->Patient->hobbie }}</p>
                                        </td>
                                    @endisset
                                </tr>

                                <tr>
                                    @isset($patient->Patient->demande)
                                        <td>
                                            <p><b>{{ __('sentence.Special Requests') }} :</b> {{ $patient->Patient->demande }}
                                            </p>
                                        </td>
                                    @endisset
                                </tr>
                            </table>

                            <hr>

                            <table class="table table-striped">
                                <tr>
                                    @isset($patient->Patient->morphology)
                                        <td>
                                            <p><b>{{ __('sentence.Morphology') }} :</b>
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
                                            </p>
                                        </td>
                                    @endisset
                                </tr>

                                <tr>
                                    @isset($patient->Patient->alimentation)
                                        <td>
                                            <p><b>{{ __('sentence.Alimentation') }} :</b>
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
                                            </p>
                                        </td>
                                    @endisset
                                </tr>

                                <tr>
                                    @isset($patient->Patient->type_patient)
                                        <td>
                                            <p><b>{{ __('sentence.Type of patient') }} :</b>
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
                                            </p>
                                        </td>
                                    @endisset
                                </tr>
                            </table>

                        </div>
                        <div class="col-md-8 col-sm-6">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile"
                                        role="tab" aria-controls="Profile"
                                        aria-selected="true">{{ __('sentence.Health History') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents"
                                        role="tab" aria-controls="documents" aria-selected="false">Fichier Médical</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="appointements-tab" data-toggle="tab" href="#appointements"
                                        role="tab" aria-controls="appointements"
                                        aria-selected="false">{{ __('sentence.Appointment') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="tests-tab" data-toggle="tab" href="#tests" role="tab"
                                        aria-controls="tests" aria-selected="false">{{ __('sentence.Test') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="prescriptions-tab" data-toggle="tab" href="#prescriptions"
                                        role="tab" aria-controls="prescriptions"
                                        aria-selected="false">{{ __('sentence.Prescriptions') }}</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="Billing-tab" data-toggle="tab" href="#Billing" role="tab"
                                        aria-controls="Billing"Alert
                                        aria-selected="false">{{ __('sentence.Payment History') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="profile" role="tabpanel"
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

                                  </div>
                                    {{-- Start Rendez-vous  --}}


                                <div class="tab-pane fade" id="appointements" role="tabpanel"
                                    aria-labelledby="appointements-tab">
                                    <div class="row">
                                        <div class="col">
                                            @can('create appointment')
                                                <a type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                    href="{{ route('appointment.create') }}"><i class="fa fa-plus"></i>
                                                    {{ __('sentence.New Appointment') }}</a>
                                                @endif
                                            </div>
                                        </div>
                                        <table class="table">
                                            <tr>
                                                <td align="center">Id</td>
                                                <td align="center">{{ __('sentence.Date') }}</td>
                                                <td align="center">{{ __('sentence.Time Slot') }}</td>
                                                <td align="center">{{ __('sentence.Status') }}</td>
                                                <td align="center">{{ __('sentence.Actions') }}</td>
                                            </tr>
                                            @forelse($appointments as  $key => $appointment)
                                                <tr>
                                                    <td align="center">{{  $key + 1 }} </td>
                                                    <td align="center"><label class="badge badge-primary-soft"><i
                                                                class="fas fa-calendar"></i>
                                                            {{ $appointment->date->format('d M Y') }} </label></td>
                                                    <td align="center"><label class="badge badge-primary-soft"><i
                                                                class="fa fa-clock"></i> {{ $appointment->time_start }} -
                                                            {{ $appointment->time_end }} </label></td>
                                                    <td class="text-center">
                                                        @if ($appointment->visited == 0)
                                                            <label class="badge badge-warning-soft">
                                                                <i class="fas fa-hourglass-start"></i>
                                                                {{ __('sentence.Not Yet Visited') }}
                                                            </label>
                                                        @elseif($appointment->visited == 1)
                                                            <label class="badge badge-success-soft">
                                                                <i class="fas fa-check"></i> {{ __('sentence.Visited') }}
                                                            </label>
                                                        @else
                                                            <label class="badge badge-danger-soft">
                                                                <i class="fas fa-user-times"></i>
                                                                {{ __('sentence.Cancelled') }}
                                                            </label>
                                                        @endif
                                                    </td>
                                                    <td align="center">
                                                        @can('edit appointment')
                                                        @php
                                                            $appointmentDate = \Carbon\Carbon::parse($appointment->date);
                                                            $appointmentTimeStart = \Carbon\Carbon::parse($appointment->time_start);
                                                            $currentDateTime = now();
                                                            $isFutureDateTime =
                                                                $appointmentDate->isFuture() ||
                                                                ($appointmentDate->isToday() && $appointmentTimeStart->isFuture());
                                                        @endphp

                                                        <a data-rdv_id="{{ $appointment->id }}"
                                                            data-rdv_date="{{ $appointment->date->format('d M Y') }}"
                                                            data-rdv_time_start="{{ $appointment->time_start }}"
                                                            data-rdv_time_end="{{ $appointment->time_end }}"
                                                            data-patient_name="{{ $appointment->User->name }}"
                                                            class="btn btn-outline-success btn-circle btn-sm{{ $isFutureDateTime ? ' disabled opacity-button' : '' }}"
                                                            data-toggle="modal" data-target="#EDITRDVModal">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                    @endcan
                                                        @can('delete appointment')
                                                            <a href="{{ url('appointment/delete/' . $appointment->id) }}"
                                                                class="btn btn-outline-danger btn-circle btn-sm"><i
                                                                    class="fas fa-trash"></i></a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" align="center"><img
                                                            src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br>
                                                        <b
                                                            class="text-muted">{{ __('sentence.No appointment available') }}</b>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </table>
                                    </div>

                                    {{-- End Rendez-vous  --}}


                                    {{-- Start Test  --}}

                                    <div class="tab-pane fade" id="tests" role="tabpanel" aria-labelledby="tests-tab">
                                        <div class="row">
                                            <div class="col">
                                                <a class="btn btn-primary btn-sm my-4 float-right"
                                                    href="{{ route('test.create_by', ['id' => $patient->id]) }}"><i
                                                        class="fa fa-pen"></i>
                                                    {{ __('sentence.Add Test') }}</a>
                                            </div>
                                        </div>
                                        <table class="table " id="dataTable" width="100%" cellspacing="0">
                                            <tr>
                                                <td align="center"><b>Id</b></td>
                                                <td align="center"><b> Nom Diagnostic</b> </td>
                                                <td align="center"><b>Description</b> </td>
                                                <td align="center"><b> Utilisation </b></td>
                                                <td align="center"><b> Action</b> </td>
                                            </tr>
                                            @forelse($tests as $key => $test)
                                                @if (Auth::user()->role_id == 2 && Auth::user()->id == $test->created_by)
                                                    <tr>
                                                        <td align="center">{{ $ $key + 1 }}</td>
                                                        <td align="center">{{ $test->test_name }}</td>
                                                        <td align="center"> {{ $test->comment }} </td>
                                                        <td align="center">{{ __('sentence.In Prescription') }} :
                                                            {{ $test->Prescription->count() }} {{ __('sentence.time use') }}
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
                                                    </tr>
                                                @elseif (Auth::user()->role_id == 1)
                                                    <tr>
                                                        <td align="center">{{  $key + 1 }}</td>
                                                        <td align="center">{{ $test->test_name }}</td>
                                                        <td align="center"> {{ $test->comment }} </td>
                                                        <td align="center">{{ __('sentence.In Prescription') }} :
                                                            {{ $test->Prescription->count() }} {{ __('sentence.time use') }}
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
                                                    </tr>
                                                @endif
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center"><img
                                                            src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br>
                                                        <b class="text-muted">pas de diagnostic trouvé</b>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </table>
                                    </div>

                                    {{-- End Test  --}}


                                    {{-- Start Prescription  --}}

                                    <div class="tab-pane fade" id="prescriptions" role="tabpanel"
                                        aria-labelledby="prescriptions-tab">
                                        <div class="row">
                                            <div class="col">
                                                @can('create prescription')
                                                    <a class="btn btn-primary btn-sm my-4 float-right"
                                                        href="{{ route('prescription.create_by', ['id' => $patient->id]) }}"><i
                                                            class="fa fa-pen"></i>
                                                        {{ __('sentence.Create Prescription') }}</a>
                                                @endcan
                                            </div>
                                        </div>
                                        <table class="table">
                                            <tr>
                                                <td align="center">{{ __('sentence.Reference') }}</td>
                                                <td class="text-center">{{ __('sentence.Content') }}</td>
                                                <td align="center">{{ __('sentence.Created at') }}</td>
                                                <td align="center">{{ __('sentence.follow') }}</td>
                                                <td align="center">{{ __('sentence.Actions') }}</td>
                                            </tr>
                                            @forelse($prescriptions as $prescription)
                                                @if (Auth::user()->role_id == 2 && Auth::user()->id == $prescription->doctor_id)
                                                    <tr>
                                                        <td align="center">{{ $prescription->reference }} </td>
                                                        <td class="text-center">
                                                            <label class="badge badge-primary-soft">
                                                                {{ count($prescription->Drug) }} Soins
                                                            </label>
                                                            <label class="badge badge-primary-soft">
                                                                {{ count($prescription->Test) }} Diagnostics
                                                            </label>
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
                                                @elseif (Auth::user()->role_id == 1)
                                                    <tr>
                                                        <td align="center">{{ $prescription->reference }} </td>
                                                        <td class="text-center">
                                                            <label class="badge badge-primary-soft">
                                                                {{ count($prescription->Drug) }} Soins
                                                            </label>
                                                            <label class="badge badge-primary-soft">
                                                                {{ count($prescription->Test) }} Diagnostics
                                                            </label>
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
                                                @endif
                                            @empty
                                                <tr>
                                                    <td colspan="4" align="center"> <img
                                                            src="{{ asset('img/not-found.svg') }}" width="200" />
                                                        <br><br>
                                                        <b class="text-muted">
                                                            {{ __('sentence.No prescription available') }}</b>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </table>
                                    </div>

                                    {{-- End Prescription  --}}

                                    <div class="tab-pane fade" id="documents" role="tabpanel"
                                        aria-labelledby="documents-tab">
                                        <div class="row">
                                            <div class="col">
                                                @can('edit patient')
                                                    <button type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                        data-toggle="modal" data-target="#NewDocumentModel"><i
                                                            class="fa fa-plus"></i> {{ __('sentence.Add New') }}</button>
                                                @endcan
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
                                                                    class="fa fa-cloud-download-alt"></i> Download</a>
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


                                    {{-- Start Facturation --}}

                                    <div class="tab-pane fade" id="Billing" role="tabpanel" aria-labelledby="Billing-tab">
                                        <div class="row mt-4">
                                            <div class="col-lg-6 mb-4">
                                                <div class="card bg-success text-white shadow">
                                                    <div class="card-body">
                                                        {{ __('sentence.Total With Tax') }}
                                                        <div class="text-white small">
                                                            {{ Collect($invoices)->sum('total_with_tax') }}
                                                            {{ App\Setting::get_option('currency') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-4 mb-4">
                                                <div class="card bg-success text-white shadow">
                                                    <div class="card-body">
                                                        {{ __('sentence.Already Paid') }}
                                                        <div class="text-white small">
                                                            {{ Collect($invoices)->sum('deposited_amount') }}
                                                            {{ App\Setting::get_option('currency') }}</div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="col-lg-6 mb-4">
                                                <div class="card bg-danger text-white shadow">
                                                    <div class="card-body">
                                                        {{ __('sentence.Due Balance') }}
                                                        <div class="text-white small">
                                                            {{ Collect($invoices)->whereIn('payment_status', ['Partially Paid', 'Unpaid'])->sum('due_amount') }}
                                                            {{ App\Setting::get_option('currency') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                @can('create invoice')
                                                    <a type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                        href="{{ route('billing.create_by', ['id' => $patient->id]) }}"><i
                                                            class="fa fa-plus"></i>
                                                        {{ __('sentence.Create Invoice') }}</a>
                                                @endcan
                                            </div>
                                        </div>
                                        <table class="table">
                                            <tr>
                                                <th>{{ __('sentence.Invoice') }}</th>
                                                <th>{{ __('sentence.Date') }}</th>
                                                <th>{{ __('sentence.Amount') }}</th>
                                                <th>{{ __('sentence.Status') }}</th>
                                                <th>{{ __('sentence.Actions') }}</th>
                                            </tr>
                                            @forelse($invoices as $invoice)
                                                @if (Auth::user()->role_id == 2 && Auth::user()->id == $invoice->created_by)
                                                    <tr>
                                                        <td><a
                                                                href="{{ url('billing/view/' . $invoice->id) }}">{{ $invoice->reference }}</a>
                                                        </td>
                                                        <td><label
                                                                class="badge badge-primary-soft">{{ $invoice->created_at->format('d M Y h:m:s') }}</label>
                                                        </td>
                                                        <td> {{ $invoice->total_with_tax }}
                                                            {{ App\Setting::get_option('currency') }}
                                                            @if ($invoice->payment_status == 'Unpaid' or $invoice->payment_status == 'Partially Paid')
                                                                <label
                                                                    class="badge badge-danger-soft">{{ $invoice->due_amount }}
                                                                    {{ App\Setting::get_option('currency') }} </label>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($invoice->payment_status == 'Unpaid')
                                                                <label class="badge badge-danger-soft">
                                                                    <i class="fas fa-hourglass-start"></i>
                                                                    {{ __('sentence.Unpaid') }}
                                                                </label>
                                                            @elseif($invoice->payment_status == 'Paid')
                                                                <label class="badge badge-success-soft">
                                                                    <i class="fas fa-check"></i> {{ __('sentence.Paid') }}
                                                                </label>
                                                            @else
                                                                <label class="badge badge-warning-soft">
                                                                    <i class="fas fa-user-times"></i>
                                                                    {{ __('sentence.Partially Paid') }}
                                                                </label>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @can('view invoice')
                                                                <a href="{{ url('billing/view/' . $invoice->id) }}"
                                                                    class="btn btn-outline-success btn-circle btn-sm"><i
                                                                        class="fas fa-print"></i></a>
                                                            @endcan
                                                            @can('edit invoice')
                                                                <a href="{{ url('billing/edit/' . $invoice->id) }}"
                                                                    class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                        class="fas fa-pen"></i></a>
                                                            @endcan
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
                                                        <td><a
                                                                href="{{ url('billing/view/' . $invoice->id) }}">{{ $invoice->reference }}</a>
                                                        </td>
                                                        <td><label
                                                                class="badge badge-primary-soft">{{ $invoice->created_at->format('d M Y h:m:s') }}</label>
                                                        </td>
                                                        <td> {{ $invoice->total_with_tax }}
                                                            {{ App\Setting::get_option('currency') }}
                                                            @if ($invoice->payment_status == 'Unpaid' or $invoice->payment_status == 'Partially Paid')
                                                                <label
                                                                    class="badge badge-danger-soft">{{ $invoice->due_amount }}
                                                                    {{ App\Setting::get_option('currency') }} </label>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($invoice->payment_status == 'Unpaid')
                                                                <label class="badge badge-danger-soft">
                                                                    <i class="fas fa-hourglass-start"></i>
                                                                    {{ __('sentence.Unpaid') }}
                                                                </label>
                                                            @elseif($invoice->payment_status == 'Paid')
                                                                <label class="badge badge-success-soft">
                                                                    <i class="fas fa-check"></i> {{ __('sentence.Paid') }}
                                                                </label>
                                                            @else
                                                                <label class="badge badge-warning-soft">
                                                                    <i class="fas fa-user-times"></i>
                                                                    {{ __('sentence.Partially Paid') }}
                                                                </label>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @can('view invoice')
                                                                <a href="{{ url('billing/view/' . $invoice->id) }}"
                                                                    class="btn btn-outline-success btn-circle btn-sm"><i
                                                                        class="fas fa-print"></i></a>
                                                            @endcan
                                                            @can('edit invoice')
                                                                <a href="{{ url('billing/edit/' . $invoice->id) }}"
                                                                    class="btn btn-outline-warning btn-circle btn-sm"><i
                                                                        class="fas fa-pen"></i></a>
                                                            @endcan
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
                                                @endif
                                            @empty
                                                <tr>
                                                </tr>
                                                <td colspan="6" align="center"><img
                                                        src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <b
                                                        class="text-muted">{{ __('sentence.No Invoices Available') }}</b>
                                                </td>
                                            @endforelse
                                        </table>
                                    </div>

                                    {{-- End Facturation --}}

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
    @endsection

    @section('header')
        <link rel="stylesheet" href="{{ asset('dashboard/css/lightbox.css') }}" />
    @endsection
    @section('footer')
        <script type="text/javascript" src="{{ asset('dashboard/js/lightbox.js') }}"></script>
    @endsection
