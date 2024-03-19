@extends('layouts.master')

@section('title')
    {{ __('sentence.follow') }}
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
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.follow on statistics') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-md-full ">
                                <canvas id="myDoughnutChart" width="100%" height="100%"></canvas>
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
                                                        class="ui-autocomplete-input" autocomplete="off" value="{{ $prescription_drug->type }}"
                                                        readonly
                                                        style="
                                                        color: {{ $prescription_drug->type == 'new' ? '#28a745' : 'orange' }};
                                                        background-color: transparent;
                                                        border-color: {{ $prescription_drug->type == 'new' ? '#28a745' : 'orange' }}">
                                                    <label class="control-label"></label><i class="bar"></i>
                                                    <input type="hidden" name="prescription_drug_id[]"
                                                        value="{{ $prescription_drug->id }}">
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <select select class="form-control multiselect-drug" name="trade_name[]"
                                                    id="drug" tabindex="-1" aria-hidden="true" required
                                                    @readonly(true)>
                                                    @if (@empty($drugs))
                                                        <option value="">No drug available</option>
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
                                                        value="{{ $prescription_drug->dose }}" min="0" readonly>
                                                    <label class="control-label"></label><i class="bar"></i>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <input type="date" id="duration" name="duration[]"
                                                        class="form-control" placeholder="{{ __('sentence.Duration') }}"
                                                        value="{{ $prescription_drug->duration }}"@required(true)>
                                                    <small id="small text" class="form-text text-muted">date estimative de
                                                        fin du treatement</small>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group-custom">
                                                    <input type="text" id="drug_advice" name="drug_advice[]"
                                                        class="form-control"
                                                        placeholder="{{ __('sentence.Advice_Comment') }}"
                                                        value="{{ $prescription_drug->drug_advice }}" hidden readonly>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <hr color="orange">
                                            </div>
                                        </div>
                                    </section>
                                @endforeach
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard/vendor/chart.js/Chart.bundle.js"></script>
    <script type="text/javascript">
        var prescriptionDrugs = {!! json_encode($prescription_drugs) !!};
        var prescriptionDrugs = {!! json_encode($prescription_drugs) !!};
        var sumPrescriptionDrugs = {!! json_encode( array_sum($prescription_drugs->pluck('dose')->toArray()) ) !!};
    </script>
    <script src="{{ asset('assets/demo/chart-doughnut-demo.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.multiselect-doctorino').select2();
        });

        $(document).ready(function() {
            $('.multiselect-drug').select2();
        });
    </script>
@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
