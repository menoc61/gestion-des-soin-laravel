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
                    <h2 class="m-0 font-weight-bold text-primary text-center"> {{ __('sentence.Take Appointment') }} Pour
                        {{ $userName }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 my-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.New Appointment') }}</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('appointment.store') }}" enctype="multipart/form-data">
                        <div class="row ">
                            <div class="form-group col-md-6">
                                <label for="patient_name">{{ __('sentence.Patient') }}</label>
                                <select class="form-control patient_name multiselect-doctorino" name="patient"
                                    id="patient_name">
                                    <option value="{{ $patientId }}" selected>
                                        {{ $userName }}
                                    </option>
                                </select>
                                {{ csrf_field() }}
                            </div>

                            <div class="form-group col-md-6">
                                <label for="praticien_id">{{ __('sentence.Doctor') }}</label>
                                <input type="hidden" class="form-control" name="doctor_id" value="{{ $docId }}"
                                    id="praticien_id" readonly>
                                <input type="text" class="form-control" value="{{ $praticienName }}" readonly
                                    id="praticien_name_input">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="rdvdate">{{ __('sentence.Date') }}</label>
                                <input type="text" class="form-control target agenda" name="rdv_time_date"
                                    readonly="readonly" id="rdvdate">
                                <small id="emailHelp" class="form-text text-muted">Select date to view time slots
                                    available</small>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="rdv_time_start">{{ __('sentence.Hour_start') }}</label>
                                <input type="time" class="form-control target" name="rdv_time_start">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="rdv_time_end">{{ __('sentence.Hour_end') }}</label>
                                <input type="time" class="form-control target" name="rdv_time_end">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="reason">{{ __('sentence.Reason for visit') }}</label>
                                <textarea class="form-control" id="reason" name="reason"></textarea>
                                <small id="emailHelp" class="form-text text-muted">Entre une drescription</small>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="send_sms" id="sms">
                                <label class="form-check-label" for="sms">
                                    {{ __('sentence.Send SMS') }}
                                </label>
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
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Agenda praticien') }} {{ $praticienName }}</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td align="center">{{ __('sentence.Date') }}</td>
                            <td align="center">{{ __('sentence.Time Slot') }}</td>
                            <td align="center">{{ __('sentence.Created at') }}</td>
                        </tr>
                        @forelse($appointmentsDoc as $appointment)
                            <tr>
                                <td align="center">
                                    <label class="badge badge-primary-soft">
                                        <i class="fas fa-calendar"></i>
                                        {{ $appointment->date->format('d M Y') }}
                                    </label>
                                </td>
                                <td align="center">
                                    <label class="badge badge-primary-soft">
                                        <i class="fa fa-clock"></i>
                                        {{ $appointment->time_start }} - {{ $appointment->time_end }}
                                    </label>
                                </td>
                                <td class="text-center">
                                    {{ $appointment->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" align="center">
                                    <img src="{{ asset('img/not-found.svg') }}" width="200" />
                                    <br><br>
                                    <b class="text-muted">{{ __('sentence.No appointment available') }}</b>
                                </td>
                            </tr>
                        @endforelse
                    </table>
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
@endsection
