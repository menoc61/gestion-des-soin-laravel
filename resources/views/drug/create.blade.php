@extends('layouts.master')

@section('title')
{{ __('sentence.Add Drug') }}
@endsection

@section('content')
<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Add Drug') }}</h6>
         </div>
         <div class="card-body">
            
            <form method="post" action="{{ route('drug.store') }}">
               <div class="form-group">
                  <label for="exampleInputEmail1">{{ __('sentence.Trade Name') }} *</label>
                  <input type="text" class="form-control" name="trade_name" id="TradeName" aria-describedby="TradeName">
                  {{ csrf_field() }}
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">{{ __('sentence.Generic Name') }} *</label>
                  <input type="text" class="form-control" name="generic_name" id="GenericName">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">{{ __('sentence.Note') }}</label>
                  <input type="text" class="form-control" name="note" id="Note">
               </div>
               <button type="submit" class="btn btn-primary">{{ __('sentence.Save') }}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection