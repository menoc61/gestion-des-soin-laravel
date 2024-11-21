@extends('layouts.master')

@section('title')
    {{ __('sentence.All Patients') }}
@endsection

@section('content')

    <!-- DataTales  -->
    <div class="card shadow mb-4">
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
                @forelse($currentUserAppointments as  $key => $Myappointment)
                    <tr>
                        <td align="center">{{ $key + 1 }} </td>
                        <td align="center"><label class="badge badge-primary-soft"><i class="fas fa-calendar"></i>
                                {{ $Myappointment->date->format('d M Y') }} </label></td>
                        <td align="center"><label class="badge badge-primary-soft"><i class="fa fa-clock"></i>
                                {{ $Myappointment->time_start }} -
                                {{ $Myappointment->time_end }} </label></td>
                        <td class="text-center">
                            @if(($Myappointment->date < Today()) && ($Myappointment->visited != 1))
                                <label class="badge badge-danger-soft">
                                    <i class="fas fa-user-times"></i> date depassée-RDV annulé
                                </label>
                            @elseif ($Myappointment->visited == 0)
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
                                <th class="text-center">{{ __('sentence.Reason for visit') }}</th>
                                <th class="text-center">{{ __('sentence.Schedule Info') }}</th>
                                <th class="text-center">{{ __('sentence.Status') }}</th>
                                <th class="text-center">{{ __('sentence.Created at') }}</th>
                                <th class="text-center">{{ __('sentence.Visited At') }}</th>
                                <th class="text-center">{{ __('sentence.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($currentUserAppointments as $key => $appointment)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td><a href="{{ url('patient/view/' . $appointment->user_id) }}">
                                            {{ $appointment->User->name }} </a></td>
                                    <td class="text-center"><label
                                            class="badge badge-primary-soft">{{ $appointment->reason }}</label></td>

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
                                        @if(($appointment->date < Today()) && ($appointment->visited != 1))
                                           <label class="badge badge-danger-soft">
                                               <i class="fas fa-user-times"></i> date depassée-RDV annulé
                                           </label>
                                        @elseif ($appointment->visited == 0)
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
                                    <td class="text-center">{{ $appointment->created_at->format('d M Y H:i') }}</td>
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
                                            @if($appointment->date >= Today())
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
                                            @endif
                                        @endcan
                                        @if (($appointment->visited != 1) && ($appointment->date >= Today()))
                                          <a href="{{ route('appointment.edit_appointment', ['id' => $appointment->id]) }}"
                                               class="btn btn-outline-warning btn-circle btn-sm">
                                               <i class="fa fa-pen"></i>
                                          </a>
                                       @endif
                   
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

                </div>
            </div>
        @endif
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
