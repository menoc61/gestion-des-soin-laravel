@extends('layouts.master')

@section('title')
{{ __('sentence.Dashboard') }}
@endsection

@section('content')

@can('create prescription')
<div class="row">
   <div class="col">
      <div class="alert alert-warning">Simplifies prescription and appointments, helping you to manage patients & you chamber in a smart way. <br><b><a href="{{ route('appointment.create') }}">Create your first prescription</a></b> in less than 60 seconds.</div>
   </div>
</div>
@endcan

@role('Admin')

<div class="row">

   <!-- Earnings (Monthly) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('sentence.New Appointments') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_appointments_today->count() }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Earnings (Annual) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('sentence.Total Appointments') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_appointments }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Tasks Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{ __('sentence.New Patients') }}</div>
                  <div class="row no-gutters align-items-center">
                     <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_patients_today }}</div>
                     </div>
                  </div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-user-plus fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Pending Requests Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('sentence.All Patients') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_patients }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="row">
   <!-- Earnings (Monthly) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('sentence.Total Prescriptions') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_prescriptions }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-pills fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Earnings (Annual) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('sentence.Total Payments') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_payments }}</div>
               </div>
               <div class="col-auto">
                  <i class="fa fa-wallet fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Tasks Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-secondary shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{ __('sentence.Payments this month') }}</div>
                  <div class="row no-gutters align-items-center">
                     <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_payments_month }} {{ App\Setting::get_option('currency') }}</div>
                     </div>
                  </div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Pending Requests Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">{{ __('sentence.Payments this year') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_payments_year }} {{ App\Setting::get_option('currency') }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endrole

@role('Receptionist')

<div class="row">

   <!-- Earnings (Monthly) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('sentence.New Appointments') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_appointments_today->count() }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Earnings (Annual) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('sentence.Total Appointments') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_appointments }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Tasks Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{ __('sentence.New Patients') }}</div>
                  <div class="row no-gutters align-items-center">
                     <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_patients_today }}</div>
                     </div>
                  </div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-user-plus fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Pending Requests Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('sentence.All Patients') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_patients }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endrole

@role('Admin|Receptionist')

<div class="row">
   <div class="col">
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <div class="row">
               <div class="col-8">
                  <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.New Appointments') }} - {{ Today()->format('d M Y') }}</h6>
               </div>
               <div class="col-4">
                  @can('view all appointments')
                  <a href="{{ route('appointment.all') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-calendar"></i> {{ __('sentence.All Appointments') }}</a>
                  @endcan
                  @can('create appointment')
                  <a href="{{ route('appointment.create') }}" class="btn btn-primary btn-sm float-right mr-2"><i class="fa fa-plus"></i> {{ __('sentence.New Appointment') }}</a>
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
                        <th>{{ __('sentence.Date') }}</th>
                        <th>{{ __('sentence.Time Slot') }}</th>
                        <th class="text-center">{{ __('sentence.Status') }}</th>
                        <th class="text-center">{{ __('sentence.Created at') }}</th>
                        <th class="text-center">{{ __('sentence.Actions') }}</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($total_appointments_today as $appointment)
                     <tr>
                        <td class="text-center">{{ $appointment->id }}</td>
                        <td>
                           <a href="{{ url('patient/view/'.$appointment->user_id) }}"> {{ $appointment->User->name }} </a>
                        </td>
                        <td>
                           <label class="badge badge-primary-soft"><i class="fas fa-calendar"></i> {{ $appointment->date->format('d M Y') }} </label>
                        </td>
                        <td>
                           <label class="badge badge-primary-soft"><i class="fa fa-clock"></i> {{ $appointment->time_start }} - {{ $appointment->time_end }}</label>
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
                        <td colspan="7" align="center"><img src="{{ asset('img/rest.png') }} "/> <br><br> <b class="text-muted">You have no appointment today</b></td>
                     </tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@endrole
<!-- EDIT Appointment Modal-->
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
            <p><b>{{ __('sentence.Time Slot') }} :</b> <label class="badge badge-primary-soft" id="rdv_time"></span></label>
         </div>
         <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">{{ __('sentence.Close') }}</button>
            <a class="btn btn-primary text-white" onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();">{{ __('sentence.Confirm Appointment') }}</a>
            <form id="rdv-form-confirm" action="{{ route('appointment.store_edit') }}" method="POST" class="d-none">
               <input type="hidden" name="rdv_id" id="rdv_id">
               <input type="hidden" name="rdv_status" value="1">
               @csrf
            </form>
            <a class="btn btn-primary text-white" onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();">{{ __('sentence.Cancel Appointment') }}</a>
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

@endsection

@section('footer')

@endsection