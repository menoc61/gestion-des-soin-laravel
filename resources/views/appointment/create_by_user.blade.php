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

    <form method="post" id="myForm" action="{{ route('appointment.store') }}" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col-md-6 my-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.New Appointment') }}</h6>
                    </div>
                    <div class="card-body">

                        <div class="row ">
                            <div class="form-group col-md-4">
                                <label for="patient_name">{{ __('sentence.Patient') }}</label>
                                <select class="form-control patient_name multiselect-doctorino" name="patient"
                                    id="patient_name">
                                    <option value="{{ $userId }}" selected>
                                        {{ $userName }}
                                    </option>
                                </select>
                                {{ csrf_field() }}
                            </div>

                            <div class="form-group col-md-4">
                                @if (Auth::user()->role_id != 2)
                                    <div class="form-group">
                                        <label for="doctor_name">{{ __('sentence.Praticiens P') }} </label>
                                        <select class="form-control multiselect-search" name="doctor_id" id="DoctorID" required>
                                            <option value="" disabled selected>{{ __('sentence.Select Praticien') }}...
                                            </option>
                                            @foreach ($praticiens as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                <div class="form-group">
                                    <label for="doctor_name">{{ __('sentence.Praticiens P') }} </label>
                                    <select class="form-control multiselect-search" name="doctor_id_disabled" id="DoctorID" disabled>
                                        @foreach ($praticiens as $user)
                                            <option value="{{ $user->id }}" {{ Auth::user()->id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <!-- Champ caché pour envoyer l'ID du praticien actuellement connecté  {{ Auth::user()->id == $user->id ? 'selected' : '' }}-->
                                    <input type="hidden" name="doctor_id" id ="DoctorID" value="{{ Auth::user()->id }}">
                                </div>

                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label for="rdvdate">{{ __('sentence.Date') }}</label>
                                <input type="text" class="form-control target agenda" name="rdv_time_date"
                                    readonly="readonly" id="rdvdate">
                                <small id="emailHelp" class="form-text text-muted">Sélectionnez la date pour afficher les plages horaires disponibles</small>
                            </div>

                            <!-- <div class="form-group col-md-3">
                                <label for="rdv_time_start">{{ __('sentence.Hour_start') }}</label>
                                <input type="time" class="form-control target" name="rdv_time_start">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="rdv_time_end">{{ __('sentence.Hour_end') }}</label>
                                <input type="time" class="form-control target" name="rdv_time_end">
                            </div> -->
                            <div class="form-group col-md-3">
                                    <label for="rdv_time_start">{{ __('sentence.Hour_start') }}</label>
                                    <select class="form-control target" name="rdv_time_start">
                                        @for ($hour = 9; $hour < 19; $hour++)
                                           @for ($minute = 0; $minute < 60; $minute += 30)
                                              @php
                                                $time = sprintf('%02d:%02d', $hour, $minute);
                                              @endphp
                                             <option value="{{ $time }}">{{ $time }}</option>
                                           @endfor
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="rdv_time_end">{{ __('sentence.Hour_end') }}</label>
                                    <select class="form-control target" name="rdv_time_end">
                                          @for ($hour = 9; $hour < 22; $hour++)
                                             @for ($minute = 0; $minute < 60; $minute += 30)
                                                @php
                                                  $time = sprintf('%02d:%02d', $hour, $minute);
                                                @endphp
                                                <option value="{{ $time }}">{{ $time }}</option>
                                             @endfor
                                           @endfor
                                     </select>
                                </div> 

                                <div class="form-group col-md-6">
                                       <label>Praticiens secondaires :</label>
                                       <div id="praticient-container">
                                           <div class="praticient-group">
                                               <select name="praticient_id[]" class="form-control praticient-select">
                                                   <option value="" disabled selected>Selectionnez les praticiens secondaires...</option>
                                                   @foreach ($other_praticiens as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                   @endforeach
                                                </select>
                                                <button type="button" class="btn btn-sm btn-danger remove-praticient">x</button>
                                            </div>
                                        </div>
                                       <button type="button" class="btn btn-sm btn-primary mt-2" id="add-praticient">+</button>
                               </div>


                            {{-- <div class="form-group col-md-6">
                                <label for="reason">{{ __('sentence.Reason for visit') }}</label>
                                <textarea class="form-control" id="reason" name="reason"></textarea>
                                <small id="emailHelp" class="form-text text-muted">Entrez une drescription</small>
                            </div> --}}

                            {{-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="send_sms" id="sms">
                                <label class="form-check-label" for="sms">
                                    {{ __('sentence.Send SMS') }}
                                </label>
                            </div> --}}

                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success">{{ __('sentence.Save') }}</button>
                            </div>
                        </div>

                    </div>
                </div>
                            <!-- -->
                <!-- <div class="card">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Agenda praticien') }} <span
                                id="doctor-name"></span></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="agendas-table">

                                <tr>
                                    <td align="center">{{ __('sentence.Date') }}</td>
                                    <td align="center">{{ __('sentence.Time Slot') }}</td>
                                </tr>
                                 Appointments will be dynamically inserted here 
                            </table>
                        </div>
                    </div>
                </div> -->
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
                        <div class="d-flex col-md-12">
                            <!-- @if (Auth::user()->role_id != 3)
                                <div class="col-md-4">
                                    <a class="btn btn-primary" href="{{ route('billing.create_by', ['id' => $userId]) }}">
                                        payer
                                    </a>
                                </div>
                            @endif -->
                            <div class="col-md-6">
                                <a class="btn btn-secondary" href="{{ route('patient.view', ['id' => $userId]) }}">Accueil
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-secondary"
                                    href="{{ route('appointment.create_by', ['id' => $userId]) }}"> Nouveau RDV
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                    <select class="form-control multiselect-search multiselect-drug" name="trade_name[]" id="drug" tabindex="-1" aria-hidden="true" required>
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
                                    .time_end + '</label></td>'
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
    $(document).ready(function () {
        // Gérer l'ajout dynamique de praticiens secondaires
        $('#add-praticient').click(function () {
            let newPraticientGroup = `
                <div class="praticient-group mt-2">
                    <select name="praticient_id[]" class="form-control praticient-select">
                        <option value="" disabled selected>Selectionnez les praticiens secondaires...</option>
                        @foreach ($other_praticiens as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-sm btn-danger remove-praticient">x</button>
                </div>
            `;
            $('#praticient-container').append(newPraticientGroup);
        });

        // Supprimer un praticien secondaire sélectionné
        $(document).on('click', '.remove-praticient', function () {
            $(this).closest('.praticient-group').remove();
        });

        // Charger l'agenda d'un praticien secondaire
        $(document).on('change', '.praticient-select', function () {
            var praticientId = $(this).val(); // Récupérer l'ID du praticien sélectionné
            var praticientName = $(this).find("option:selected").text(); // Récupérer le nom du praticien sélectionné

            if (praticientId) {
                $.ajax({
                    url: '/appointments/by-praticient/' + praticientId, // Endpoint pour récupérer l'agenda
                    method: 'GET',
                    success: function (response) {
                        // Mettre à jour le nom du praticien dans l'en-tête
                        $('#doctor-name').text(' - ' + praticientName);

                        // Réinitialiser le tableau pour afficher uniquement l'agenda du praticien sélectionné
                        var agendasTable = $('#agendas-table');
                        agendasTable.find('tr:gt(0)').remove(); // Supprimer les anciennes lignes sauf l'en-tête

                        // Ajouter les rendez-vous reçus dans la réponse
                        if (response.length > 0) {
                            response.forEach(function (appointment) {
                                var appointmentDate = new Date(appointment.date);
                                var today = new Date();
                                var datePrecedente = new Date(today);
                                datePrecedente.setDate(today.getDate() - 1);

                                if (appointmentDate > datePrecedente) {
                                    var newRow = `
                                        <tr>
                                            <td align="center">
                                                <label class="badge badge-primary-soft">
                                                    <i class="fas fa-calendar"></i> ${appointment.date}
                                                </label>
                                            </td>
                                            <td align="center">
                                                <label class="badge badge-primary-soft">
                                                    <i class="fa fa-clock"></i> ${appointment.time_start} - ${appointment.time_end}
                                                </label>
                                            </td>
                                        </tr>
                                    `;
                                    agendasTable.append(newRow);
                                }
                            });
                        } else {
                            var noData = `
                                <tr>
                                    <td colspan="2" align="center">
                                        <img src="{{ asset('img/not-found.svg') }}" width="200" />
                                        <br><br>
                                        <b class="text-muted">{{ __('sentence.No appointment available') }}</b>
                                    </td>
                                </tr>
                            `;
                            agendasTable.append(noData);
                        }
                    },
                    // error: function () {
                    //     alert('Erreur lors du chargement de l\'agenda du praticien.');
                    // }
                });
            }
        });
    });
</script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
          // Ajouter un nouveau praticien
            document.getElementById('add-praticient').addEventListener('click', function() {
                let container = document.getElementById('praticient-container');
                let newGroup = container.firstElementChild.cloneNode(true); // Cloner le premier groupe
                container.appendChild(newGroup); // Ajouter le groupe cloné
                newGroup.querySelector('.praticient-select').selectedIndex = 0; // Réinitialiser la sélection
            });

               // Supprimer un praticien sélectionné
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-praticient')) {
                    let container = document.getElementById('praticient-container');
                    if (container.children.length > 1) {
                        event.target.closest('.praticient-group').remove();
                    } else {
                        alert("Vous devez avoir au moins un praticien sélectionné.");
                    }
                }
            });
        });

    </script>

    {{-- <script>
        $(document).ready(function() {
            // Initialisation du datepicker
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
                var selectedDate = $(this).val();
                var doctorId = $('#DoctorID').val();

                if (doctorId && selectedDate) {
                    $.ajax({
                        url: '/appointments/check-availability/' + doctorId + '/' + selectedDate,
                        method: 'GET',
                        success: function(response) {
                            var startTimes = response.map(function(appointment) {
                                return appointment.rdv_time_start;
                            });

                            var endTimes = response.map(function(appointment) {
                                return appointment.rdv_time_end;
                            });

                            // Désactiver les options d'heure de début et de fin qui existent déjà
                            $('input[name="rdv_time_start"]').find('option').each(function() {
                                if (startTimes.includes($(this).val())) {
                                    $(this).attr('disabled', true);
                                } else {
                                    $(this).attr('disabled', false);
                                }
                            });

                            $('input[name="rdv_time_end"]').find('option').each(function() {
                                if (endTimes.includes($(this).val())) {
                                    $(this).attr('disabled', true);
                                } else {
                                    $(this).attr('disabled', false);
                                }
                            });
                        }
                    });
                }
            });

            // Initialiser Select2
            $('.multiselect-doctorino').select2();
            $('.multiselect-search').select2();
        });
    </script> --}}

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

    {{-- <script type="text/javascript">
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
    </script> --}}

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

    <script type="text/javascript">
        $(document).ready(function() {
            $('.multiselect-search').select2();

            // Get references to the patient and test select elements
            const patientSelect = $('#PatientID');
            const testSelect = $('#test');

            // Store the original test options
            const originalTestOptions = testSelect.html();

            // Function to update test options based on the selected patient
            function updateTestOptions() {
                const selectedPatientName = patientSelect.find('option:selected').text();

                // Clear and restore original test options
                testSelect.empty().html(originalTestOptions);

                // Filter and show test options based on the selected patient
                testSelect.find('option').each(function() {
                    const optionText = $(this).text();
                    if (optionText.includes(selectedPatientName)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                // Trigger the Select2 plugin to update the dropdown
                testSelect.trigger('change');
            }

            // Attach a change event listener to the patient select element
            patientSelect.on('change', function() {
                updateTestOptions();
            });
        });
    </script>
@endsection
