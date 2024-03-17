@extends('layouts.master')

@section('title')
    {{ __('sentence.Edit Prescription') }}
@endsection

@section('content')
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <form method="post" action="{{ route('prescription.update') }}">

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Patient informations') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="PatientID">{{ __('sentence.Patient') }} :</label>
                            <option value="{{ $prescription->user_id }}">{{ $prescription->User->name }} -
                                {{ \Carbon\Carbon::parse($prescription->User->Patient->birthday)->age }} Years</option>
                            <input type="hidden" name="patient_id" value="{{ $prescription->user_id }}">
                            <input type="hidden" name="prescription_id" value="{{ $prescription->id }}">
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group text-center">
                            <img src="{{ asset('img/patient-icon.png') }}" class="img-profile rounded-circle img-fluid">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="{{ __('sentence.Edit Prescription') }}"
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
                            <div class="repeatable">
                                @foreach ($prescription_drugs as $prescription_drug)
                                    <section class="field-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group-custom">
                                                    <input type="text" class="form-control" name="type[]" id="task_{?}"
                                                        placeholder="{{ __('sentence.Type') }}"
                                                        class="ui-autocomplete-input" autocomplete="off" value="pending"
                                                        readonly
                                                        style="
                                                        color: orange;
                                                        background-color: transparent;
                                                        border-color: orange">
                                                    <label class="control-label"></label><i class="bar"></i>
                                                    <input type="hidden" name="prescription_drug_id[]"
                                                        value="{{ $prescription_drug->id }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <select select class="form-control multiselect-drug" name="trade_name[]"
                                                    id="drug" tabindex="-1" aria-hidden="true" required>
                                                    @if (@empty($drugs))
                                                        <option value="">selectionner un soin</option>
                                                    @else
                                                        @foreach ($drugs as $drug)
                                                            <option value="{{ $drug->id }}">{{ $drug->trade_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            {{-- <div class="col-md-4">
                                                <div class="form-group-custom">
                                                    <input type="text" id="strength" name="strength[]"
                                                        class="form-control" placeholder="Mg/Ml"
                                                        value="{{ $prescription_drug->strength }}">
                                                </div>
                                            </div> --}}
                                        </div>

                                        <div class="row">

                                            <div class="col-md-2">
                                                <div class="form-group-custom">
                                                    <input type="number" id="dose" name="dose[]" class="form-control"
                                                        placeholder="{{ __('sentence.Dose') }}"
                                                        value="{{ $prescription_drug->dose }}" min="0">
                                                    <label class="control-label"></label><i class="bar"></i>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <input type="date" id="duration" name="duration[]"
                                                        class="form-control" placeholder="{{ __('sentence.Duration') }}"
                                                        value="{{ $prescription_drug->duration }}"@required(true) >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group-custom">
                                                    <input type="text" id="drug_advice" name="drug_advice[]"
                                                        class="form-control"
                                                        placeholder="{{ __('sentence.Advice_Comment') }}"
                                                        value="{{ $prescription_drug->drug_advice }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"><i
                                                        class="fa fa-trash font-size-12"></i>
                                                    {{ __('sentence.Remove') }}</a>
                                            </div>
                                            <div class="col-12">
                                                <hr color="red">
                                            </div>
                                        </div>
                                    </section>
                                @endforeach
                            </div>
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
                    <div class="card-body">
                        <fieldset class="test_labels">
                            <div class="repeatable">
                                @foreach ($prescription_tests as $prescription_test)
                                    <div class="field-group row">

                                        <div class="col-md-4">
                                            <select class="form-control multiselect-doctorino" name="test_name[]"
                                                id="test" tabindex="-1" aria-hidden="true" required>
                                                <option value="{{ $prescription_test->test_id }}">
                                                    {{ $prescription_test->Test->test_name }} </option>
                                                @foreach ($tests as $test)
                                                    <option value="{{ $test->id }}">{{ $test->test_name }} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group-custom">
                                                <input type="text" id="strength" name="description[]"
                                                    class="form-control" placeholder="{{ __('sentence.Description') }}">
                                                <input type="hidden" name="prescription_test_id[]"
                                                    value="{{ $prescription_test->id }}">

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a type="button" class="btn btn-danger delete text-white btn-sm"
                                                align="center"><i class="fa fa-trash font-size-12"></i>
                                                {{ __('sentence.Remove') }}</a>

                                        </div>
                                        <div class="col-12">
                                            <hr color="#a1f1d4">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary add text-white" align="center"><i
                                        class='fa fa-plus'></i> {{ __('sentence.Add Test') }}</a>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.multiselect-doctorino').select2();
        });

        $(document).ready(function() {
            $('.multiselect-drug').select2();
        });
        $('#drug').multiselect();
    </script>


    <script type="text/template" id="drugs_labels">
    <section class="field-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group-custom">
                                        <input type="text" class="form-control"
                                        name="type[]" id="task_{?}" placeholder="{{ __('sentence.Type') }}"
                                        class="ui-autocomplete-input" style="
                                                                            color: #28a745;
                                                                            background-color: transparent;
                                                                            border-color: #28a745;"
                                        value="new" autocomplete="off" @readonly(true)>
                                        <label class="control-label"></label><i class="bar"></i>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <select class="form-control multiselect-drug" name="trade_name[]" id="drug" tabindex="-1" aria-hidden="true" required>
                                        @if (@empty($drugs))
                                            <option value="" disabled selected>{{ __('sentence.Select Drug') }}...</option>
                                        @else
                                            @foreach($drugs as $drug)
                                                <option value="{{ $drug->id }}">{{ $drug->trade_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div id="genericNames"></div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group-custom">
                                        <input type="number" min="0" id="dose" name="dose[]" class="form-control" placeholder="{{ __('sentence.Dose') }}">
                                        <label class="control-label"></label><i class="bar"></i>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group-custom">
                                        <input type="date" id="duration" name="duration[]" class="form-control" placeholder="{{ __('sentence.Duration') }}">
                                        <small id="startDate" class="form-text text-muted">Definir la period du suivi</small>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                    <div class="form-group-custom">
                                        <input type="date" id="strength" name="strength[]"  class="form-control" placeholder="{{ __('sentence.Duration') }}">
                                        <small id="startDate" class="form-text text-muted">Select date to view time slots available</small>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group-custom">
                                        <input type="text" id="drug_advice" name="drug_advice[]" class="form-control" placeholder="{{ __('sentence.Advice_Comment') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                        <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"><i class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
                                </div>
                                <div class="col-12">
                                        <hr color="#a1f1d4">
                                </div>
                            </div>
        </section>
</script>
    <script type="text/template" id="test_labels">
                         <div class="field-group row">

                             <div class="col-md-4">
                                 <select class="form-control multiselect-doctorino" name="test_name[]" id="test" tabindex="-1" aria-hidden="true" required>
                                    @if (@empty($tests))
                                     <option value="">{{ __('sentence.Select Test') }}...</option>
                                   @else
                                    @foreach($tests as $test)
                                        <option value="{{ $test->id }}">{{ $test->test_name }}</option>
                                    @endforeach
                                   @endif
                                 </select>
                             </div>

                             <div class="col-md-4">
                                 <div class="form-group-custom">
                                     <input type="text" id="strength" name="description[]"  class="form-control" placeholder="{{ __('sentence.Description') }}">
                                 </div>
                             </div>
                             <div class="col-md-3">
                                 <a type="button" class="btn btn-danger delete text-white btn-sm" align="center"><i class='fa fa-trash  font-size-12'></i> {{ __('sentence.Remove') }}</a>

                              </div>
                              <div class="col-12">
                                    <hr color="#a1f1d4">
                              </div>
                         </div>
</script>
@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
