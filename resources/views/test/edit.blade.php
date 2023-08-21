@extends('layouts.master')

@section('title')
{{ __('sentence.Edit Test') }}
@endsection

@section('content')

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Edit Test') }}</h6>
         </div>
         <div class="card-body">
            <form method="post" action="{{ route('test.store_edit') }}">
               <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">{{ __('sentence.Test Name') }}<font color="red">*</font></label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputEmail3" name="test_name" value="{{ $test->test_name }}">
                     {{ csrf_field() }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Description') }}</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputPassword3" name="comment" value="{{ $test->comment }}">
                     <input type="hidden" name="test_id" value="{{ $test->id }}">
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