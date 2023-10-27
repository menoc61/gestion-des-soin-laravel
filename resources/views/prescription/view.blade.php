@extends('layouts.master')


@section('title')
    {{ __('sentence.View Prescription') }}
@endsection


@section('content')

    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <button href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm print_prescription"><i
                class="fas fa-print fa-sm text-white-50"></i> Imprimer</button>
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <!-- ROW : Doctor informations -->
                    <div class="row">
                        <div class="col">
                            @if (!empty(App\Setting::get_option('logo')))
                                <img src="{{ asset('uploads/' . App\Setting::get_option('logo')) }}"><br><br>
                            @endif
                            {!! clean(App\Setting::get_option('header_left')) !!}
                        </div>
                        <div class="col-md-3">
                            <p><b>{{ __('sentence.Date') }} :</b> {{ $prescription->created_at->format('d M Y h:m:s') }}</p>
                            <p><b>{{ __('sentence.Reference') }} :</b> {{ $prescription->reference }}</p>
                        </div>
                    </div>
                    <!-- END ROW : Doctor informations -->
                    <!-- ROW : Patient informations -->
                    <div class="row">
                        <div class="col">
                            <hr>
                            <p>
                                <b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}
                                @isset($prescription->User->Patient->birthday)
                                    <br><b>{{ __('sentence.Age') }} :</b> {{ $prescription->User->Patient->birthday }}
                                    ({{ \Carbon\Carbon::parse($prescription->User->Patient->birthday)->age }} Years)
                                @endisset
                                @isset($prescription->User->Patient->gender)
                                    <br><b>{{ __('sentence.Gender') }} :</b>
                                    {{ $prescription->User->Patient->gender }}
                                @endisset
                                @isset($prescription->User->Patient->weight)
                                    <br><b>{{ __('sentence.Patient Weight') }} :</b>
                                    {{ $prescription->User->Patient->weight }}
                                    Kg
                                @endisset
                                @isset($prescription->User->Patient->height)
                                    <br><b>{{ __('sentence.Patient Height') }} :</b>
                                    {{ $prescription->User->Patient->height }}
                                @endisset
                            </p>
                            <hr>
                        </div>
                    </div>
                    <!-- END ROW : Patient informations -->
                    @if (count($prescription_tests) > 0)
                        <!-- ROW : Tests List -->
                        <div class="row justify-content-center">
                            <div class="col">
                                <strong><u>{{ __('sentence.Test to do') }} </u></strong><br><br>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nom Diagnostic</th>
                                        <th>Type Diagnostic</th>
                                        <th>Description Diagnostic</th>
                                        {{-- <th>Détail Diagnostic</th> --}}
                                    </tr>
                                    @forelse ($prescription_tests as $tests)
                                        <tr>
                                            <td>{{ $tests->Test->test_name }}</td>
                                            <td>
                                                <!-- décoder sous le format json-->
                                                @php
                                                    $diagnosticType = json_decode($tests->Test->diagnostic_type);
                                                @endphp

                                                @if (is_array($diagnosticType))
                                                    @foreach ($diagnosticType as $diagnostic)
                                                        {{ $diagnostic }},
                                                    @endforeach
                                                @else
                                                    {{ $diagnosticType }}
                                                @endif
                                            </td>
                                            <td>{{ $tests->description }}</td>
                                            {{-- <td>
                                                @if (is_array($diagnosticType))
                                                    @foreach ($diagnosticType as $diagnostic)
                                                        @if ($diagnostic === 'DIAGNOSE MAIN')
                                                        @elseif ($diagnostic === 'DIAGNOSE PEAU')
                                                            {{ $tests->Test->signes_particuliers_peau }}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td> --}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Aucun Diagnostic disponible.</td>
                                        </tr>
                                    @endforelse
                                </table>
                                <hr>
                            </div>
                        </div>
                        <!-- END ROW : Tests List -->
                    @endif
                    @if (count($prescription_drugs) > 0)
                        <!-- ROW : Drugs List -->
                        <div class="row justify-content-center">
                            <div class="col">
                                <strong><u>{{ __('sentence.Drug') }} : </u></strong><br><br>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nom Soin</th>
                                        <th>Type Soin</th>
                                        <th>Produits Soin</th>
                                    </tr>
                                    @forelse ($prescription_drugs as $drug)
                                        <tr>
                                            <td> {{ $drug->type }} </td>
                                            <td> {{ $drug->Drug->trade_name }} </td>
                                            <td>
                                                @php
                                                    $product = json_decode($drug->Drug->generic_name);
                                                @endphp

                                                @if (is_array($product))
                                                    @foreach ($product as $products)
                                                    <label class="badge badge-primary-soft">{{ $products }}</label>
                                                    @endforeach
                                                @else
                                                    {{ $product }}
                                                @endif

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Aucun Soin disponible.</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    @endif
                    @if (!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right')))
                        <!-- ROW : Footer informations -->
                        <div class="row">
                            <div class="col">
                                <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                            </div>
                            <div class="col">
                                <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                            </div>
                        </div>
                        <!-- END ROW : Footer informations -->
                    @elseif(empty(App\Setting::get_option('footer_left')))
                        <!-- ROW : Footer informations -->
                        <div class="row">
                            <div class="col">
                                <p class="font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                            </div>
                        </div>
                        <!-- END ROW : Footer informations -->
                    @elseif(empty(App\Setting::get_option('footer_right')))
                        <!-- ROW : Footer informations -->
                        <div class="row">
                            <div class="col">
                                <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                            </div>
                        </div>
                        <!-- END ROW : Footer informations -->
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden prescription -->
    <div id="print_area" style="display: none;">
        <!-- ROW : Doctor informations -->
        <div class="row">
            <div class="col-9">
                @if (!empty(App\Setting::get_option('logo')))
                    <img src="{{ asset('uploads/' . App\Setting::get_option('logo')) }}"><br><br>
                @endif
                {!! clean(App\Setting::get_option('header_left')) !!}
            </div>
            <div class="col-3">
                {{ __('sentence.Date') }} {{ $prescription->created_at->format('d M Y h:m:s') }}
            </div>
        </div>
        <!-- END ROW : Doctor informations -->
        <hr>
        <!-- ROW : Patient informations -->
        <div class="row">
            <div class="col">
                <hr>
                <p>
                    <b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}
                    @isset($prescription->User->Patient->birthday)
                        <br><b>{{ __('sentence.Age') }} :</b> {{ $prescription->User->Patient->birthday }}
                        ({{ \Carbon\Carbon::parse($prescription->User->Patient->birthday)->age }} Years)
                    @endisset
                    @isset($prescription->User->Patient->gender)
                        <br><b>{{ __('sentence.Gender') }} :</b>
                        {{ $prescription->User->Patient->gender }}
                    @endisset
                    @isset($prescription->User->Patient->weight)
                        <br><b>{{ __('sentence.Patient Weight') }} :</b>
                        {{ $prescription->User->Patient->weight }}
                        Kg
                    @endisset
                    @isset($prescription->User->Patient->height)
                        <br><b>{{ __('sentence.Patient Height') }} :</b>
                        {{ $prescription->User->Patient->height }}
                    @endisset
                </p>
                <hr>
            </div>
        </div>
        <!-- END ROW : Patient informations -->

        @if (count($prescription_tests) > 0)
            <!-- ROW : Tests List -->
            <div class="row justify-content-center">
                <div class="col">
                    <strong><u>{{ __('sentence.Test to do') }} </u></strong><br><br>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nom Diagnostic</th>
                            <th>Type Diagnostic</th>
                            {{-- <th>Détail Diagnostic</th> --}}
                        </tr>
                        @forelse ($prescription_tests as $tests)
                            <tr>
                                <td>{{ $tests->Test->test_name }}</td>
                                <td>
                                    <!-- décoder sous le format json-->
                                    @php
                                        $diagnosticType = json_decode($tests->Test->diagnostic_type);
                                    @endphp

                                    @if (is_array($diagnosticType))
                                        @foreach ($diagnosticType as $diagnostic)
                                            {{ $diagnostic }},
                                        @endforeach
                                    @else
                                        {{ $diagnosticType }}
                                    @endif
                                </td>
                                {{-- <td>
                                    @if (is_array($diagnosticType))
                                        @foreach ($diagnosticType as $diagnostic)
                                            @if ($diagnostic === 'DIAGNOSE MAIN')
                                            @elseif ($diagnostic === 'DIAGNOSE PEAU')
                                                {{ $tests->Test->signes_particuliers_peau }}
                                            @endif
                                        @endforeach
                                    @endif
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Aucun test disponible.</td>
                            </tr>
                        @endforelse
                    </table>
                    <hr>
                </div>
            </div>
            <!-- END ROW : Tests List -->
        @endif
        @if (count($prescription_drugs) > 0)
            <!-- ROW : Drugs List -->
            <div class="row justify-content-center">
                <div class="col">
                    <strong><u>{{ __('sentence.Drug') }} : </u></strong><br><br>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nom Soin</th>
                            <th>Type Soin</th>
                            <th>Produits Soin</th>
                        </tr>
                        @forelse ($prescription_drugs as $drug)
                            <tr>
                                <td> {{ $drug->type }} </td>
                                <td> {{ $drug->Drug->trade_name }} </td>
                                <td>
                                    @php
                                        $product = json_decode($drug->Drug->generic_name);
                                    @endphp

                                    @if (is_array($product))
                                        @foreach ($product as $products)
                                        <label class="badge badge-primary-soft">{{ $products }}</label>
                                        @endforeach
                                    @else
                                        {{ $product }}
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Aucun Soin disponible.</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        @endif
        <!-- ROW : Footer informations -->
        <footer style="position: absolute; bottom: 0;">
            <hr>
            @if (!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right')))
                <!-- ROW : Footer informations -->
                <div class="row">
                    <div class="col">
                        <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                    </div>
                    <div class="col">
                        <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                    </div>
                </div>
                <!-- END ROW : Footer informations -->
            @elseif(empty(App\Setting::get_option('footer_left')))
                <!-- ROW : Footer informations -->
                <div class="row">
                    <div class="col">
                        <p class="font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                    </div>
                </div>
                <!-- END ROW : Footer informations -->
            @elseif(empty(App\Setting::get_option('footer_right')))
                <!-- ROW : Footer informations -->
                <div class="row">
                    <div class="col">
                        <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                    </div>
                </div>
                <!-- END ROW : Footer informations -->
            @else
            @endif
        </footer>
        <!-- END ROW : Footer informations -->
    </div>
@endsection
@section('header')
    <style type="text/css">
        p,
        u,
        li {
            color: #444444 !important;
        }
    </style>
@endsection
@section('footer')
    <script type="text/javascript">
        function printDiv(divName) {

            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }


        $(function() {
            $(document).on("click", '.print_prescription', function() {
                printDiv('print_area');
            });
        });
    </script>
@endsection
