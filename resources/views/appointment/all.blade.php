@extends('layouts.master')

@section('title')
    {{ __('sentence.All Patients') }}
@endsection

@section('content')

    <div class="">
        <div class="mb-3">
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-12">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary text-center"> {{ __('sentence.All Appointments') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales  -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Appointments') }}</h6>
                </div>
                <div class="col-6">
                    @can('create appointment')
                        <a href="{{ route('appointment.create') }}" class="btn btn-primary btn-sm float-right"><i
                                class="fa fa-plus"></i> {{ __('sentence.New Appointment') }}</a>
                    @endcan
                    <a href="{{ route('appointment.cancelled') }}" class="btn btn-danger btn-sm float-right mr-2"><i
                            class="fas fa-user-times"></i> {{ __('sentence.Cancelled') }}</a>
                    <a href="{{ route('appointment.pending') }}" class="btn btn-warning btn-sm float-right mr-2"><i
                            class="fas fa-user-clock"></i> {{ __('sentence.Pending') }}</a>
                    <a href="{{ route('appointment.treated') }}" class="btn btn-success btn-sm float-right mr-2"><i
                            class="fas fa-user-check"></i> {{ __('sentence.Treated') }}</a>
                </div>
            </div>
        </div>
        @if (Auth::user()->role_id == 3)
            <div class="row">
                <div class="col">
                    @can('create appointment')
                        <a type="button" class="btn btn-primary btn-sm my-4 float-right"
                            href="{{ route('appointment.create_by', ['id' => Auth::user()->id]) }}"><i class="fa fa-plus"></i>
                            {{ __('sentence.New Appointment') }}</a>
                    @endcan
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
                @forelse($Myappointments as  $key => $Myappointment)
                    <tr>
                        <td align="center">{{ $key + 1 }} </td>
                        <td align="center"><label class="badge badge-primary-soft"><i class="fas fa-calendar"></i>
                                {{ $Myappointment->date->format('d M Y') }} </label></td>
                        <td align="center"><label class="badge badge-primary-soft"><i class="fa fa-clock"></i>
                                {{ $Myappointment->time_start }} -
                                {{ $Myappointment->time_end }} </label></td>
                        <td class="text-center">
                            @if ($Myappointment->visited == 0)
                                <label class="badge badge-warning-soft">
                                    <i class="fas fa-hourglass-start"></i>
                                    {{ __('sentence.Not Yet Visited') }}
                                </label>
                            @elseif($Myappointment->visited == 1)
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
                                    $appointmentDate = \Carbon\Carbon::parse($Myappointment->date);
                                    $appointmentTimeStart = \Carbon\Carbon::parse($Myappointment->time_start);
                                    $currentDateTime = now();
                                    $isFutureDateTime =
                                        $appointmentDate->isFuture() ||
                                        ($appointmentDate->isToday() && $appointmentTimeStart->isFuture());
                                @endphp

                                <a data-rdv_id="{{ $Myappointment->id }}"
                                    data-rdv_date="{{ $Myappointment->date->format('d M Y') }}"
                                    data-rdv_time_start="{{ $Myappointment->time_start }}"
                                    data-rdv_time_end="{{ $Myappointment->time_end }}"
                                    data-patient_name="{{ $Myappointment->User->name }}"
                                    class="btn btn-outline-success btn-circle btn-sm{{ $isFutureDateTime ? ' disabled opacity-button' : '' }}"
                                    data-toggle="modal" data-target="#EDITRDVModal">
                                    <i class="fas fa-check"></i>
                                </a>
                            @endcan
                            @can('delete appointment')
                                <a href="{{ url('appointment/delete/' . $Myappointment->id) }}"
                                    class="btn btn-outline-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" align="center"><img src="{{ asset('img/not-found.svg') }}" width="200" />
                            <br><br>
                            <b class="text-muted">{{ __('sentence.No appointment available') }}</b>
                        </td>
                    </tr>
                @endforelse
            </table>
        @else
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>{{ __('sentence.Patient Name') }}</th>
                                {{-- <th class="text-center">{{ __('sentence.Reason for visit') }}</th> --}}
                                <th class="text-center">{{ __('sentence.Schedule Info') }}</th>
                                <th class="text-center">{{ __('sentence.Status') }}</th>
                                {{-- <th class="text-center">{{ __('sentence.Created at') }}</th> --}}
                                <th class="text-center">{{ __('sentence.Visited At') }}</th>
                                <th class="text-center">{{ __('sentence.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $key => $appointment)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td><a href="{{ url('patient/view/' . $appointment->user_id) }}">
                                            {{ $appointment->User->name }} </a></td>
                                    {{-- <td class="text-center"><label
                                            class="badge badge-primary-soft">{{ $appointment->reason }}</label></td> --}}

                                    <td class="text-center">
                                        <label class="badge badge-primary-soft">
                                            <i class="fas fa-calendar"></i> {{ $appointment->date->format('d M Y') }}
                                        </label>
                                        <label class="badge badge-primary-soft">
                                            <i class="fa fa-clock"></i> {{ $appointment->time_start }} -
                                            {{ $appointment->time_end }}
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        @if ($appointment->visited == 0)
                                            <label class="badge badge-warning-soft">
                                                <i class="fas fa-hourglass-start"></i> {{ __('sentence.Not Yet Visited') }}
                                            </label>
                                        @elseif($appointment->visited == 1)
                                            <label class="badge badge-success-soft">
                                                <i class="fas fa-check"></i> {{ __('sentence.Visited') }}
                                            </label>
                                        @else
                                            <label class="badge badge-danger-soft">
                                                <i class="fas fa-user-times"></i> {{ __('sentence.Cancelled') }}
                                            </label>
                                        @endif
                                    </td>
                                    {{-- <td class="text-center">{{ $appointment->created_at->format('d M Y H:i') }}</td> --}}
                                    <td class="text-center">
                                        @if ($appointment->visited == 1)
                                            <label class="badge badge-primary-soft">
                                                <i class="fas fa-calendar"></i>
                                                {{ $appointment->updated_at->format('d M Y H:i') }}
                                            </label>
                                        @endif
                                    </td>
                                    <td align="center">
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
                            @empty
                                <tr>
                                    <td colspan="7" align="center"><img src="{{ asset('img/rest.png') }} " />
                                        <br><br> <b class="text-muted">Vous n'avez pas de Rendez-Vous</b>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <span class="float-right mt-3">{{ $appointments->links() }}</span>
                </div>
            </div>
        @endif
    </div>
    <!--EDIT Appointment Modal-->
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
                    <p><b>{{ __('sentence.Date') }} :</b> <label class="badge badge-primary-soft" id="rdv_date"></label>
                    </p>
                    <p><b>{{ __('sentence.Time Slot') }} :</b> <label class="badge badge-primary-soft"
                            id="rdv_time"></label></p>
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
@endsection

@section('header')
    <style type="text/css">
        td>a {
            font-weight: 600;
            font-size: 15px;
        }
    </style>
@endsection

@section('footer')
@endsection
