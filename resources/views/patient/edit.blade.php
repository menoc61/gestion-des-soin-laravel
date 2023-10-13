@extends('layouts.master')

@section('header')
    <style>
        .hidden-section {
            display: none;
        }
    </style>
    <link rel="stylesheet" type="text/css"
        href="https://davidstutz.github.io/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">
@endsection


@section('title')
    {{ __('sentence.Edit Patient') }}
@endsection


@section('content')
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">

                    <div class="row">
                        <div class="col-8">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Edit Patient') }}</h6>
                        </div>
                        <div class="col-4">
                            @can('view patient')
                                <a href="{{ route('patient.view', ['id' => $patient->id]) }}"
                                    class="btn btn-primary btn-sm float-right "><i class="fa fa-eye"></i>
                                    {{ __('sentence.View Patient') }}</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('patient.store_edit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('sentence.Full Name') }}<font color="red">*</font></label>
                                <input type="text" class="form-control" id="Name" name="name"
                                    value="{{ $patient->name }}">
                                <input type="hidden" class="form-control" name="user_id" value="{{ $patient->id }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">{{ __('sentence.Email Adress') }}<font color="red">*</font>
                                </label>
                                <input type="email" class="form-control" id="Email" name="email"
                                    value="{{ $patient->email }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">{{ __('sentence.Phone') }}<font color="red">*</font></label>
                                <input type="text" class="form-control" id="Phone" name="phone"
                                    value="{{ $patient->Patient->phone }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress">{{ __('sentence.Birthday') }}<font color="red">*</font>
                                </label>
                                <input type="date" class="form-control" id="Birthday" name="birthday"
                                    value="{{ $patient->Patient->birthday }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">{{ __('sentence.Address') }}<font color="red">*</font></label>
                                <input type="text" class="form-control" id="Address" name="adress"
                                    value="{{ $patient->Patient->adress }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputCity">{{ __('sentence.Gender') }}<font color="red">*</font></label><br>
                                <select class="form-control" name="gender" id="Gender">
                                    @foreach (['Homme', 'Femme'] as $option)
                                        <option value="{{ $option }}"
                                            {{ $patient->Patient->gender === $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-row col-md-10 ml-10">
                                <div class="form-group col-md-3">
                                    <label for="morphology_patient">{{ __('sentence.Morphology') }}<font color="red">*
                                        </font></label>
                                    <div class="col-md-3">
                                        <select class="form-control" id="morphology_patient" multiple="multiple"
                                            name="morphology[]">
                                            @if ($patient->Patient->morphology)
                                                @foreach (['Aucune', 'Grand(e)', 'Svelte', 'Petit(e)', 'Mince', 'Maigre', 'Rondeur', 'Enveloppé(e)'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ in_array($option, json_decode($patient->Patient->morphology) ?: []) ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="alimentation_patient">{{ __('sentence.Alimentation') }}<font
                                            color="red">*</font></label>
                                    <div class="col-md-3">
                                        <select class="form-control" id="alimentation_patient" multiple="multiple"
                                            name="alimentation[]">
                                            @if ($patient->Patient->alimentation)
                                                @foreach (['Aucune', 'Viande', 'Poisson', 'Légumes', 'Céréales', 'Tubercules', 'Fruits', 'Alcool', 'Pas d\'alcool', 'Fumeur', 'Non-fumeur'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ in_array($option, json_decode($patient->Patient->alimentation) ?: []) ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            @endif
                                            {{-- @foreach (['Viande', 'Poisson', 'Légumes', 'Céréales', 'Tubercules', 'Fruits', 'Alcool', 'Pas d\'alcool', 'Fumeur', 'Non-fumeur'] as $option)
                                                <option value="{{ $option }}"
                                                    {{ in_array($option, json_decode($patient->Patient->alimentation)) ? 'selected' : '' }}>
                                                    {{ $option }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="digestion_patient">{{ __('sentence.Digestion') }}<font color="red">*
                                        </font></label>
                                    <div class="col-md-3">
                                        <select class="form-control" id="digestion_patient" name="digestion">
                                            @foreach (['Bonne', 'Alternée', 'Médiocre'] as $option)
                                                <option value="{{ $option }}"
                                                    {{ $patient->Patient->digestion === $option ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="type_patient">{{ __('sentence.Type of patient') }}<font color="red">*
                                        </font></label>
                                    <div class="col-md-3">
                                        <select class="form-control" id="type_patient" multiple="multiple"
                                            name="type_patient[]">
                                            @if ($patient->Patient->type_patient)
                                                @foreach (['Aucun', 'Elancé(e)', 'Mince', 'Amazone', 'Forte'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ in_array($option, json_decode($patient->Patient->type_patient) ?: []) ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            @endif
                                            {{-- @foreach (['Elancé(e)', 'Mince', 'Amazone', 'Forte'] as $option)
                                                <option value="{{ $option }}"
                                                    {{ in_array($option, json_decode($patient->Patient->type_patient)) ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="hobbie">{{ __('sentence.Hobbies') }}<font color="red">*</font></label>
                                <input type="text" class="form-control" id="hobbie" name="hobbie"
                                    value="{{ $patient->Patient->hobbie }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="medication">{{ __('sentence.Medication') }}<font color="red">*</font>
                                </label>
                                <input type="text" class="form-control" id="medication" name="medication"
                                    value="{{ $patient->Patient->medication }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="allergie">{{ __('sentence.Allergies') }}<font color="red">*</font></label>
                                <input type="text" class="form-control" id="allergie" name="allergie"
                                    value="{{ $patient->Patient->allergie }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="request">{{ __('sentence.Special Requests') }}<font color="red">*</font>
                                </label>
                                <input type="text" class="form-control" id="request" name="demande"
                                    value="{{ $patient->Patient->demande }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputState">{{ __('sentence.Profil') }}</label>
                                <label for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i>
                                </label>
                                <input type="file" class="form-control" id="file-upload" name="image">
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
    <style type="text/css">
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
@endsection
@section('footer')
    <script type="text/javascript"
        src="https://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
        $('#morphology_patient, #alimentation_patient, #digestion_patient, #type_patient,#Gender').multiselect();
    </script>
@endsection
