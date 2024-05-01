@extends('layouts.master')

@section('title')
    {{ __('sentence.follow') }}
@endsection

@section('content')
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <div class="row justify-content-center">
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
            <div class="card shadow mb-4" id="create_appointment_block">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.set meetings') }}</h6>
                    <small id="emailHelp" class="form-text text-muted">Ce Traitement comporte
                        : {{ $prescription->dosage }} Séance(s) de Travail </small>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            @if (Auth::user()->role_id != 2)
                                <div class="form-group">
                                    <label for="doctor_name">{{ __('sentence.Doctors') }} </label>
                                    <select class="form-control " name="Doctor_id" id="DoctorID" required>
                                        <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                        @foreach ($praticiens as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                                @php
                                    $doctorId = $prescription->doctor_id;
                                    $reason = 'Ref[' . $prescription->id . '-d' . $prescription->dosage . '] ID:' . $prescription->reference . '_' . $prescription->nom;
                                @endphp

                            <div class="form-group">
                                <label for="patient_name">{{ __('sentence.Patient') }} </label>
                                <select class="form-control patient_name multiselect-doctorino" id="patient_name">

                                    <option value="{{ $prescription->user_id }}" selected>
                                        {{ $prescription->User->name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rdvdate">{{ __('sentence.Date') }}</label>
                                <input type="text" class="form-control target" readonly="readonly" id="rdvdate">
                                <small id="emailHelp" class="form-text text-muted">Sélectionnez une date et une heure
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="reason">{{ __('sentence.Reason for visit') }}</label>
                                <textarea class="form-control" id="reason" readonly
                                    style="font-family: Arial, sans-serif; font-size: 14px; line-height: 1.5; padding: 10px;">

                                </textarea>


                                <small id="emailHelp" class="form-text text-info tooltip-hover" data-toggle="tooltip"
                                    style="cursor: pointer;"
                                    title="Signification des éléments:
                                    {{ $prescription->doctor_id }}Ref : Identifiant du praticien ayant fait la prescription
                                    {{ $prescription->id }} : Identifiant de la prescription
                                    d{{ $prescription->dosage }} : Dosage de la prescription
                                    {{ $prescription->reference }} : Référence de la prescription
                                    {{ $prescription->nom }} : Nom associé à la prescription">
                                    <i class="fa fa-info-circle"></i> le motif est ajouté automatiquement!
                                </small>

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
            <div class="card shadow mb-4" id="list_appointment_block">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.All Appointments') }}</h6>
                    <small id="emailHelp" class="form-text text-muted">Ce Traitement comporte déja : <b><span
                                id="appointmentCount" style="color: red"></span>/{{ $prescription->dosage }}</b> Séance(s)
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
                                <td align="center">{{ __('sentence.Actions') }}</td>
                            </thead>
                            @forelse($currentUserAppointments as $appointment)
                                <tbody>
                                    <td align="center">{{ $appointment->id }} </td>
                                    <td align="center"><label class="badge badge-primary-soft"><i
                                                class="fas fa-calendar"></i>
                                            {{ $appointment->date->format('d M Y') }} </label></td>
                                    <td align="center"><label class="badge badge-primary-soft"><i class="fa fa-clock"></i>
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
                                    <td align="center">
                                        @can('edit appointment')
                                            @php
                                                $appointmentDate = \Carbon\Carbon::parse($appointment->date);
                                                $appointmentTimeStart = \Carbon\Carbon::parse($appointment->time_start);
                                                $currentDateTime = now();
                                                $isFutureDateTime =
                                                    $appointmentDate->isFuture() ||
                                                    ($appointmentDate->isToday() && $appointmentTimeStart->isFuture());
                                            @endphp

                                            <a data-rdv_id="{{ $appointment->id }}"
                                                data-rdv_date="{{ $appointment->date->format('d M Y') }}"
                                                data-rdv_time_start="{{ $appointment->time_start }}"
                                                data-rdv_time_end="{{ $appointment->time_end }}"
                                                data-patient_name="{{ $appointment->User->name }}"
                                                class="btn btn-outline-success btn-circle btn-sm{{ $isFutureDateTime || $appointment->visited != 1 ? ' disabled opacity-button' : '' }}"
                                                data-toggle="modal" data-target="#EDITRDVModal">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        @endcan
                                        @can('delete appointment')
                                            @if ($appointment->visited != 1)
                                                <a href="{{ url('appointment/delete/' . $appointment->id) }}"
                                                    class="btn btn-outline-danger btn-circle btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            @endif
                                        @endcan
                                    </td>
                                </tbody>
                            @empty
                                <tr>
                                    <td colspan="5" align="center">
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
                    <form id="rdv-form" action="{{ route('appointment.store_id', ['id' => $prescription->id]) }}"
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
@endsection
@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard/vendor/chart.js/Chart.bundle.js"></script>
    <script src="{{ asset('assets/demo/chart-doughnut-demo.js') }}"></script>
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
@endsection
