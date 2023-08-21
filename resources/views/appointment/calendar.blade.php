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
            <a href="{{ route('appointment.create') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> {{ __('sentence.New Appointment') }}</a>
         </div>
      </div>
   </div>
   <div class="card-body">
      <div id="calendar"></div>
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
<link href='https://www.jqueryscript.net/demo/Full-Size-Drag-Drop-Calendar-Plugin-FullCalendar/fullcalendar.min.css' rel='stylesheet' />

@endsection

@section('footer')
<script src='https://www.jqueryscript.net/demo/Full-Size-Drag-Drop-Calendar-Plugin-FullCalendar/fullcalendar.min.js'></script>

@endsection