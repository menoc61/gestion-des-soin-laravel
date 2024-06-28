@extends('layouts.master')

@section('title')
    {{ __('sentence.follow') }}
@endsection

@section('content')
    <div class="">
        <div class="mb-3">
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-12">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary text-center"> {{ __('sentence.follow') }} De
                        {{ $prescription->User->name }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <form method="post" id="myForm" class="col-md-12 d-flex" action="{{ route('appointment.store') }}"
            enctype="multipart/form-data">
            <div class="col-md-12 d-flex">
                <div class="col-md-5">
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
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Agenda praticien') }} <span
                                    id="doctor-name"></span></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="appointments-table">

                                    <tr>
                                        <td align="center">{{ __('sentence.Date') }}</td>
                                        <td align="center">{{ __('sentence.Time Slot') }}</td>
                                    </tr>
                                    <!-- Appointments will be dynamically inserted here -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card shadow mb-4" id="create_appointment_block">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.set meetings') }}</h6>
                            <small id="emailHelp" class="form-text text-muted">Ce Traitement comporte
                                : {{ $prescription->dosage }} Séance(s) de Travail </small>
                        </div>
                        <div class="card-body">

                            <div class="row ">
                                <div class="form-group col-md-4">
                                    <label for="patient_name">{{ __('sentence.Patient') }}</label>
                                    <select class="form-control patient_name multiselect-doctorino" name="patient"
                                        id="patient_name">
                                        <option value="{{ $prescription->user_id }}" selected>
                                            {{ $prescription->User->name }}
                                        </option>
                                    </select>
                                    {{ csrf_field() }}
                                </div>

                                <div class="form-group col-md-4">
                                    @if (Auth::user()->role_id != 2)
                                        <div class="form-group">
                                            <label for="doctor_name">{{ __('sentence.Praticien') }} </label>
                                            <select class="form-control " name="doctor_id" id="DoctorID" required>
                                                <option value="" disabled selected>
                                                    {{ __('sentence.Select Praticien') }}...</option>
                                                <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                                @foreach ($praticiens as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label for="doctor_name">{{ __('sentence.Praticien') }} </label>
                                            <select class="form-control " name="doctor_id" id="DoctorID" required>
                                                <option value="" disabled selected>
                                                    {{ __('sentence.Select Praticien') }}...</option>
                                                <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                                {{-- @foreach ($praticiens as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    @endif
                                    @php
                                        $doctorId = $prescription->doctor_id;
                                        $reason =
                                            'Ref[' .
                                            $prescription->id .
                                            '-d' .
                                            $prescription->dosage .
                                            '] ID:' .
                                            $prescription->reference .
                                            '_' .
                                            $prescription->nom;
                                    @endphp
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="rdvdate">{{ __('sentence.Date') }}</label>
                                    <input type="text" class="form-control target agenda" name="rdv_time_date"
                                        readonly="readonly" id="rdvdate">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="rdv_time_start">{{ __('sentence.Hour_start') }}</label>
                                    <input type="time" class="form-control target" name="rdv_time_start">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="rdv_time_end">{{ __('sentence.Hour_end') }}</label>
                                    <input type="time" class="form-control target" name="rdv_time_end">
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-success my-5">{{ __('sentence.Save') }}</button>
                                    </div>
                                </div>
                                {{-- <div class="form-group col-md-6">
                                    <label for="reason">{{ __('sentence.Reason for visit') }}</label>
                                    <textarea class="form-control" id="reason" name="reason" readonly></textarea>
                                    <small id="emailHelp" class="form-text text-muted">Entre une drescription</small>
                                </div> --}}

                                {{-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="send_sms" id="sms">
                                <label class="form-check-label" for="sms">
                                    {{ __('sentence.Send SMS') }}
                                </label>
                            </div> --}}
                                <div class="form-group col-md-3">
                                    <input class="form-control" value="{{ $prescription->id }}" type="hidden"
                                        name="prescription_id" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Show Modal Redirect-->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                        </div>
                        <div class="modal-body">
                            <div class="success-message">
                                Votre opération a été effectuée avec succès !
                            </div>
                        </div>
                        <div class="modal-footer">

                            <a class="btn btn-primary"
                                href="{{ route('prescription.follow', ['id' => $prescription->id]) }}"> OK
                            </a>

                            <a class="btn btn-secondary"
                                href="{{ route('patient.view', ['id' => $prescription->user_id]) }}">Accueil</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-md-12 d-flex">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.follow on statistics') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-md-full text-center">
                            <canvas id="myDoughnutChart" style="min-height: 200px; min-width: 200px;"></canvas>
                            <div id="chartEmptyMessage" style="display: none;">
                                <img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br>
                                <b class="text-muted">{{ __('sentence.No appointment available') }}</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-4" id="list_appointment_block">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.All Appointments') }}</h6>
                        <small id="emailHelp" class="form-text text-muted">Ce Traitement comporte déja : <b><span
                                    id="appointmentCount" style="color: red"></span>/{{ $prescription->dosage }}</b>
                            Séance(s)
                            de Travail </small>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <td align="center">Id</td>
                                    <td align="center">{{ __('sentence.Date') }}</td>
                                    <td align="center">{{ __('sentence.Time Slot') }}</td>
                                    <td align="center">{{ __('sentence.Status') }}</td>
                                    <td align="center">{{ __('sentence.Visited At') }}</td>
                                    <td align="center">{{ __('sentence.Actions') }}</td>
                                </thead>
                                @forelse($currentUserAppointments as $appointment)
                                    <tbody>
                                        <td align="center">{{ $appointment->id }} </td>
                                        <td align="center"><label class="badge badge-primary-soft"><i
                                                    class="fas fa-calendar"></i>
                                                {{ $appointment->date->format('d M Y') }} </label></td>
                                        <td align="center"><label class="badge badge-primary-soft"><i
                                                    class="fa fa-clock"></i>
                                                {{ $appointment->time_start }} -
                                                {{ $appointment->time_end }} </label></td>
                                        <td class="text-center">
                                            @if ($appointment->visited == 0)
                                                <label class="badge badge-warning-soft">
                                                    <i class="fas fa-hourglass-start"></i>
                                                    {{ __('sentence.Not Yet Visited') }}
                                                </label>
                                            @elseif($appointment->visited == 1)
                                                <label class="badge badge-success-soft">
                                                    <i class="fas fa-check"></i> {{ __('sentence.Visited') }}
                                                </label>
                                            @else
                                                <label class="badge badge-danger-soft">
                                                    <i class="fas fa-user-times"></i>
                                                    {{ __('sentence.Cancelled') }}
                                                </label>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($appointment->visited == 1)
                                                <label class="badge badge-primary-soft">
                                                    <i class="fas fa-calendar"></i>
                                                    {{ $appointment->updated_at->format('d M Y H:i') }}
                                                </label>
                                            @endif
                                        </td>
                                        <td align="center">
                                            @can('edit appointment')
                                                <a data-rdv_id="{{ $appointment->id }}"
                                                    data-rdv_date="{{ $appointment->date->format('d M Y') }}"
                                                    data-rdv_time_start="{{ $appointment->time_start }}"
                                                    data-rdv_time_end="{{ $appointment->time_end }}"
                                                    data-patient_name="{{ $appointment->User->name }}"
                                                    class="btn btn-outline-primary btn-circle btn-sm" data-toggle="modal"
                                                    data-target="#EDITRDVModal1">
                                                    <i class="fas fa-file"></i>
                                                </a>
                                            @endcan

                                            @can('edit appointment')
                                                <a data-rdv_id="{{ $appointment->id }}"
                                                    data-rdv_date="{{ $appointment->date->format('d M Y') }}"
                                                    data-rdv_time_start="{{ $appointment->time_start }}"
                                                    data-rdv_time_end="{{ $appointment->time_end }}"
                                                    data-patient_name="{{ $appointment->User->name }}"
                                                    class=" btn btn-outline-success btn-circle btn-sm
                                                    {{ $appointment->visited == 1 ? ' disabled opacity-button' : '' }}"
                                                    data-toggle="modal" data-target="#EDITRDVModal" >
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            @endcan
                                            @can('delete appointment')
                                                @if ($appointment->visited != 1)
                                                    <a href="{{ url('appointment/delete/' . $appointment->id) }}"
                                                        class="btn btn-outline-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="top"
                                                         title="Supprimer ce rendez-vous">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                @endif
                                            @endcan
                                        </td>
                                    </tbody>
                                @empty
                                    <tr>
                                        <td colspan="6" align="center">
                                            <img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br>
                                            <b class="text-muted">{{ __('sentence.No appointment available') }}</b>
                                        </td>
                                    </tr>
                                @endforelse
                            </table>
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
                    <form id="rdv-form" action="{{ route('appointment.store', ['id' => $prescription->id]) }}"
                        method="POST" class="d-none">
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

    <!--EDIT Appointment Modal-->
    <div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ __('sentence.You are about to modify an appointment') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient_name"></span></p>
                    <p><b>{{ __('sentence.Date') }} :</b> <label class="badge badge-primary-soft" id="rdv_date"></label>
                    </p>
                    <p><b>{{ __('sentence.Time Slot') }} :</b> <label class="badge badge-primary-soft"
                            id="rdv_time"></label></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button"
                        data-dismiss="modal">{{ __('sentence.Close') }}</button>
                    <a class="btn btn-primary text-white"
                        onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();">{{ __('sentence.Confirm Appointment') }}</a>
                    <form id="rdv-form-confirm" action="{{ route('appointment.store_edit') }}" method="POST"
                        class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id">
                        <input type="hidden" name="rdv_status" value="1">
                        <input type="hidden" name="is_read" value="1">
                        @csrf
                    </form>
                    <a class="btn btn-danger text-white"
                        onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();">{{ __('sentence.Cancel Appointment') }}</a>
                    <form id="rdv-form-cancel" action="{{ route('appointment.store_edit') }}" method="POST"
                        class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id2">
                        <input type="hidden" name="rdv_status" value="2">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--EDIT Rapport Appointment Modal-->
    <div class="modal fade" id="EDITRDVModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <b>Faire une Observation Pour ce Rendez-Vous</b>
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <tr>
                                <td><b>ID: </b></td>
                                <td> <label class="badge badge-primary-soft" id="hidden_rdv_id_span"></label></td>
                            </tr>
                            <tr>
                                <td><b>{{ __('sentence.Patient') }}</b></td>
                                <td> <label class="badge badge-primary-soft" id="patient_name"></label></td>
                            </tr>
                            <tr>
                                <td><b>{{ __('sentence.Date') }} : </b></td>
                                <td><label class="badge badge-primary-soft" id="rdv_date"></label></td>
                            </tr>
                            <tr>
                                <td><b>{{ __('sentence.Time Slot') }} : </b></td>
                                <td><label class="badge badge-primary-soft" id="rdv_time"></span></label></td>
                            </tr>
                        </table>
                    </div>
                    {{--
                    <p><b>{{ __('ID') }} :</b> <span id="hidden_rdv_id_span"></span></p>
                    <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient_name"></span></p>
                    <p><b>{{ __('sentence.Date') }} :</b> <span id="rdv_date"></span></p>
                    <p><b>{{ __('sentence.Time Slot') }} :</b> <span id="rdv_time"></span></p> --}}
                    <!-- New input field for Rapport -->
                    <div>
                        <form id="rdv-form-confirm1" action="{{ route('appointment.store_edit') }}" method="POST"
                            class="">
                            {{ csrf_field() }}
                            <input type="hidden" name="rdv_id" id="hidden_rdv_id">
                            <input type="hidden" name="rdv_status" value="1">
                            <input type="hidden" name="is_read" value="1">
                            <input type="hidden" name="rapport" id="hidden_rapport">
                            <div class="form-group">
                                <label for="rapport"><b>{{ __('Observation') }}</b></label>
                                <textarea class="form-control" id="rapport" name="rapport" placeholder="{{ __('Faire une Observation') }}"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button"
                        data-dismiss="modal">{{ __('sentence.Close') }}</button>
                    <a class="btn btn-success text-white"
                        onclick="event.preventDefault(); document.getElementById('rdv-form-confirm1').submit();">Créer
                        l'observation</a>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection


@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard/vendor/chart.js/Chart.bundle.js"></script>
    <script src="{{ asset('assets/demo/chart-doughnut-demo.js') }}"></script>

    <script type="text/template" id="drugs_labels">
        <section class="field-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="morphology_patient">{{ __('sentence.Drugs') }}<font color="red">*</font></label>
                    <select class="form-control multiselect-drug" name="trade_name[]" id="drug" required>
                        <option value="" disabled selected>{{ __('sentence.Select Drug') }}...</option>
                        @foreach($drugs as $drug)
                            <option value="{{ $drug->id }}" data-amountdrug="{{ $drug->amountDrug }} {{ App\Setting::get_option('currency') }}">{{ $drug->trade_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="morphology_patient">{{ __('sentence.Amount') }}</label>
                    <input type="text" name="drug_amount[]" class="form-control drug-amount" readonly>
                </div>
                <div class="col-md-2">
                    <a type="button" class="btn btn-danger btn-sm text-white span-2 delete my-5 d-flex"><i class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
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

    <script>
        $(document).ready(function() {
            // Event listener for changes in the select element
            $(document).on('change', '.multiselect-drug', function() {
                var selectedOption = $(this).find('option:selected');
                var amountdrug = selectedOption.data('amountdrug'); // Note the lower case
                $(this).closest('.row').find('.drug-amount').val(amountdrug);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.multiselect-doctorino').select2();
        });
    </script>

    <script type="text/javascript">
        // variabbles used by chart-doughnut-demo.js for the display of the doughnut
        var visitedCount = {{ $visitedCount }};
        var nonVisitedCount = {{ $nonVisitedCount }};
        var prescriptionDosage = {{ $prescription->dosage }};
        var appointmentCount = $('#list_appointment_block table tbody').length;
        var remainingAppointments = prescriptionDosage - appointmentCount;

        function checkAppointmentCount() {
            var appointmentCount = $('#list_appointment_block table tbody').length;
            $('#appointmentCount').text(appointmentCount);
            var prescriptionDosage = {{ $prescription->dosage }};
            if (appointmentCount == prescriptionDosage) {
                $('#create_appointment_block').hide();
            } else {
                $('#create_appointment_block').show();
            }
        }
        $(document).ready(function() {
            checkAppointmentCount();
        });
        $(document).ready(function() {
            // Function to update the final value
            function updateFinalValue() {
                var selectedByAdminDoctorId = $('#DoctorID').val();
                var doctorId = @json($doctor);
                var reason = @json($reason);
                var final;

                if ({{ Auth::user()->role_id }} != 2) {
                    final = selectedByAdminDoctorId + reason;
                } else {
                    final = doctorId + reason;
                }

                $('#reason').text(final);
            }
            $('#DoctorID').change(updateFinalValue);
            updateFinalValue();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myForm').on('submit', function(event) {
                event.preventDefault(); // Empêche la soumission du formulaire
                var form = this;

                $.ajax({
                    type: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function(response) {
                        $('#myModal').modal('show'); // Affiche la modal en cas de succès
                    },
                    error: function(response) {
                        // Gestion des erreurs si nécessaire
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#DoctorID').change(function() {
                var doctorId = $(this).val();
                $.ajax({
                    url: '/appointments/by-doctor/' + doctorId,
                    method: 'GET',
                    success: function(response) {
                        var appointmentsTable = $('#appointments-table');
                        appointmentsTable.find('tr:gt(0)')
                            .remove(); // Remove existing rows except header

                        if (response.length > 0) {
                            response.forEach(function(appointment) {
                                var newRow = '<tr>' +
                                    '<td align="center"><label class="badge badge-primary-soft"><i class="fas fa-calendar"></i> ' +
                                    appointment.date + '</label></td>' +
                                    '<td align="center"><label class="badge badge-primary-soft"><i class="fa fa-clock"></i> ' +
                                    appointment.time_start + ' - ' + appointment
                                    .time_end + '</label></td>'
                                '<td class="text-center">' + appointment
                                    .created_at + '</td>' +
                                    '</tr>';
                                appointmentsTable.append(newRow);
                            });
                        } else {
                            var noData =
                                '<tr><td colspan="3" align="center"><img src="{{ asset('img/not-found.svg') }}" width="200" /><br><br><b class="text-muted">{{ __('sentence.No appointment available') }}</b></td></tr>';
                            appointmentsTable.append(noData);
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Modal to edit appointment status
            $("#EDITRDVModal1").on("show.bs.modal", function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var rdv_date = button.data("rdv_date"); // Extract info from data-* attributes
                var rdv_id = button.data("rdv_id"); // Extract info from data-* attributes
                var rdv_time_start = button.data("rdv_time_start"); // Extract info from data-* attributes
                var rdv_time_end = button.data("rdv_time_end"); // Extract info from data-* attributes
                var patient_name = button.data("patient_name"); // Extract info from data-* attributes

                // Update the modal's content
                var modal = $(this);
                modal.find("#patient_name").text(patient_name);
                modal.find("#rdv_date").text(rdv_date);
                modal.find("#rdv_time").text(rdv_time_start + " - " + rdv_time_end);
                modal.find("#hidden_rdv_id_span").text(rdv_id); // Set the rdv_id in the span
                modal.find("#hidden_rdv_id").val(rdv_id); // Set the rdv_id in the input field
            });

            // Submit rapport form
            $("#submit-rapport").on("click", function() {
                var rapport = $("#rapport").val();
                var rdv_id = $("#hidden_rdv_id").val(); // Retrieve rdv_id using .val()

                // Ensure rdv_id is set
                if (!rdv_id) {
                    alert("RDV ID est manquant!");
                    return false;
                }

                $("#hidden_rapport").val(rapport);
                $("#rdv-form-confirm1").submit();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

@endsection
