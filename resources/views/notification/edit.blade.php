@extends('layouts.master')

@section('title')
{{ __('Edit Notification') }}
@endsection

@section('content')

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit Notification') }}</h6>
         </div>
         <div class="card-body">

            <form method="post" action="{{ route('notification.store_edit') }}">
               <div class="form-group">
                  <label for="title">{{ __('Title') }} *</label>
                  <input type="text" class="form-control" name="title" id="title" aria-describedby="title" value="{{ $notification->title }}">
                  <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                  {{ csrf_field() }}
               </div>
               <div class="form-group">
                  <label for="content">{{ __('Content') }}</label>
                  <textarea class="form-control" name="content" id="content" aria-describedby="content" cols="30" rows="5">{{ $notification->content }}</textarea>
                  {{ csrf_field() }}
               </div>
               <div class="form-group">
                  <label for="type">{{ __('Color') }}</label>
                  <select type="text" class="form-control" name="type" id="type">
                     <option value="success" @if($notification->type == 'success') selected @endif>Success</option>
                     <option value="danger" @if($notification->type == 'danger') selected @endif>Danger</option>
                     <option value="warning" @if($notification->type == 'warning') selected @endif>Warning</option>
                     <option value="info" @if($notification->type == 'info') selected @endif>Info</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="start_date">{{ __('Start Date') }}</label>
                  <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $notification->start_date }}">
               </div>
               <div class="form-group">
                  <label for="end_date">{{ __('End Date') }}</label>
                  <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $notification->end_date }}">
               </div>
               <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
