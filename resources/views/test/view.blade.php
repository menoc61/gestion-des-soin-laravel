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
                                <p><b>{{ __('sentence.Birthday') }} :</b> {{ $patient->Patient->birthday }}
                                    ({{ \Carbon\Carbon::parse($patient->Patient->birthday)->age }} ANS)</p>
                            @endisset

                            @isset($patient->Patient->gender)
                                <p><b>{{ __('sentence.Gender') }} :</b> {{ __('sentence.' . $patient->Patient->gender) }}</p>
                            @endisset

                            @isset($patient->Patient->phone)
                                <p><b>{{ __('sentence.Phone') }} :</b> {{ $patient->Patient->phone }}</p>
                            @endisset

                            @isset($patient->Patient->adress)
                                <p><b>{{ __('sentence.Address') }} :</b> {{ $patient->Patient->adress }}</p>
                            @endisset

                            @isset($patient->Patient->allergie)
                                <p><b>{{ __('sentence.Allergies') }} :</b> {{ $patient->Patient->allergie }}</p>
                            @endisset

                            @isset($patient->Patient->hobbie)
                                <p><b>{{ __('sentence.Hobbies') }} :</b> {{ $patient->Patient->hobbie }}</p>
                            @endisset

                            @isset($patient->Patient->demande)
                                <p><b>{{ __('sentence.Special Requests') }} :</b> {{ $patient->Patient->demande }}</p>
                            @endisset

                            <hr>

                            @isset($patient->Patient->morphology)
                                <p><b>{{ __('sentence.Morphology') }} :</b> {{ $patient->Patient->morphology }}</p>
                            @endisset

                            @isset($patient->Patient->alimentation)
                                <p><b>{{ __('sentence.Alimentation') }} :</b> {{ $patient->Patient->alimentation }}</p>
                            @endisset

                            @isset($patient->Patient->type_patient)
                                <p><b>{{ __('sentence.Type of patient') }} :</b> {{ $patient->Patient->type_patient }}</p>
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
