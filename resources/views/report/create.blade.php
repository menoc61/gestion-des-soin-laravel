@extends('layouts.master')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-multiselect.css') }}">
@endsection

@section('title')
    {{ __('sentence.New report') }}
@endsection

@section('content')
    <div class="">
        <div class="mb-3">
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-12">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary text-center"> {{ __('sentence.New report') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.New report') }}</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('report.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-row">
                        <div class="form-group col-md-6">
                                @if (Auth::user()->role_id != 2)
                                    <div class="form-group">
                                        <label for="doctor_name">{{ __('sentence.Praticien') }} </label>
                                        <select class="form-control multiselect-search" name="doctor_id" id="DoctorID" required>
                                            <option value="" disabled selected>{{ __('sentence.Select Praticien') }}...
                                            </option>
                                            @foreach ($praticiens as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                <div class="form-group">
                                    <label for="doctor_name">{{ __('sentence.Praticien') }} </label>
                                    <select class="form-control multiselect-search" name="doctor_id_disabled" id="DoctorID" disabled>
                                        @foreach ($praticiens as $user)
                                            <option value="{{ $user->id }}" {{ Auth::user()->id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <!-- Champ caché pour envoyer l'ID du praticien actuellement connecté  {{ Auth::user()->id == $user->id ? 'selected' : '' }}-->
                                    <input type="hidden" name="doctor_id" class="doctor-id" value="{{ Auth::user()->id }}">
                                </div>

                                @endif
                           </div>
                           <div class="form-group col-md-6">
                            <label>Soin_effectué(s)</label>
                                <div id="drug-container">
                                   <div class="drug-group">
                                        <select name="drug_id[]" class="form-control drug-select">
                                            <option value="" disabled selected>{{ __('sentence.Select Drug') }}...
                                            </option>
                                         @foreach ($drugs as $drug)
                                            <option value="{{ $drug->id }}" data-amount="{{ $drug->amountDrug }}">{{ $drug->trade_name }}</option>
                                         @endforeach
                                       </select>
                                       <input type="number" name="amountDrug[]" class="form-control amount-input" placeholder="Montant du soin" readonly>
                                       <button type="button" class="btn btn-sm btn-danger remove-drug">X</button>
                                  </div>
                               </div>
                                 <button type="button" class="btn btn-sm btn-primary mt-2" id="add-drug">+</button>
                          </div>

                            
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="patient_name">{{ __('sentence.Patient have') }}</label>
                                
                                <select class="form-control patient_name multiselect-doctorino"  name="patient" id="patient_name">
                                    @if (@empty($patients))
                                        <option>{{ __('sentence.Select Patient') }}</option>
                                    @else
                                        @foreach ($patients as $patient)
                                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                {{ csrf_field() }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="next_rdv">{{ __('sentence.Next_rdv') }}<font color="red">*</font>
                                </label>
                                <input type="date" class="form-control" id="Next_rdv" name="next_rdv"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-6">
                           <label for="observation">Observation</label>
                           <textarea name="observation" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="pourboire">Pourboire</label>
                            <input type="number" step="0.01" name="pourboire" class="form-control">
                                
                            </div>   
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success">{{ __('sentence.Save') }}</button>
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

@section('footer')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-multiselect.css') }}">

    <script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}"></script>

    <!-- Initialize the plugin: -->
    <script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('add-drug').addEventListener('click', function() {
        let container = document.getElementById('drug-container');
        let newGroup = container.firstElementChild.cloneNode(true);
        container.appendChild(newGroup);
        newGroup.querySelector('.drug-select').selectedIndex = 0; 
        newGroup.querySelector('.amount-input').value = ''; 

    });

    document.addEventListener('change', function(event) {
        if (event.target.classList.contains('drug-select')) {
            let amountInput = event.target.closest('.drug-group').querySelector('.amount-input');
            amountInput.value = event.target.options[event.target.selectedIndex].dataset.amount;
        }
    });

    document.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-drug')) {
        let container = document.getElementById('drug-container');
        if (container.children.length > 1) {
            event.target.closest('.drug-group').remove();
        } else {
            alert("Vous devez avoir au moins un médicament sélectionné.");
        }
    }
});
});
</script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fileUpload = document.getElementById("file-upload");
            const imagePreview = document.getElementById("image-preview");
            const defaultImage = "default-image.jpeg";

            fileUpload.addEventListener("change", function() {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = "block";
                }

                if (fileUpload.files[0]) {
                    reader.readAsDataURL(fileUpload.files[0]);
                } else {
                    imagePreview.src = defaultImage;
                    imagePreview.style.display = "block";
                }
            });

            imagePreview.addEventListener("click", function() {
                fileUpload.click();
            });
        });
    </script>

@endsection
