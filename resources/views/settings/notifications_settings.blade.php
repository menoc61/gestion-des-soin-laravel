@extends('layouts.master')

@section('title')
{{ __('Doctorino Settings') }}
@endsection

@section('content')

<div class="mb-3">
    <button class="btn btn-primary" onclick="history.back()">Retour</button>
</div>

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Nexmo for SMS Notifications') }}</h6>
         </div>
         <div class="card-body">
            <form method="post" action="{{ route('notifications_settings.store') }}">
               <div class="form-group row">
                  <label for="NEXMO_KEY" class="col-sm-4 col-form-label">{{ __('NEXMO_KEY') }} </label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="NEXMO_KEY" name="NEXMO_KEY" value="{{ App\Setting::get_option('NEXMO_KEY') }}">
                     {{ csrf_field() }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="NEXMO_SECRET" class="col-sm-4 col-form-label">{{ __('NEXMO_SECRET') }}</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="NEXMO_SECRET" name="NEXMO_SECRET" value="{{ App\Setting::get_option('NEXMO_SECRET') }}">
                  </div>
               </div>
         </div>
      </div>
   </div>
</div>

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Twilio for Whatsapp Notifications') }}</h6>
         </div>
         <div class="card-body">
               <div class="form-group row">
                  <label for="TWILIO_AUTH_SID" class="col-sm-4 col-form-label">{{ __('TWILIO AUTH SID') }} </label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="TWILIO_AUTH_SID" name="TWILIO_AUTH_SID" value="{{ App\Setting::get_option('TWILIO_AUTH_SID') }}">
                     {{ csrf_field() }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="TWILIO_AUTH_TOKEN" class="col-sm-4 col-form-label">{{ __('TWILIO AUTH TOKEN') }}</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="TWILIO_AUTH_TOKEN" name="TWILIO_AUTH_TOKEN" value="{{ App\Setting::get_option('TWILIO_AUTH_TOKEN') }}">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="TWILIO_WHATSAPP_FROM" class="col-sm-4 col-form-label">{{ __('TWILIO WHATSAPP FROM') }}</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="TWILIO_WHATSAPP_FROM" name="TWILIO_WHATSAPP_FROM" value="{{ App\Setting::get_option('TWILIO_WHATSAPP_FROM') }}">
                  </div>
               </div>

               <div class="form-group row">
                  <div class="col-sm-9">
                     <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                  </div>
               </div>
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
