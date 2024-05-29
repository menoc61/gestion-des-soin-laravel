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

    <form method="post" action="{{ route('appointment.store') }}" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col-md-6 my-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.New Appointment') }}</h6>
                    </div>
                    <div class="card-body">

                        <div class="row ">
                            <div class="form-group col-md-6">
                                <label for="patient_name">{{ __('sentence.Patient') }}</label>
                                <select class="form-control patient_name multiselect-doctorino" name="patient"
                                    id="patient_name">
                                    <option value="{{ $userId }}" selected>
                                        {{ $userName }}
                                    </option>
                                </select>
                                {{ csrf_field() }}
                            </div>

                            <div class="form-group col-md-6">
                                @if (Auth::user()->role_id != 2)
                                    <div class="form-group">
                                        <label for="doctor_name">{{ __('sentence.Praticien') }} </label>
                                        <select class="form-control " name="doctor_id" id="DoctorID" required>
                                            {{-- <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option> --}}
                                            @foreach ($praticiens as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
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

                    </div>
                </div>
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Agenda praticien') }}
                            {{ $user->name }}</h6>
                    </div>
                    {{-- <div class="card-body">
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
                </div> --}}
                </div>
            </div>
            <div class="col-md-6 my-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Drugs list') }}</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="drugs_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary add text-white" align="center"><i
                                        class='fa fa-plus'></i> {{ __('sentence.Add Drug') }}</a>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </form>
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

    <script type="text/template" id="drugs_labels">
        <section class="field-group">
            <div class="row">
                <div class="col-md-4">
                    <label for="morphology_patient">{{ __('sentence.Drugs') }}<font color="red">*</font></label>
                    <select class="form-control multiselect-drug" name="trade_name[]" id="drug" required>
                        <option value="" disabled selected>{{ __('sentence.Select Drug') }}...</option>
                        @foreach($drugs as $drug)
                            <option value="{{ $drug->id }}">{{ $drug->trade_name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="morphology_patient">{{ __('sentence.Description') }}<font color="red">*</font></label>
                    <div class="form-group-custom">
                        <textarea type="text" name="drug_advice[]" class="form-control" placeholder="{{ __('sentence.Advice_Comment') }}"></textarea>
                    </div>
                </div>
                <div class="col-md-2">
                    <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"><i class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
                </div>
                <div class="col-12">
                    <hr color="#a1f1d4">
                </div>
            </div>
        </section>
    </script>

    <script>
        $(document).ready(function() {
            // Function to add a new drug field
            $('.add').click(function() {
                var template = $('#drugs_labels').html();
                $('.rep').append(template);
                updateDrugOptions();
            });

            // Function to remove a drug field
            $(document).on('click', '.delete', function() {
                $(this).closest('.field-group').remove();
                updateDrugOptions();
            });

            // Function to update drug options
            function updateDrugOptions() {
                var selectedDrugs = [];
                $('.multiselect-drug').each(function() {
                    selectedDrugs.push($(this).val());
                });

                $('.multiselect-drug').each(function() {
                    var currentSelect = $(this);
                    currentSelect.find('option').each(function() {
                        if (selectedDrugs.includes($(this).val()) && $(this).val() !== currentSelect
                            .val()) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        }
                    });
                });
            }

            // Update options when a drug is selected
            $(document).on('change', '.multiselect-drug', function() {
                updateDrugOptions();
            });
        });
    </script>

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
