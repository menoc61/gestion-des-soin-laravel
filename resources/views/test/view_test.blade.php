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
                                @forelse ($tests as $test)
                                    <tr>
                                        <td>{{ $test->test_name }}</td>
                                        <td>
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
                                        <td>{{ $test->comment }}</td>
                                        <td>
                                            <table class="w-100">

                                                {{-- Diagnostic détail Main --}}

                                                @if ($test->Etat_des_ongles_mains != null)
                                                    <tr>
                                                        <td>
                                                            <b>ETATS DES ONGLES DE LA MAIN:</b>
                                                            <label class="badge badge-primary-soft">
                                                                {{ $test->Etat_des_ongles_mains }}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($test->Etat_generale_des_mains != null)
                                                    <tr>
                                                        <td>
                                                            <b>ETAT GÉNÉRALE DES MAINS:</b>
                                                            <label class="badge badge-primary-soft">
                                                                {{ $test->Etat_generale_des_mains }}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $signes_mains = json_decode($test->signes_particuliers_mains);
                                                @endphp
                                                @if ($signes_mains != null)
                                                    <tr>

                                                        <td>
                                                            <b>SIGNES PARTICULIERS DES MAINS :</b>
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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $signes_ongles_mains = json_decode($test->signes_particuliers_ongles_mains);
                                                @endphp
                                                @if ($signes_ongles_mains !== null)
                                                    <tr>
                                                        <td>
                                                            <b>SIGNES PARTICULIERS DES ONGLES DE LA MAIN :</b>
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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $soin_List_main = json_decode($test->soinList_main);
                                                @endphp
                                                @if ($soin_List_main != null)
                                                    <tr>
                                                        <td>
                                                            <b>SOINS PREFERES :</b>
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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($test->vernisInput_main != null)
                                                    <tr>
                                                        <td>
                                                            <b>VERNIS PREFERE :</b>
                                                            <label class="badge badge-primary-soft">
                                                                {{ $test->vernisInput_main }}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}

                                                {{-- Diagnostic détail de la Peau --}}

                                                @php
                                                    $signe_peau = json_decode($test->signes_particuliers_peau);
                                                @endphp
                                                @if ($signe_peau != null)
                                                    <tr>
                                                        <td>
                                                            <b>SIGNES PARTICULIERS DE LA PEAU :</b>

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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $sebum_grpe = json_decode($test->sebum_grp);
                                                @endphp
                                                @if ($sebum_grpe != null)
                                                    <tr>
                                                        <td>
                                                            <b>SEBUM:</b>

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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $hydratation_grpe = json_decode($test->hydratation_grp);
                                                @endphp
                                                @if ($hydratation_grpe != null)
                                                    <tr>
                                                        <td>
                                                            <b>HYDRATATION:</b>

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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $keratinisation_grpe = json_decode($test->keratinisation_grp);
                                                @endphp
                                                @if ($keratinisation_grpe != null)
                                                    <tr>
                                                        <td>
                                                            <b>KERATINISATION:</b>

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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $follicule_grpe = json_decode($test->follicule_grp);
                                                @endphp
                                                @if ($follicule_grpe != null)
                                                    <tr>
                                                        <td>
                                                            <b>FOLLICULE:</b>

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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $relief_grpe = json_decode($test->relief_grp);
                                                @endphp
                                                @if ($relief_grpe != null)
                                                    <tr>
                                                        <td>
                                                            <b>RELIEF:</b>

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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $elasticite_grpe = json_decode($test->elasticite_grp);
                                                @endphp
                                                @if ($elasticite_grpe != null)
                                                    <tr>
                                                        <td>
                                                            <b>ELASTICITE:</b>

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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $sensibilite_grpe = json_decode($test->sensibilite_grp);
                                                @endphp
                                                @if ($sensibilite_grpe != null)
                                                    <tr>
                                                        <td>
                                                            <b>SENSIBILITE:</b>

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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $circulation_grpe = json_decode($test->circulation_grp);
                                                @endphp
                                                @if ($circulation_grpe != null)
                                                    <tr>
                                                        <td>
                                                            <b>CIRCULATION:</b>

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
                                                    </tr>
                                                @endif

                                                {{-- ************* --}}

                                                {{-- Diagnostic détail du Pied --}}

                                                @php
                                                    $signes_pieds = json_decode($test->signes_particuliers_pieds);
                                                @endphp
                                                @if ($signes_pieds != null)
                                                    <tr>
                                                        <td>
                                                            <b>SIGNES PARTICULIERS DES PIEDS:</b>

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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $signes_ongles_pieds = json_decode($test->signes_particuliers_ongles_pieds);
                                                @endphp
                                                @if ($signes_ongles_pieds != null)
                                                    <tr>
                                                        <td>
                                                            <b>SIGNES PARTICULIERS DES ONGLES DU PIED :</b>

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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $soinList_pieds = json_decode($test->soinList_pied);
                                                @endphp
                                                @if ($soinList_pieds != null)
                                                    <tr>
                                                        <td>
                                                            <b>SOINS PREFERES:</b>

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
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($test->Etat_generale_des_pieds != null)
                                                    <tr>
                                                        <td>
                                                            <b>ETAT GENERALE DE LA PEAU DES PIEDS:</b>
                                                            <label class="badge badge-primary-soft">
                                                                {{ $test->Etat_generale_des_pieds }}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($test->Etat_des_ongles_pieds != null)
                                                    <tr>
                                                        <td>
                                                            <b>ETATS DES ONGLES DU PIED:</b>
                                                            <label class="badge badge-primary-soft">
                                                                {{ $test->Etat_des_ongles_pieds }}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($test->vernisInput_pied != null)
                                                    <tr>
                                                        <td>
                                                            <b>VERNIS PREFERES:</b>
                                                            <label class="badge badge-primary-soft">
                                                                {{ $test->vernisInput_pied }}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($test->etat_pieds != null)
                                                    <tr>
                                                        <td>
                                                            <b>ETATS DE PEAU:</b>
                                                            <label class="badge badge-primary-soft">
                                                                {{ $test->etat_pieds }}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($test->taches_pieds != null)
                                                    <tr>
                                                        <td>
                                                            <b>TACHES SUR LES ONGLES:</b>
                                                            <label class="badge badge-primary-soft">
                                                                {{ $test->taches_pieds }}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($test->aureoles_pieds != null)
                                                    <tr>
                                                        <td>
                                                            <b>PRESENCE DES AUREOLES:</b>
                                                            <label class="badge badge-primary-soft">
                                                                {{ $test->aureoles_pieds }}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($test->veines_face_ext_pieds != null)
                                                    <tr>
                                                        <td>
                                                            <b>Veines visibles la face externe:</b>
                                                            <label class="badge badge-primary-soft">
                                                                {{ $test->veines_face_ext_pieds }}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($test->veines_face_int_pieds != null)
                                                    <tr>
                                                        <td>
                                                            <b>Veines visibles la face interne:</b>
                                                            <label class="badge badge-primary-soft">
                                                                {{ $test->veines_face_int_pieds }}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($test->douleur_talon_pieds != null)
                                                    <tr>
                                                        <td>
                                                            <b>DOULEURS PARTICULIÈRE DU TALON:</b>
                                                            <label class="badge badge-primary-soft">
                                                                {{ $test->douleur_talon_pieds }}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($test->spInput_pieds != null)
                                                    <tr>
                                                        <td>
                                                            <b>ETATS DES ONGLES:</b>
                                                            <label class="badge badge-primary-soft">
                                                                {{ $test->spInput_pieds }}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </table>
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
