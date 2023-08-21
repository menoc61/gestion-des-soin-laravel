@extends('layouts.master')

@section('title')
{{ __('sentence.All Patients') }}
@endsection

@section('content')

<!-- DataTales  -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-8">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Appointments') }}</h6>
         </div>
         <div class="col-4">
            @can('create appointment')
            <a href="{{ route('appointment.create') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> {{ __('sentence.New Appointment') }}</a>
            @endcan
         </div>
      </div>
   </div>
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
                  <th class="text-center">{{ __('sentence.Actions') }}</th>
               </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
               <tr>
                  <td class="text-center">{{ $appointment->id }}</td>
                  <td><a href="{{ url('patient/view/'.$appointment->user_id) }}"> {{ $appointment->User->name }} </a></td>
                  <td class="text-center"><label class="badge badge-primary-soft">{{ $appointment->reason }}</label></td>

                  <td class="text-center"> 
                     <label class="badge badge-primary-soft">
                        <i class="fas fa-calendar"></i> {{ $appointment->date->format('d M Y') }}
                     </label>
                      <label class="badge badge-primary-soft">
                        <i class="fa fa-clock"></i> {{ $appointment->time_start }} - {{ $appointment->time_end }}
                     </label>
                  </td>
                  <td class="text-center">
                     @if($appointment->visited == 0)
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
                  <td align="center">
                     @can('edit appointment')
                     <a data-rdv_id="{{ $appointment->id }}" data-rdv_date="{{ $appointment->date->format('d M Y') }}" data-rdv_time_start="{{ $appointment->time_start }}" data-rdv_time_end="{{ $appointment->time_end }}" data-patient_name="{{ $appointment->User->name }}" class="btn btn-outline-success btn-circle btn-sm" data-toggle="modal" data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
                     @endcan
                     @can('delete appointment')
                     <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ url('appointment/delete/'.$appointment->id) }}"><i class="fas fa-trash"></i></a>
                     @endcan
                  </td>
               </tr>
                @empty
                     <tr>
                        <td colspan="7" align="center"><img src="{{ asset('img/rest.png') }} "/> <br><br> <b class="text-muted">You have no appointment</b></td>
                     </tr>
               @endforelse
            </tbody>
         </table>

         <span class="float-right mt-3">{{ $appointments->links() }}</span>
      </div>
   </div>
</div>
<!--EDIT Appointment Modal-->
<div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('sentence.You are about to modify an appointment') }}</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient_name"></span></p>
            <p><b>{{ __('sentence.Date') }} :</b> <label class="badge badge-primary-soft" id="rdv_date"></label></p>
            <p><b>{{ __('sentence.Time Slot') }} :</b> <label class="badge badge-primary-soft" id="rdv_time"></label></p>
         </div>
         <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('sentence.Close') }}</button>
            <a class="btn btn-primary text-white" onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();">{{ __('sentence.Confirm Appointment') }}</a>
            <form id="rdv-form-confirm" action="{{ route('appointment.store_edit') }}" method="POST" class="d-none">
               <input type="hidden" name="rdv_id" id="rdv_id">
               <input type="hidden" name="rdv_status" value="1">
               @csrf
            </form>
            <a class="btn btn-danger text-white" onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();">{{ __('sentence.Cancel Appointment') }}</a>
            <form id="rdv-form-cancel" action="{{ route('appointment.store_edit') }}" method="POST" class="d-none">
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
   td > a {
      font-weight: 600;
      font-size: 15px;
   }
</style>
@endsection

@section('footer')

@endsection