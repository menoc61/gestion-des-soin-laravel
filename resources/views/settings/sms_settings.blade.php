@extends('layouts.master')

@section('title')
{{ __('sentence.Doctorino Settings') }}
@endsection

@section('content')

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.SMS Gateway Setup') }}</h6>
         </div>
         <div class="card-body">
            <form method="post" action="{{ route('sms_settings.store') }}">
               <div class="form-group row">
                  <label for="NEXMO_KEY" class="col-sm-3 col-form-label">{{ __('sentence.NEXMO_KEY') }} </label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="NEXMO_KEY" name="NEXMO_KEY" value="{{ App\Setting::get_option('NEXMO_KEY') }}" required>
                     {{ csrf_field() }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="NEXMO_SECRET" class="col-sm-3 col-form-label">{{ __('sentence.NEXMO_SECRET') }}</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="NEXMO_SECRET" name="NEXMO_SECRET" value="{{ App\Setting::get_option('NEXMO_SECRET') }}" required>
                  </div>
               </div>
            
               <div class="form-group row">
                  <div class="col-sm-9">
                     <button type="submit" class="btn btn-primary">{{ __('sentence.Save') }}</button>
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