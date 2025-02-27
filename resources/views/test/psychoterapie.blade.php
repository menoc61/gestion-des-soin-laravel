@extends('layouts.master')
@section('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-multiselect.css') }}">
@endsection

@section('title')
    {{ __('sentence.Add Test') }}
@endsection

@section('content')


    <div class="">
        <div class="mb-3">
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-10">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary text-center"> {{ __('sentence.Option Psycho') }} De {{$userName}}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Add Psycho') }}</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('test.store_id', ['id' => $userId]) }}">
                        <div class="form-group row">
                            {{-- <label for="inputEmail3" class="col-sm-3 col-form-label">{{ __('sentence.Patient Name') }}<font
                                    color="red">*</font></label> --}}
                            <div class="col-sm-9 input-group">
                                <input type="hidden" class="form-control" value="{{ $userId }}" name="patient_id"
                                    readonly>
                                {{-- <input type="text" class="form-control" value="{{ $userName }}" readonly> --}}
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">{{ __('sentence.Psycho Name') }}<font
                                    color="red">*</font></label>
                            <div class="col-sm-9 input-group">
                                <input type="text" class="form-control" id="inputPassword2"
                                    value="Psychothérapie de {{ $userName }}" name="test_name" readonly>
                                {{ csrf_field() }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3"
                                class="col-sm-3 col-form-label">{{ __('sentence.Observation') }}</label>
                            <div class="col-sm-9">
                                <textarea id="comment" name="comment">

                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="inputSection"
                                class="col-sm-3 col-form-label">{{ __('sentence.Form Type') }}</label> --}}
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" id="inputSection" value="PSYCHOTHERAPIE"
                                    name="diagnostic_type[]" readonly>
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


@section('footer')
    <script src="{{ asset('dashboard/js/demo/tinymce.min.js') }}" type="text/javascript"></script>
    <script>
        tinymce.init({
            selector: '#comment',
            entities: '160,nbsp,60,lt,62,gt',
            language: 'fr_FR',
            plugins: 'paste', // Plugin "paste" pour gérer le collage de texte
            paste_as_text: true, // Coller le texte brut sans balises HTML
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
    <script type="text/javascript" defer>
        var defaultInputValue = document.getElementById('inputPassword2').defaultValue;
        var selectedOption = defaultInputValue;
        var selectedValues = [];

        document.getElementById('inputSection').addEventListener('change', function() {
            var newSelectedOption = this.value;
            var descriptionInput = document.getElementById('inputPassword2');

            // Mettre à jour la valeur du selectedOption en fonction de la sélection de l'utilisateur
            selectedOption = defaultInputValue + ' ' + newSelectedOption;

            // Mettre à jour la valeur de l'input
            descriptionInput.value = selectedOption;
        });
    </script>
    <script>
  // Nettoyer le texte avant l'envoi du formulaire
        const form = document.querySelector('form'); // Remplacez par l'ID ou la classe de votre formulaire
        const textarea = document.querySelector('#comment');

        form.addEventListener('submit', function (e) {
                textarea.value = textarea.value.replace(/<\/?[^>]+(>|$)/g, ""); // Supprime les balises HTML
         });
   </script>
@endsection
