@extends('layouts.master')

@section('title')
{{ $patient->name }}
@endsection

@section('content')
<div class="row justify-content-center">
   <div class="col">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="row">
               <div class="col-4">
                  <img src="{{ asset('img/patient-icon.png') }}" class="img-profile rounded-circle img-fluid">
               </div>
               <div class="col-8">
                  <h4><b>{{ $patient->name }}</b></h4>
                  <hr>
                  @isset($patient->Patient->birthday)
                  <p><b>Age :</b> {{ $patient->Patient->birthday }} ({{ \Carbon\Carbon::parse($patient->Patient->birthday)->age }} Years)</p>
                  @endisset
                  @isset($patient->Patient->birthday)
                  <p><b>Gender :</b> {{ $patient->Patient->gender }}</p>
                  @endisset
                  @isset($patient->Patient->weight)
                  <p><b>Weight :</b> {{ $patient->Patient->weight }}</p>
                  @endisset
                  @isset($patient->Patient->height)
                  <p><b>Height :</b> {{ $patient->Patient->height }}</p>
                  @endisset
                  @isset($patient->Patient->blood)
                  <p><b>Blood Group :</b> {{ $patient->Patient->blood }}</p>
                  @endisset
                  @isset($patient->Patient->phone)
                  <p><b>Phone :</b> {{ $patient->Patient->phone }}</p>
                  @endisset
                  @isset($patient->Patient->adress)
                  <p><b>Address :</b> {{ $patient->Patient->adress }}</p>
                  @endisset
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('header')

@endsection

@section('footer')

@endsection