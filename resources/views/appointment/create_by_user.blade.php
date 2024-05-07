@extends('layouts.master')

@section('title')
    {{ __('sentence.New Appointment') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        {{-- <div class="card col-md-12 bground ">
            <div class="slide-container swiper mySwiper ">
                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">
                        <div class="card carte swiper-slide">
                            <div class="image-content">
                                <span class="overlay"></span>
                                <div class="card-image">
                                </div>
                            </div>
                            <div class="card-content">
                                <h2 class="name">nom</h2>
                                <p class="description">fonction</p>
                                <button class="button">View praticien</button>
                            </div>
                        </div>
                        <div class="card carte swiper-slide">
                            <div class="image-content">
                                <span class="overlay"></span>
                                <div class="card-image">
                                </div>
                            </div>
                            <div class="card-content">
                                <h2 class="name">nom</h2>
                                <p class="description">fonction</p>
                                <button class="button">View praticien</button>
                            </div>
                        </div>
                        <div class="card carte swiper-slide">
                            <div class="image-content">
                                <span class="overlay"></span>
                                <div class="card-image">
                                </div>
                            </div>
                            <div class="card-content">
                                <h2 class="name">nom</h2>
                                <p class="description">fonction</p>
                                <button class="button">View praticien</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
                            <div class="swiper-slide carte ">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                        </div>
                    </div>
                    <div class="card-content">
                        <h2 class="name">nom</h2>
                        <p class="description">fonction</p>
                        <button class="button">View praticien</button>
                    </div>
                </div>
                <div class="swiper-slide carte ">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                        </div>
                    </div>
                    <div class="card-content">
                        <h2 class="name">nom</h2>
                        <p class="description">fonction</p>
                        <button class="button">View praticien</button>
                    </div>
                </div>
                <div class="swiper-slide carte ">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                        </div>
                    </div>
                    <div class="card-content">
                        <h2 class="name">nom</h2>
                        <p class="description">fonction</p>
                        <button class="button">View praticien</button>
                    </div>
                </div>
                <div class="swiper-slide carte ">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                        </div>
                    </div>
                    <div class="card-content">
                        <h2 class="name">nom</h2>
                        <p class="description">fonction</p>
                        <button class="button">View praticien</button>
                    </div>
                </div>
        </div> --}}

        <div class="swiper mySwiper">
            <div class="swiper-wrapper w-25">
                @forelse ($praticiens as $praticien)
                    <div class="swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>
                            <div class="card-image"> <img class="card-img" src="{{ asset('img/patient-icon.png') }}"
                                    alt="profil-img">
                            </div>
                        </div>
                        <div class="card-content">
                            <h2 class="name">{{ $praticien->name }}</h2>
                            <p class="description">{{ $praticien->email }}</p>
                            <div>
                                <button class="btn btn-outline-success">
                                    <a href="" class="btn btn-outline-success btn-circle btn-sm"><i
                                            class="far fa-calendar-plus"></i></a>
                                    Agenda</button>
                                <button class="btn btn-outline-primary">
                                    <a href="" class="btn btn-outline-primary btn-circle btn-sm"> <i
                                            class="fas fa-check"></i></a>
                                    Choisir</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="5" class="text-center"><img src="{{ asset('img/not-found.svg') }}" width="200" />
                            <br><br>
                            <b class="text-muted">pas de praticien trouvé</b>
                        </td>
                    </tr>
                @endforelse
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="col-md-12 my-4">
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
                                    <input type="hidden" class="form-control" value="{{ $userId }}" id="patient_name"
                                        readonly>
                                    <input type="text" class="form-control" value="{{ $userName }}" readonly>
                                    {{ csrf_field() }}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="praticien_name">{{ __('sentence.Patient') }}</label>
                                    <input type="hidden" class="form-control" value="{{ $userId }}"
                                        id="praticien_name" readonly>
                                    <input type="text" class="form-control" value="{{ $userName }}" readonly>
                                    {{ csrf_field() }}
                                </div>
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
                    <p><b>{{ __('sentence.Patient') }} :</b> <span id="create_by"></span></p>
                    <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient"></span></p>
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
                    <form id="rdv-form" action="{{ route('appointment.store', ['id' => $userId]) }}" method="POST"
                        class="d-none">
                        <input type="hidden" name="create_by" id="praticien_input">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!--swipper js -->
    <link href="{{ asset('dashboard/css/swiper-bundle.min.css') }}" rel="stylesheet" media="all">
@endsection

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
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
                depth: 100,
                modifier: 2.5,
                scale: 1,
                slideShadows: true,
            },
            slidesPerView: 'auto',
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
@endsection
