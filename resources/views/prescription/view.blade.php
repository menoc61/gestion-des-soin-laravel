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
                    <div class="col-md-12">
                        <center>
                            <div class="col-md-12">
                                @if (!empty(App\Setting::get_option('logo')))
                                    <img src="{{ asset('uploads/' . App\Setting::get_option('logo')) }}"
                                        class="img-fluid"><br><br>
                                @endif
                                {{-- {!! clean(App\Setting::get_option('header_left')) !!} --}}
                            </div>
                        </center>
                        <div class="">
                            <div class="text-center">
                                <b>{{ App\Setting::get_option('system_name') }}</b><br>
                                <b>{{ App\Setting::get_option('address') }}</b><br>
                                <b>{{ App\Setting::get_option('phone') }}</b><br>
                                <b>{{ App\Setting::get_option('hospital_email') }}</b>
                            </div>
                        </div>
                    </div>
                    <!-- END ROW : Doctor informations -->
                    <!-- ROW : Patient informations -->
                    <div class="row">
                        <div class="col">
                            <hr>
                            <div class="table-responsive">
                                <table class="table w-25 table-align-center">
                                    <tr>
                                        <td><b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @isset($prescription->User->Patient->birthday)
                                                <br><b>{{ __('sentence.Age') }} :</b>
                                                {{ $prescription->User->Patient->birthday }}
                                                ({{ \Carbon\Carbon::parse($prescription->User->Patient->birthday)->age }} ans)
                                            @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @isset($prescription->User->Patient->gender)
                                                <br><b>{{ __('sentence.Gender') }} :</b>
                                                {{ $prescription->User->Patient->gender }}
                                            @endisset
                                        </td>
                                    </tr>
                                    @isset($prescription->User->Patient->weight)
                                        <br><b>{{ __('sentence.Patient Weight') }} :</b>
                                        {{ $prescription->User->Patient->weight }}
                                        Kg
                                    @endisset
                                    @isset($prescription->User->Patient->height)
                                        <br><b>{{ __('sentence.Patient Height') }} :</b>
                                        {{ $prescription->User->Patient->height }}
                                    @endisset
                                </table>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <!-- END ROW : Patient informations -->
                    @if (count($prescription_tests) > 0)
                        <!-- ROW : Tests List -->
                        <div class="row justify-content-center">
                            <div class="col">
                                <strong><u>{{ __('sentence.Test to do') }} </u></strong><br><br>
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th class="text-center">Nom Diagnostic</th>
                                        <th class="text-center">Type Diagnostic</th>
                                        <th class="text-center">Description Diagnostic</th>
                                        <th class="text-center">Détail Diagnostic</th>
                                    </tr>
                                    @forelse ($prescription_tests as $tests)
                                        <tr>
                                            <td class="text-center">{{ $tests->Test->test_name }}</td>
                                            <td class="text-center">
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
                                            <td class="text-center">{{ $tests->Test->comment }}</td>
                                            <td class="text-center w-50">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        {{-- Diagnostic détail Main --}}
                                                        <tr class="form-group">
                                                            @if ($tests->Test->Etat_des_ongles_mains != null)
                                                                <td>
                                                                    <b>Etats des ongles</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->Etat_des_ongles_mains }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($tests->Test->Etat_generale_des_mains != null)
                                                                <td>
                                                                    <b>Etat générale des mains</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->Etat_generale_des_mains }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @php
                                                                $signes_ongles_mains = json_decode(
                                                                    $tests->Test->signes_particuliers_ongles_mains,
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
                                                                    $tests->Test->signes_particuliers_mains,
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
                                                            @if ($tests->Test->skinStateInput_main != null)
                                                                <td>
                                                                    <b>Etat de la peau</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->skinStateInput_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($tests->Test->vernisInput_main != null)
                                                                <td>
                                                                    <b>Vernis</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->vernisInput_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @if ($tests->Test->reliefInput_main != null)
                                                                <td>
                                                                    <b>Relief</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->reliefInput_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($tests->Test->cicatrices_main != null)
                                                                <td>
                                                                    <b>Cicatrice</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->cicatrices_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @php
                                                                $soin_List_main = json_decode(
                                                                    $tests->Test->soinList_main,
                                                                );
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
                                                            @if ($tests->Test->callosites_main != null)
                                                                <td>
                                                                    <b>callosité(s)</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->callosites_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($tests->Test->spInput_main != null)
                                                                <td>
                                                                    <b>Signes particuliers</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->spInput_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($tests->Test->tache_main != null)
                                                                <td>
                                                                    <b>Tache(s)</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->tache_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @if ($tests->Test->cicatrices_main_dorsal != null)
                                                                <td>
                                                                    <b>Présence des Cicatrices</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->cicatrices_main_dorsal }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($tests->Test->callosite_main_dorsal != null)
                                                                <td>
                                                                    <b>Espaces inter digitale</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->callosite_main_dorsal }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($tests->Test->spInput_main_dorsal != null)
                                                                <td>
                                                                    <b>Signes particuliers</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->spInput_main_dorsal }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}

                                                        {{-- Diagnostic détail de la Peau --}}

                                                        {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $sebum_grpe = json_decode($tests->Test->sebum_grp);
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
                                                                $hydratation_grpe = json_decode(
                                                                    $tests->Test->hydratation_grp,
                                                                );
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
                                                                $relief_grpe = json_decode($tests->Test->relief_grp);
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
                                                                    $tests->Test->signes_particuliers_peau,
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
                                                                    $tests->Test->keratinisation_grp,
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
                                                                $elasticite_grpe = json_decode(
                                                                    $tests->Test->elasticite_grp,
                                                                );
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
                                                                $follicule_grpe = json_decode(
                                                                    $tests->Test->follicule_grp,
                                                                );
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
                                                                $sensibilite_grpe = json_decode(
                                                                    $tests->Test->sensibilite_grp,
                                                                );
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
                                                                $circulation_grpe = json_decode(
                                                                    $tests->Test->circulation_grp,
                                                                );
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
                                                                    $tests->Test->signes_particuliers_pieds,
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
                                                            @if ($tests->Test->Etat_generale_des_pieds != null)
                                                                <td>
                                                                    <b>Etat genéral de la peau des pieds</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->Etat_generale_des_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($tests->Test->taches_pieds != null)
                                                                <td>
                                                                    <b>Tâches sur les ongles</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->taches_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($tests->Test->veines_face_int_pieds != null)
                                                                <td>
                                                                    <b>Veines visibles de la face interne</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->veines_face_int_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $soinList_pieds = json_decode(
                                                                    $tests->Test->soinList_pied,
                                                                );
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
                                                            @if ($tests->Test->etat_pieds != null)
                                                                <td>
                                                                    <b>Etat de la peau</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->etat_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($tests->Test->veines_face_ext_pieds != null)
                                                                <td>
                                                                    <b>Veines visibles de la face externe</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->veines_face_ext_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ******************* --}}
                                                            @if ($tests->Test->Etat_des_ongles_pieds != null)
                                                                <td>
                                                                    <b>Etats des ongles du pied</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->Etat_des_ongles_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @if ($tests->Test->vernisInput_pied != null)
                                                                <td>
                                                                    <b>Vernis preférés</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->vernisInput_pied }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @php
                                                                $signes_ongles_pieds = json_decode(
                                                                    $tests->Test->signes_particuliers_ongles_pieds,
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
                                                            @if ($tests->Test->douleur_talon_pieds != null)
                                                                <td>
                                                                    <b>Douleurs particulières du talon</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->douleur_talon_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                            @if ($tests->Test->aureoles_pieds != null)
                                                                <td>
                                                                    <b>Présence des auréoles</b><br><br>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $tests->Test->aureoles_pieds }}
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
        <div class="col-md-12">
            <center>
                <div class="col-md-12">
                    @if (!empty(App\Setting::get_option('logo')))
                        <img src="{{ asset('uploads/' . App\Setting::get_option('logo')) }}" class="img-fluid"><br><br>
                    @endif
                    {{-- {!! clean(App\Setting::get_option('header_left')) !!} --}}
                </div>
            </center>
            <div class="">
                <div class="text-center">
                    <b>{{ App\Setting::get_option('system_name') }}</b><br>
                    <b>{{ App\Setting::get_option('address') }}</b><br>
                    <b>{{ App\Setting::get_option('phone') }}</b><br>
                    <b>{{ App\Setting::get_option('hospital_email') }}</b>
                </div>
            </div>
        </div>
        <!-- END ROW : Doctor informations -->

        <!-- ROW : Patient informations -->
        <div class="row">
            <div class="col">
                <hr>
                <div class="table-responsive">
                    <table class="table w-25 table-align-center">
                        <tr>
                            <td><b>{{ __('sentence.Patient Name') }} :</b> {{ $prescription->User->name }}</td>
                        </tr>
                        <tr>
                            <td>
                                @isset($prescription->User->Patient->birthday)
                                    <br><b>{{ __('sentence.Age') }} :</b>
                                    {{ $prescription->User->Patient->birthday }}
                                    ({{ \Carbon\Carbon::parse($prescription->User->Patient->birthday)->age }} ans)
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @isset($prescription->User->Patient->gender)
                                    <br><b>{{ __('sentence.Gender') }} :</b>
                                    {{ $prescription->User->Patient->gender }}
                                @endisset
                            </td>
                        </tr>
                        @isset($prescription->User->Patient->weight)
                        <tr>
                            <td>
                                    <br><b>{{ __('sentence.Patient Weight') }} :</b>
                                    {{ $prescription->User->Patient->weight }}
                                    Kg
                            </td>
                        </tr>
                        @endisset
                        @isset($prescription->User->Patient->height)
                            <tr>
                                <td>
                                    <br><b>{{ __('sentence.Patient Height') }} :</b>
                                    {{ $prescription->User->Patient->height }}
                                </td>
                            </tr>
                        @endisset
                    </table>
                </div>
                <hr>
            </div>
        </div>
        <!-- END ROW : Patient informations -->
        @if (count($prescription_tests) > 0)
            <!-- ROW : Tests List -->
            <div class="row justify-content-center">
                <div class="col">
                    <strong><u>{{ __('sentence.Test to do') }} </u></strong><br><br>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th class="text-center">Nom Diagnostic</th>
                            <th class="text-center">Type Diagnostic</th>
                            <th class="text-center">Description Diagnostic</th>
                            <th class="text-center">Détail Diagnostic</th>
                        </tr>
                        @forelse ($prescription_tests as $tests)
                            <tr>
                                <td class="text-center">{{ $tests->Test->test_name }}</td>
                                <td class="text-center">
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
                                <td class="text-center">{{ $tests->Test->comment }}</td>
                                <td class="text-center w-50">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            {{-- Diagnostic détail Main --}}
                                            <tr class="form-group">
                                                @if ($tests->Test->Etat_des_ongles_mains != null)
                                                    <td>
                                                        <b>Etats des ongles</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->Etat_des_ongles_mains }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($tests->Test->Etat_generale_des_mains != null)
                                                    <td>
                                                        <b>Etat générale des mains</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->Etat_generale_des_mains }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $signes_ongles_mains = json_decode(
                                                        $tests->Test->signes_particuliers_ongles_mains,
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
                                                {{-- ************* --}}
                                                @if ($tests->Test->callosite_main_dorsal != null)
                                                    <td>
                                                        <b>Espaces inter digitale</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->callosite_main_dorsal }}
                                                        </label>
                                                    </td>
                                                @endif
                                            </tr>
                                            {{-- ************* --}}
                                            <tr>
                                                @php
                                                    $signes_mains = json_decode(
                                                        $tests->Test->signes_particuliers_mains,
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
                                                @if ($tests->Test->skinStateInput_main != null)
                                                    <td>
                                                        <b>Etat de la peau</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->skinStateInput_main }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($tests->Test->vernisInput_main != null)
                                                    <td>
                                                        <b>Vernis</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->vernisInput_main }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($tests->Test->spInput_main_dorsal != null)
                                                    <td>
                                                        <b>Signes particuliers</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->spInput_main_dorsal }}
                                                        </label>
                                                    </td>
                                                @endif
                                            </tr>
                                            {{-- ************* --}}
                                            <tr>
                                                @if ($tests->Test->reliefInput_main != null)
                                                    <td>
                                                        <b>Relief</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->reliefInput_main }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($tests->Test->cicatrices_main != null)
                                                    <td>
                                                        <b>Cicatrice</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->cicatrices_main }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $soin_List_main = json_decode($tests->Test->soinList_main);
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
                                                {{-- ************* --}}
                                                @if ($tests->Test->cicatrices_main_dorsal != null)
                                                    <td>
                                                        <b>Présence des Cicatrices</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->cicatrices_main_dorsal }}
                                                        </label>
                                                    </td>
                                                @endif
                                            </tr>
                                            {{-- ************* --}}
                                            <tr class="w-100">
                                                @if ($tests->Test->callosites_main != null)
                                                    <td>
                                                        <b>callosité(s)</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->callosites_main }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($tests->Test->spInput_main != null)
                                                    <td>
                                                        <b>Signes particuliers</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->spInput_main }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($tests->Test->tache_main != null)
                                                    <td>
                                                        <b>Tache(s)</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->tache_main }}
                                                        </label>
                                                    </td>
                                                @endif
                                            </tr>

                                            {{-- ************* --}}

                                            {{-- Diagnostic détail de la Peau --}}

                                            {{-- ************* --}}
                                            <tr>
                                                @php
                                                    $sebum_grpe = json_decode($tests->Test->sebum_grp);
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
                                                    $hydratation_grpe = json_decode($tests->Test->hydratation_grp);
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
                                                    $relief_grpe = json_decode($tests->Test->relief_grp);
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
                                                {{-- ************* --}}
                                                @php
                                                    $circulation_grpe = json_decode($tests->Test->circulation_grp);
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
                                            <tr>
                                                @php
                                                    $signe_peau = json_decode($tests->Test->signes_particuliers_peau);
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
                                                        $tests->Test->keratinisation_grp,
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
                                                    $elasticite_grpe = json_decode($tests->Test->elasticite_grp);
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
                                                {{-- ************* --}}
                                                @php
                                                    $sensibilite_grpe = json_decode($tests->Test->sensibilite_grp);
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
                                            </tr>
                                            {{-- ************* --}}
                                            {{-- <tr>
                                                @php
                                                    $follicule_grpe = json_decode($tests->Test->follicule_grp);
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
                                            </tr> --}}
                                            {{-- ************* --}}

                                            {{-- Diagnostic détail du Pied --}}

                                            <tr>
                                                @php
                                                    $signes_pieds = json_decode(
                                                        $tests->Test->signes_particuliers_pieds,
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
                                                @if ($tests->Test->Etat_generale_des_pieds != null)
                                                    <td>
                                                        <b>Etat genéral de la peau des pieds</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->Etat_generale_des_pieds }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($tests->Test->taches_pieds != null)
                                                    <td>
                                                        <b>Tâches sur les ongles</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->taches_pieds }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($tests->Test->veines_face_int_pieds != null)
                                                    <td>
                                                        <b>Veines visibles de la face interne</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->veines_face_int_pieds }}
                                                        </label>
                                                    </td>
                                                @endif
                                            </tr>
                                            {{-- ************* --}}
                                            <tr>
                                                @php
                                                    $soinList_pieds = json_decode($tests->Test->soinList_pied);
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
                                                @if ($tests->Test->etat_pieds != null)
                                                    <td>
                                                        <b>Etat de la peau</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->etat_pieds }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($tests->Test->veines_face_ext_pieds != null)
                                                    <td>
                                                        <b>Veines visibles de la face externe</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->veines_face_ext_pieds }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ******************* --}}
                                                @if ($tests->Test->Etat_des_ongles_pieds != null)
                                                    <td>
                                                        <b>Etats des ongles du pied</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->Etat_des_ongles_pieds }}
                                                        </label>
                                                    </td>
                                                @endif
                                            </tr>
                                            {{-- ************* --}}
                                            <tr>
                                                @if ($tests->Test->vernisInput_pied != null)
                                                    <td>
                                                        <b>Vernis preférés</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->vernisInput_pied }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ************* --}}
                                                @php
                                                    $signes_ongles_pieds = json_decode(
                                                        $tests->Test->signes_particuliers_ongles_pieds,
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
                                                @if ($tests->Test->douleur_talon_pieds != null)
                                                    <td>
                                                        <b>Douleurs particulières du talon</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->douleur_talon_pieds }}
                                                        </label>
                                                    </td>
                                                @endif
                                                {{-- ************* --}}
                                                @if ($tests->Test->aureoles_pieds != null)
                                                    <td>
                                                        <b>Présence des auréoles</b><br><br>
                                                        <label class="badge badge-primary-soft">
                                                            {{ $tests->Test->aureoles_pieds }}
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
