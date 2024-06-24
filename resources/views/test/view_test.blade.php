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
                                            <td class="text-center w-50">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        {{-- Diagnostic détail Main --}}
                                                        <tr class="form-group">
                                                            @if ($test->Etat_des_ongles_mains != null)
                                                                <td>
                                                                    <b>Etats des ongles</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->Etat_des_ongles_mains }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->Etat_generale_des_mains != null)
                                                                <td>
                                                                    <b>Etat générale des mains</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->Etat_generale_des_mains }}
                                                                    </label>
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
                                                                    <b>Signes particuliers des ongles
                                                                    </b><br><br>
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
                                                                $signes_mains = json_decode(
                                                                    $test->signes_particuliers_mains,
                                                                );
                                                            @endphp
                                                            @if ($signes_mains != null)
                                                                <td>
                                                                    <b>Signes particuliers des mains</b><br><br>
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
                                                            @if ($test->skinStateInput_main != null)
                                                                <td>
                                                                    <b>Etat de la peau</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->skinStateInput_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->vernisInput_main != null)
                                                                <td>
                                                                    <b>Vernis</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->vernisInput_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->reliefInput_main != null)
                                                                <td>
                                                                    <b>Relief</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->reliefInput_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->cicatrices_main != null)
                                                                <td>
                                                                    <b>Cicatrice</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->cicatrices_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @php
                                                                $soin_List_main = json_decode($test->soinList_main);
                                                            @endphp
                                                            @if ($soin_List_main != null)
                                                                <td>
                                                                    <b>Soins preferes
                                                                    </b><br><br>
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
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->callosites_main != null)
                                                                <td>
                                                                    <b>callosité(s)</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->callosites_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->spInput_main != null)
                                                                <td>
                                                                    <b>Signes particuliers</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->spInput_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->tache_main != null)
                                                                <td>
                                                                    <b>Tache(s)</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->tache_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->cicatrices_main_dorsal != null)
                                                                <td>
                                                                    <b>Présence des Cicatrices</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->cicatrices_main_dorsal }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->callosite_main_dorsal != null)
                                                                <td>
                                                                    <b>Espaces inter digitale</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->callosite_main_dorsal }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->spInput_main_dorsal != null)
                                                                <td>
                                                                    <b>Signes particuliers</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->spInput_main_dorsal }}
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
                                                                    <b class="text-center">Sébum</b><br><br>
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
                                                                    <b>Hydratation</b><br><br>

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
                                                            {{-- ************* --}}
                                                            @php
                                                                $relief_grpe = json_decode($test->relief_grp);
                                                            @endphp
                                                            @if ($relief_grpe != null)
                                                                <td>
                                                                    <b>Relief</b><br><br>

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
                                                                    <b>Signes Particuliers de la peau</b><br><br>
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
                                                            {{-- ************* --}}
                                                            @php
                                                                $keratinisation_grpe = json_decode(
                                                                    $test->keratinisation_grp,
                                                                );
                                                            @endphp
                                                            @if ($keratinisation_grpe != null)
                                                                <td>
                                                                    <b>Kératinisation</b><br><br>
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
                                                            {{-- ************* --}}
                                                            @php
                                                                $elasticite_grpe = json_decode($test->elasticite_grp);
                                                            @endphp
                                                            @if ($elasticite_grpe != null)
                                                                <td>
                                                                    <b>Elasticité</b><br><br>

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
                                                                    <b>Follicule</b><br><br>

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
                                                                    <b>Sensibilité</b><br><br>

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
                                                            {{-- ************* --}}
                                                            @php
                                                                $circulation_grpe = json_decode($test->circulation_grp);
                                                            @endphp
                                                            @if ($circulation_grpe != null)
                                                                <td>
                                                                    <b>Circulation</b><br><br>
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
                                                                    <b>Signes particuliers des pieds</b><br><br>

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
                                                            @if ($test->Etat_generale_des_pieds != null)
                                                                <td>
                                                                    <b>Etat genéral de la peau des pieds</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->Etat_generale_des_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->taches_pieds != null)
                                                                <td>
                                                                    <b>Tâches sur les ongles</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->taches_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->veines_face_int_pieds != null)
                                                                <td>
                                                                    <b>Veines visibles de la face interne</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->veines_face_int_pieds }}
                                                                    </label>
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
                                                                    <b>Soins préferés</b><br><br>
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
                                                            @if ($test->etat_pieds != null)
                                                                <td>
                                                                    <b>Etat de la peau</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->etat_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->veines_face_ext_pieds != null)
                                                                <td>
                                                                    <b>Veines visibles de la face externe</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->veines_face_ext_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ******************* --}}
                                                            @if ($test->Etat_des_ongles_pieds != null)
                                                                <td>
                                                                    <b>Etats des ongles du pied</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->Etat_des_ongles_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->vernisInput_pied != null)
                                                                <td>
                                                                    <b>Vernis preférés</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->vernisInput_pied }}
                                                                    </label>
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
                                                                    <b>Signes particuliers des ongles</b><br><br>

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
                                                            {{-- ************* --}}
                                                            @if ($test->douleur_talon_pieds != null)
                                                                <td>
                                                                    <b>Douleurs particulières du talon</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->douleur_talon_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($test->aureoles_pieds != null)
                                                                <td>
                                                                    <b>Présence des auréoles</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->aureoles_pieds }}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
