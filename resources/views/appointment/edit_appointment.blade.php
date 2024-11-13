@extends('layouts.master')

@section('title')
{{ __('sentence.Edit Appointment') }}
@endsection

@section('content')
<div class="">
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

</div>

<form method="post" id="myForm" action="{{ route('appointment.store_edit_appointment') }}">
    @csrf
    <input type="hidden" name="rdv_id" value="{{ $appointment->id }}">

    <div class="row justify-content-center">
        <div class="col-md-6 my-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Change Appointment') }}</h6>
                </div>
                <div class="card-body">

                    <div class="row ">

                        <div class="form-group col-md-4">
                            <label for="doctor_name">{{ __('sentence.Praticien') }}</label>
                            <select name="doctor_id" id="DoctorID" class="form-control">
                                @foreach($praticiens as $praticien)
                                <option value="{{ $praticien->id }}" {{ $appointment->doctor_id == $praticien->id ? 'selected' : '' }}>
                                    {{ $praticien->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="patient">{{ __('sentence.Patient') }}</label>
                            <select name="patient" class="form-control multiselect-doctorino patient">
                                <option value="{{ $appointment->user_id }}">{{ $userName }}</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="rdvdate">{{ __('sentence.Date') }}</label>
                            <input type="date" class="form-control target agenda" name="rdv_time_date" id="rdvdate" value="{{ $appointment->date->format('Y-m-d') }}" readonly="readonly">
                            <small id="emailHelp" class="form-text text-muted">Select date to view time slots available</small>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="rdv_time_start">{{ __('sentence.Hour_start') }}</label>
                            <input type="time" name="rdv_time_start" class="form-control target" value="{{ $appointment->time_start }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="rdv_time_end">{{ __('sentence.Hour_end') }}</label>
                            <input type="time" name="rdv_time_end" class="form-control target" value="{{ $appointment->time_end }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="reason">{{ __('sentence.Reason for visit') }}</label>
                            <textarea name="reason" id="reason" class="form-control">{{ $appointment->reason }}</textarea>
                            <small id="emailHelp" class="form-text text-muted">Modifier la description</small>

                        </div>

                        {{-- <div class="form-group col-md-4">
                                    <label for="send_sms">{{ __('sentence.Send SMS') }}</label>
                        <input type="checkbox" name="send_sms" value="1">
                    </div> --}}

                </div>

                <!-- Ajoutez les champs pour les médicaments si nécessaire -->

                <div class="form-group row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-success">{{ __('sentence.Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 my-4">
        
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
                            <td align="center">{{ __('sentence.Created at') }}</td>
                        </tr>
                        <!-- Appointments will be dynamically inserted here -->
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--Show Modal Redirect-->
     {--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Contenu de la modal...</p>
                        </div>
                        <div class="modal-footer">
                            <div class="d-flex col-md-12">
                                <div class="col-md-4">
                                    <a class="btn btn-primary" href="{{ route('billing.create_by', ['id' => $userId]) }}">
                                                payer
                                    </a>
                                     </div>
                                    <div class="col-md-4">
                                    <a class="btn btn-secondary"
                                      href="{{ route('patient.view', ['id' => $userId]) }}">Accueil
                                   </a>
                                </div> 
                               <div class="col-md-12">
                                  <a class="btn btn-secondary"
                                        href="{{ route('patient.view', ['id' => $userId]) }}"> Acceuil
                                  </a>
                              </div>
                           </div>
                       </div>
                   </div>
                </div>
          </div> --}
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
                    <a type="button" class="btn btn-danger btn-sm text-white span-2 delete my-4"><i class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
                </div>
            </div>
            <div class="col-12">
                <hr color="#a1f1d4">
            </div>
        </section>
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
                                var appointmentDate = new Date(appointment.date);
                                var today = new Date();
                                var datePrecedente = new Date(today);
                                datePrecedente.setDate(today.getDate() - 1);
                                if (appointmentDate > datePrecedente) {
                                var newRow = '<tr>' +
                                    '<td align="center"><label class="badge badge-primary-soft"><i class="fas fa-calendar"></i> ' +
                                    appointment.date + '</label></td>' +
                                    '<td align="center"><label class="badge badge-primary-soft"><i class="fa fa-clock"></i> ' +
                                    appointment.time_start + ' - ' + appointment
                                    .time_end + '</label></td>' +
                                    '<td class="text-center">' + appointment
                                    .created_at + '</td>' +
                                    '</tr>';
                                appointmentsTable.append(newRow);
                                }
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

<script src="{{ asset('dashboard/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/demo/swipper.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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
@endsection

@section('footer')
    <script src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#rdv_status, #is_read').multiselect();
        });
    </script>
@endsection
{{-- @section('content')

    <div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.New Appointment') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="patient">{{ __('sentence.Patient') }} 
                            @can('add patient') - <a href="{{ route('patient.create') }}" class="text-muted">{{ __('sentence.New Patient') }}</a> 
                            @endcan
                        </label>
                        <select class="form-control patient multiselect-doctorino" id="patient" name="patient">
                            <option>{{ __('sentence.Select Patient') }}</option>
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->name }} (ID : {{ $patient->id }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rdvdate">{{ __('sentence.Date') }}</label>
                        <input type="text" class="form-control target" readonly="readonly" id="rdvdate" name="rdv_date">
                        <small id="dateHelp" class="form-text text-muted">Select date to view time slots available</small>
                    </div>
                    <div class="form-group">
                        <label for="reason">{{ __('sentence.Reason for visit') }}</label>
                        <textarea class="form-control" id="reason" name="reason"></textarea>
                        <small id="reasonHelp" class="form-text text-muted">Enter a description</small>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="sms" name="send_sms">
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
    <!-- Appointment Modal -->
    <div class="modal fade" id="RDVModalSubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('sentence.Are you sure of the date') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>{{ __('sentence.Patient') }} :</b> <span id="modal_patient_name"></span></p>
                <p><b>{{ __('sentence.Date') }} :</b> <label class="badge badge-primary-soft" id="modal_rdv_date"></label></p>
                <p><b>{{ __('sentence.Time Slot') }} :</b> <label class="badge badge-primary-soft" id="modal_rdv_time"></label></p>
                <p><b>{{ __('sentence.Reason for visit') }} :</b> <label class="badge badge-primary-soft" id="modal_reason_for_visit"></label></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('sentence.Cancel') }}</button>
                <a class="btn btn-primary text-white" onclick="event.preventDefault(); document.getElementById('rdv-form').submit();">{{ __('sentence.Save') }}</a>
                <form id="rdv-form" action="{{ route('appointment.store_appointment') }}" method="POST" class="d-none">
                <input type="hidden" name="patient" id="patient_input">
                <input type="hidden" name="rdv_date" id="rdv_date_input">
                <input type="hidden" name="rdv_time_start" id="rdv_time_start_input">
                <input type="hidden" name="rdv_time_end" id="rdv_time_end_input">
                <input type="hidden" name="send_sms" id="send_sms_input">
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

@endsection

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.multiselect-doctorino').select2();
        });
    </script>
@endsection --}}