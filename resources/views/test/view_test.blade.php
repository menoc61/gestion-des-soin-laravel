@extends('layouts.master')


@section('title')
    {{ __('sentence.View Test Detail') }}
@endsection


@section('content')

    <div class="">
        <div class="mb-3">
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-10">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary text-center"> {{ __('sentence.Test') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col">
                            <strong><u>{{ __('sentence.Test') }} </u></strong><br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th class="text-center">Nom Diagnostic</th>
                                        <th class="text-center">Type Diagnostic</th>
                                        <th class="text-center">Description Diagnostic</th>
                                        <th class="text-center">Détail Diagnostic</th>
                                    </tr>
                                    @forelse ($tests as $test)
                                        <tr>
                                            <td class="text-center">{{ $test->test_name }}</td>
                                            <td class="text-center">
                                                <!-- décoder sous le format json-->
                                                @php
                                                    $diagnosticType = json_decode($test->diagnostic_type);
                                                @endphp

                                                @if (is_array($diagnosticType))
                                                    @foreach ($diagnosticType as $diagnostic)
                                                        {{ $diagnostic }},
                                                    @endforeach
                                                @else
                                                    {{ $diagnosticType }}
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $test->comment }}</td>
                                            <td class="text-center">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        {{-- Diagnostic détail Main --}}
                                                        <tr class="form-group">
                                                            @if ($test->Etat_des_ongles_mains != null)
                                                                <td>
                                                                    <b>ETATS DES ONGLES DE LA MAIN:</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->Etat_des_ongles_mains }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->Etat_generale_des_mains != null)
                                                                <td>
                                                                    <b>ETAT GÉNÉRALE DES MAINS:</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->Etat_generale_des_mains }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $signes_mains = json_decode(
                                                                    $test->signes_particuliers_mains,
                                                                );
                                                            @endphp
                                                            @if ($signes_mains != null)
                                                                <td>
                                                                    <b>SIGNES PARTICULIERS DES MAINS :</b><br><br>
                                                                    @if (is_array($signes_mains))
                                                                        @foreach ($signes_mains as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $signes_mains }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @php
                                                                $signes_ongles_mains = json_decode(
                                                                    $test->signes_particuliers_ongles_mains,
                                                                );
                                                            @endphp
                                                            @if ($signes_ongles_mains !== null)
                                                                <td>
                                                                    <b>SIGNES PARTICULIERS DES ONGLES DE LA MAIN
                                                                        :</b><br><br>
                                                                    @if (is_array($signes_ongles_mains))
                                                                        @foreach ($signes_ongles_mains as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $signes_ongles_mains }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $soin_List_main = json_decode($test->soinList_main);
                                                            @endphp
                                                            @if ($soin_List_main != null)
                                                                <td>
                                                                    <b>SOINS PREFERES :</b><br><br>
                                                                    @if (is_array($soin_List_main))
                                                                        @foreach ($soin_List_main as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $soin_List_main }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->vernisInput_main != null)
                                                                <td>
                                                                    <b>VERNIS PREFERE :</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->vernisInput_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}

                                                        {{-- Diagnostic détail de la Peau --}}

                                                        {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $sebum_grpe = json_decode($test->sebum_grp);
                                                            @endphp
                                                            @if ($sebum_grpe != null)
                                                                <td>
                                                                    <b class="text-center">SEBUM</b><br><br>
                                                                    @if (is_array($sebum_grpe))
                                                                        @foreach ($sebum_grpe as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $sebum_grpe }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @php
                                                                $hydratation_grpe = json_decode($test->hydratation_grp);
                                                            @endphp
                                                            @if ($hydratation_grpe != null)
                                                                <td>
                                                                    <b>HYDRATATION</b><br><br>

                                                                    @if (is_array($hydratation_grpe))
                                                                        @foreach ($hydratation_grpe as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $hydratation_grpe }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $signe_peau = json_decode(
                                                                    $test->signes_particuliers_peau,
                                                                );
                                                            @endphp
                                                            @if ($signe_peau != null)
                                                                <td>
                                                                    <b>SIGNES PARTICULIERS DE LA PEAU</b><br><br>
                                                                    @if (is_array($signe_peau))
                                                                        @foreach ($signe_peau as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $signe_peau }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            @php
                                                                $keratinisation_grpe = json_decode(
                                                                    $test->keratinisation_grp,
                                                                );
                                                            @endphp
                                                            @if ($keratinisation_grpe != null)
                                                                <td>
                                                                    <b>KERATINISATION</b><br><br>
                                                                    @if (is_array($keratinisation_grpe))
                                                                        @foreach ($keratinisation_grpe as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $keratinisation_grpe }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $relief_grpe = json_decode($test->relief_grp);
                                                            @endphp
                                                            @if ($relief_grpe != null)
                                                                <td>
                                                                    <b>RELIEF</b><br><br>

                                                                    @if (is_array($relief_grpe))
                                                                        @foreach ($relief_grpe as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $relief_grpe }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @php
                                                                $elasticite_grpe = json_decode($test->elasticite_grp);
                                                            @endphp
                                                            @if ($elasticite_grpe != null)
                                                                <td>
                                                                    <b>ELASTICITE</b><br><br>

                                                                    @if (is_array($elasticite_grpe))
                                                                        @foreach ($elasticite_grpe as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $elasticite_grpe }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $follicule_grpe = json_decode($test->follicule_grp);
                                                            @endphp
                                                            @if ($follicule_grpe != null)
                                                                <td>
                                                                    <b>FOLLICULE</b><br><br>

                                                                    @if (is_array($follicule_grpe))
                                                                        @foreach ($follicule_grpe as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $follicule_grpe }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @php
                                                                $sensibilite_grpe = json_decode($test->sensibilite_grp);
                                                            @endphp
                                                            @if ($sensibilite_grpe != null)
                                                                <td>
                                                                    <b>SENSIBILITE</b><br><br>

                                                                    @if (is_array($sensibilite_grpe))
                                                                        @foreach ($sensibilite_grpe as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $sensibilite_grpe }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $circulation_grpe = json_decode($test->circulation_grp);
                                                            @endphp
                                                            @if ($circulation_grpe != null)
                                                                <td>
                                                                    <b>CIRCULATION</b><br><br>

                                                                    @if (is_array($circulation_grpe))
                                                                        @foreach ($circulation_grpe as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $circulation_grpe }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                        </tr>

                                                        {{-- ************* --}}

                                                        {{-- Diagnostic détail du Pied --}}

                                                        <tr>
                                                            @php
                                                                $signes_pieds = json_decode(
                                                                    $test->signes_particuliers_pieds,
                                                                );
                                                            @endphp
                                                            @if ($signes_pieds != null)
                                                                <td>
                                                                    <b>SIGNES PARTICULIERS DES PIEDS:</b><br><br>

                                                                    @if (is_array($signes_pieds))
                                                                        @foreach ($signes_pieds as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $signes_pieds }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @php
                                                                $signes_ongles_pieds = json_decode(
                                                                    $test->signes_particuliers_ongles_pieds,
                                                                );
                                                            @endphp
                                                            @if ($signes_ongles_pieds != null)
                                                                <td>
                                                                    <b>SIGNES PARTICULIERS DES ONGLES DU PIED :</b><br><br>

                                                                    @if (is_array($signes_ongles_pieds))
                                                                        @foreach ($signes_ongles_pieds as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $signes_ongles_pieds }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $soinList_pieds = json_decode($test->soinList_pied);
                                                            @endphp
                                                            @if ($soinList_pieds != null)
                                                                <td>
                                                                    <b>SOINS PREFERES:</b><br><br>

                                                                    @if (is_array($soinList_pieds))
                                                                        @foreach ($soinList_pieds as $signe)
                                                                            <label class="badge badge-primary-soft">
                                                                                {{ $signe }}
                                                                            </label>
                                                                        @endforeach
                                                                    @else
                                                                        {{ $soinList_pieds }}
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->Etat_generale_des_pieds != null)
                                                                <td>
                                                                    <b>ETAT GENERALE DE LA PEAU DES PIEDS:</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->Etat_generale_des_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->Etat_des_ongles_pieds != null)
                                                                <td>
                                                                    <b>ETATS DES ONGLES DU PIED:</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->Etat_des_ongles_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->vernisInput_pied != null)
                                                                <td>
                                                                    <b>VERNIS PREFERES:</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->vernisInput_pied }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->etat_pieds != null)
                                                                <td>
                                                                    <b>ETATS DE PEAU:</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->etat_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->taches_pieds != null)
                                                                <td>
                                                                    <b>TACHES SUR LES ONGLES:</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->taches_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->aureoles_pieds != null)
                                                                <td>
                                                                    <b>PRESENCE DES AUREOLES:</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->aureoles_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->veines_face_ext_pieds != null)
                                                                <td>
                                                                    <b>Veines visibles la face externe:</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->veines_face_ext_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->veines_face_int_pieds != null)
                                                                <td>
                                                                    <b>Veines visibles la face interne:</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->veines_face_int_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->douleur_talon_pieds != null)
                                                                <td>
                                                                    <b>DOULEURS PARTICULIÈRE DU TALON:</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->douleur_talon_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->spInput_pieds != null)
                                                                <td>
                                                                    <b>ETATS DES ONGLES:</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->spInput_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Aucun Diagnostic disponible.</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
