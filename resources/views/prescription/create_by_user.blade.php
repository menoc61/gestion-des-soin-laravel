@extends('layouts.master')
@section('title')
    {{ __('sentence.New Prescription') }}
@endsection

@section('content')
    <div class="">
        <div class="mb-3">
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-12">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-dark text-center"> {{ __('sentence.Prescription') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('prescription.store_id', ['id' => $userId]) }}">

        <div class="row justify-content-center mt-4">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Patient informations') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('sentence.Prescription Name') }} :</label>
                            <input type="text" class="form-control" id="nomInput" name="nom">
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group">
                            <label>{{ __('sentence.psycho dosage') }} :</label>
                            <input type="number" class="form-control" name="dosage" min="1">
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group">
                            <label for="PatientID">{{ __('sentence.Patient') }} :</label>
                            <input type="hidden" class="form-control" value="{{ $userId }}" name="patient_id"
                                readonly>
                            <input type="text" class="form-control" value="{{ $userName }}" readonly>
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group">
                            <label for="DoctorID">{{ __('sentence.Praticiens') }} :</label>
                            @if (Auth::user()->role_id === 1)
                                <select class="form-control" name="Doctor_id" id="DoctorID" required>
                                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                    @foreach ($praticiens as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="hidden" name="Doctor_id" class="form-control" value="{{ Auth::user()->id }}"
                                    readonly>
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            @endif
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group">
                            <input type="submit" value="{{ __('sentence.Create Prescription') }}"
                                class="btn btn-success btn-block" align="center">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
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
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Tests list') }}</h6>
                    </div>
                    <div class="card-body form-group row">
                        <div class="form-group col-md-4">
                            <label for="morphology_patient">{{ __('sentence.Tests') }}<font color="red">*
                                </font></label>
                            <div>
                                <select class="form-control" name="test_name[]" id="testSelect" required>
                                    @if (@empty($tests))
                                        <option value="">{{ __('sentence.Select Test') }}...</option>
                                    @else
                                        @foreach ($tests as $test)
                                            @if (Auth::user()->role_id == 2 && Auth::user()->id == $test->created_by)
                                                <option value="{{ $test->id }}">{{ $test->test_name }}</option>
                                            @elseif (Auth::user()->role_id == 1)
                                                <option value="{{ $test->id }}">{{ $test->test_name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">{{ __('sentence.Description') }}<font color="red">*</font></label>
                            <textarea type="text" class="form-control" name="description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
@endsection

@section('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-multiselect.css') }}">
    <script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}">
        < /> <
        script type = "text/javascript" >
            $('#trade_name').multiselect();
    </script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        $(function() {
            $('input[name="datetimes"]').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });
        });
    </script>
@endsection
