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
                    <h2 class="text-center">{{ __('sentence.Choice Praticien') }} Pour
                        <span class="m-0 font-weight-bold text-primary text-center">{{ $userName }}</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 my-4 droite card">
            <form class="d-none d-sm-inline-block form-inline my-2 navbar-search w-100">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Rechercher Une Spécialité..." aria-label="Search" aria-describedby="basic-addon2"
                        name="term">
                    @csrf
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
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
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a href="{{ route('prescription.doctorrdv', ['id' => $prescription, 'user_id' => $userId,  'doc_id' => $praticien->id]) }}"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                                        {{ __('sentence.Choice') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center">
                                        <img src="{{ asset('img/not-found.svg') }}" width="200" />
                                        <br><br>
                                        <b class="text-muted">pas de praticien trouvé</b>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        @endif
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
        $(document).ready(function() {
            $(".agenda").datepicker({
                uiLibrary: "bootstrap4",
                format: "yyyy-mm-dd",
                todayHighlight: true,
                minDate: function() {
                    var date = new Date();
                    date.setDate(date.getDate());
                    return new Date(date.getFullYear(), date.getMonth(), date.getDate());
                }
            }).on("changeDate", function(e) {
                var selectedInputId = $(this).attr("id");
                $(".agenda").not("#" + selectedInputId).val(""); // Réinitialiser les autres champs d'entrée
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
            shadowOffset: 200,
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
@endsection
