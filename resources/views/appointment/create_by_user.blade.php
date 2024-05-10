@extends('layouts.master')

@section('title')
    {{ __('sentence.New Appointment') }}
@endsection

@section('content')
    <div class="row justify-content-center">

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
                                            <input onclick="selectPraticien({{ $praticien->id }}, '{{ $praticien->name }}')" type="button" class="form-control agenda w-50"
                                                readonly="readonly" id="agenda_{{ $praticien->id }}" value="choisir" readonly="readonly">
                                            {{-- <button class="btn btn-outline-primary"
                                                onclick="selectPraticien({{ $praticien->id }}, '{{ $praticien->name }}')">
                                                <i class="fas fa-check"></i>
                                                Choisir
                                            </button> --}}
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
                                    <input type="hidden" class="form-control" value="{{ $userId }}"
                                        id="patient_name" readonly>
                                    <input type="text" class="form-control" value="{{ $userName }}"
                                        id="patient_name" readonly>
                                    {{ csrf_field() }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="praticien_name">{{ __('sentence.Doctor') }}</label>
                                <input type="hidden" class="form-control" value="{{ $praticien->id }}" id="praticien_name"
                                    readonly>
                                <input type="text" class="form-control" value="{{ $praticien->name }}" readonly
                                    id="praticien_name_input">
                            </div>

                            <div class="form-group">
                                <label for="rdvdate">{{ __('sentence.Date') }}</label>
                                <input type="text" class="form-control target agenda-input" readonly="readonly"
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
                    <p><b>{{ __('sentence.Doctor') }} :</b> <span id="praticien_name_input"></span></p>
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
                        <input type="hidden" name="create_by" id="praticien_name_input_form">
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
            $(".agenda").datepicker({
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
                },
            }).on("changeDate", function(e) {
                var selectedInputId = $(this).attr("id");

                $(".agenda").not("#" + selectedInputId).val(
                    ""); // Réinitialiser les autres champs d'entrée

            });


            $('.multiselect-doctorino').select2();
        });
    </script>
    <script src="{{ asset('dashboard/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/demo/swipper.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: 'coverflow',
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 110,
                modifier: 2.5,
                scale: 1,
                slideShadows: true,
            },
            slidesPerView: 3,
            centeredSlides: true,
            loop: true,
            shadowOffset: 200, // Ajustez la valeur de l'ombre selon vos besoins
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true,
            // },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
    <script>
        function selectPraticien(praticienId, praticienName) {
            document.getElementById('praticien_name').value = praticienId;
            document.getElementById('praticien_name_input').value = praticienName;
            document.getElementById('praticien_name_input_form').value = praticienId;
        }
    </script>
    {{-- <script>
        // Initialiser le Datepicker
        $(document).ready(function() {
            $('#rdvdate').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });
        });

        // Action lorsque le bouton "Agenda" est cliqué
        $('#agendaBtn').click(function() {
            // Ouvrir le Datepicker
            $('#rdvdate').datepicker('show');
        });

        // Mettre à jour le champ "rdvdate" lorsque la date est sélectionnée
        $('#rdvdate').on('changeDate', function(e) {
            $('#rdvdate').val(e.format());
        });
    </script> --}}
@endsection
