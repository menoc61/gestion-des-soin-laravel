@extends('layouts.master')


@section('title')
    {{ __('sentence.View Test Detail') }}
@endsection


@section('content')

    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col">
                                <strong><u>{{ __('sentence.Test') }} </u></strong><br><br>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nom Diagnostic</th>
                                        <th>Type Diagnostic</th>
                                        <th>Description Diagnostic</th>
                                        <th>Détail Diagnostic</th>
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
                                            <td>{{ $tests->Test->comment }}</td>
                                            <td>
                                                @if (is_array($diagnosticType))
                                                    @foreach ($diagnosticType as $diagnostic)
                                                        @if ($diagnostic === 'DIAGNOSE MAIN')
                                                        @elseif ($diagnostic === 'DIAGNOSE PEAU')
                                                            {{ $tests->Test->signes_particuliers_peau }}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
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
                </div>
            </div>
        </div>
    </div>
@endsection
