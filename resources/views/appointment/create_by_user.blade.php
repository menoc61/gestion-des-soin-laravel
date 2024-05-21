@extends('layouts.master')

@section('title')
    {{ __('sentence.New Appointment') }}
@endsection

@section('content')
    <div class="">
        <div class="mb-3">
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-10">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary text-center"> {{ __('sentence.Take Appointment') }} Pour {{ $userName }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        @if (Auth::user()->role_id != 2)
            <div class="col-md-10 my-4">
                <div class="card shadow custom-card-parent d-flex justify-content-center align-items-center">
                    <div class="card w-75 shadow d-flex justify-content-center align-items-center">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper w-25">
                                @forelse ($praticiens as $praticien)
                                    <div class="swiper-slide">
                                        <div class="image-content">
                                            <span class="overlay"></span>
                                            <div class="card-image">
                                                <img class="card-img" src="{{ asset('img/patient-icon.png') }}"
                                                    alt="profil-img">
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <h2 class="name">{{ $praticien->name }}</h2>
                                            <p class="description">{{ $praticien->email }}</p>
                                            <div class="d-flex justify-content-center">
                                                <input
                                                    onclick="selectPraticien({{ $praticien->id }}, '{{ $praticien->name }}')"
                                                    type="button" class="form-control target " readonly="readonly"
                                                    id="rdvdate_{{ $praticien->id }}" value="choisir"
                                                    data-id="{{ $praticien->id }}">
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center">
                                        <img src="{{ asset('img/not-found.svg') }}" width="200" />
                                        <br><br>
                                        <b class="text-muted">pas de praticien trouvé</b>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="col-md-10 my-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.New Appointment') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="patient_name">{{ __('sentence.Patient') }}</label>
                                        <select class="form-control patient_name multiselect-doctorino" id="patient_name">
                                            <option value="{{ $userId }}" selected>
                                                {{ $userName }}
                                            </option>
                                        </select>
                                        {{ csrf_field() }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="praticien_id">{{ __('sentence.Doctor') }}</label>
                                    <input type="hidden" class="form-control" value="{{ $praticien->id }}"
                                        id="praticien_id" readonly>
                                    <input type="text" class="form-control" value="{{ $praticien->name }}" readonly
                                        id="praticien_name_input">
                                </div>

                                <div class="form-group">
                                    <label for="rdvdate">{{ __('sentence.Date') }}</label>
                                    <input type="text" class="form-control target" readonly="readonly" id="rdvdate">
                                    <small id="emailHelp" class="form-text text-muted">Select date to view time slots
                                        available</small>
                                </div>

                                <div class="form-group">
                                    <label for="reason">{{ __('sentence.Reason for visit') }}</label>
                                    <textarea class="form-control" id="reason"></textarea>
                                    <small id="emailHelp" class="form-text text-muted">Entre une drescription</small>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="sms">
                                    <label class="form-check-label" for="sms">
                                        {{ __('sentence.Send SMS') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <label for="date">{{ __('sentence.Available Times') }}</label>
                                <hr>
                                <div class="row mb-2 myorders"></div>
                                <div class="alert alert-danger text-center" role="alert" id="help-block">
                                    <img src="{{ asset('img/calendar.png') }}"><br>
                                    <b>{{ __('sentence.No date selected') }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-10 my-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.New Appointment') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="patient_name">{{ __('sentence.Patient') }}</label>
                                        <select class="form-control patient_name multiselect-doctorino" id="patient_name">
                                            <option value="{{ $userId }}" selected>
                                                {{ $userName }}
                                            </option>
                                        </select>
                                        {{ csrf_field() }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="praticien_name">{{ __('sentence.Doctor') }}</label>
                                    <input type="hidden" class="form-control" value="{{ Auth::user()->id }}"
                                        id="praticien_name" readonly>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly
                                        id="praticien_name_input">
                                </div>

                                <div class="form-group">
                                    <label for="rdvdate">{{ __('sentence.Date') }}</label>
                                    <input type="text" class="form-control target" readonly="readonly"
                                        id="rdvdate">
                                    <small id="emailHelp" class="form-text text-muted">Select date to view time slots
                                        available</small>
                                </div>

                                <div class="form-group">
                                    <label for="reason">{{ __('sentence.Reason for visit') }}</label>
                                    <textarea class="form-control" id="reason"></textarea>
                                    <small id="emailHelp" class="form-text text-muted">Entre une drescription</small>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="sms">
                                    <label class="form-check-label" for="sms">
                                        {{ __('sentence.Send SMS') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <label for="date">{{ __('sentence.Available Times') }}</label>
                                <hr>
                                <div class="row mb-2 myorders"></div>
                                <div class="alert alert-danger text-center" role="alert" id="help-block">
                                    <img src="{{ asset('img/calendar.png') }}"><br>
                                    <b>{{ __('sentence.No date selected') }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- Appointment Modal-->
    <div class="modal fade" id="RDVModalSubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('sentence.Are you sure of the date') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient_name"></span></p>
                    <p><b>{{ __('sentence.Date') }} :</b> <label class="badge badge-primary-soft" id="rdv_date"></label>
                    </p>
                    <p><b>{{ __('sentence.Time Slot') }} :</b> <label class="badge badge-primary-soft"
                            id="rdv_time"></span></label></p>
                    <p><b>{{ __('sentence.Reason for visit') }} :</b> <label class="badge badge-primary-soft"
                            id="reason_for_visit"></span></label></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button"
                        data-dismiss="modal">{{ __('sentence.Cancel') }}</button>
                    <a class="btn btn-primary text-white"
                        onclick="event.preventDefault();
                        document.getElementById('rdv-form').submit();">{{ __('sentence.Save') }}</a>
                    <form id="rdv-form" action="{{ route('appointment.store') }}" method="POST" class="d-none">
                        <input type="hidden" name="patient" id="patient_input">
                        <input type="hidden" name="rdv_time_date" id="rdv_date_input">
                        <input type="hidden" name="rdv_time_start" id="rdv_time_start_input">
                        <input type="hidden" name="rdv_time_end" id="rdv_time_end_input">
                        <input type="hidden" name="send_sms" id="send_sms">
                        <input type="hidden" name="reason" id="reason_for_visit_input">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!--swipper js -->
    <link href="{{ asset('dashboard/css/swiper-bundle.min.css') }}" rel="stylesheet" media="all">
@endsection

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $(".agenda")
                .datepicker({
                    uiLibrary: "bootstrap4",
                    format: "yyyy-mm-dd",
                    todayHighlight: true,
                    minDate: function() {
                        var date = new Date();
                        date.setDate(date.getDate());
                        return new Date(
                            date.getFullYear(),
                            date.getMonth(),
                            date.getDate()
                        );
                    }
                })
                .on("changeDate", function(e) {
                    var selectedInputId = $(this).attr("id");

                    $(".agenda")
                        .not("#" + selectedInputId)
                        .val(""); // Réinitialiser les autres champs d'entrée
                });

            $('.multiselect-doctorino').select2();
        });
    </script>
    <script src="{{ asset('dashboard/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/demo/swipper.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            centeredSlides: true,
            spaceBetween: 30,
            loop: true,
            shadowOffset: 200, // Ajustez la valeur de l'ombre selon vos besoins
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
    <script>
        function selectPraticien(praticienId, praticienName) {
            var reasonTextarea = document.getElementById('reason');
            var reasonText = reasonTextarea.value;

            // Rechercher l'ID précédent et le supprimer du texte
            var regex = new RegExp('\\b\\d+\\b', 'g');
            reasonText = reasonText.replace(regex, '');

            // Retirer les espaces en trop du texte
            reasonText = reasonText.trim();

            // Ajouter l'ID du praticien sélectionné au texte
            if (reasonText.length > 0) {
                reasonText += ' ';
            }
            reasonText += praticienId;

            // Mettre à jour les champs et le texte
            document.getElementById('praticien_id').value = praticienId;
            document.getElementById('praticien_name_input').value = praticienName;
            reasonTextarea.value = reasonText;
        }
    </script>
@endsection
