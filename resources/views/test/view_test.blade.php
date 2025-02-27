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
                                @forelse ($tests as $test)
                                  @if(is_array(json_decode($test->diagnostic_type, true)) && in_array("PSYCHOTHERAPIE", json_decode($test->diagnostic_type, true)))
                                    <tr>
                                        <th class="text-center">Nom du Diagnose</th>
                                        <th class="text-center">Type du Diagnose</th>
                                        <!-- <th class="text-center">Description Diagnostic</th> -->
                                        <!-- <th class="text-center">élements de diagnose</th> -->
                                        <th class="text-center">Observations :</th>
                                    </tr>
                                    
                                   
                                    <tr>
                                        <td class="text-center" rowspan="15">{{ $test->test_name }}</td>
                                        <td class="text-center" rowspan="15">
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
                                       <!-- <td>Observations :</td> -->
                                       <td class="text-center">{{ strip_tags($test->comment) }}</td>
                                   </tr>
                                   @else
                                      <tr>
                                            <th class="text-center">Nom du Diagnose</th>
                                            <th class="text-center">Type du Diagnose</th>
                                        <!-- <th class="text-center">Description Diagnostic</th> -->
                                            <th class="text-center">élements de diagnose</th>
                                            <th class="text-center">Réponses</th>
                                      </tr>
                                        <tr>
                                            <td class="text-center" rowspan="15">{{ $test->test_name }}</td>
                                            <td class="text-center" rowspan="15">
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
                                            
                                            <!-- <td class="text-center">{{ $test->comment }}</td> -->
                                            <!-- <td class="text-center"> -->
                                                <!-- <div class="table-responsive"> -->
                                                    <!-- <table class="table table-bordered"> -->
                                                        {{-- Diagnostic détail Main --}}
                                                        <!-- <tr class="form-group"> -->
                                                            @if ($test->Etat_des_ongles_mains != null)
                                                                <td>
                                                                    <p>Etats des ongles</p>
                                                                </td>
                                                            @endif
                                                            @if ($test->Etat_des_ongles_mains != null)
                                                                <td>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->Etat_des_ongles_mains }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                       </tr>
                                                            {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->Etat_generale_des_mains != null)
                                                                <td>
                                                                    <p>Etat générale des mains</p>   
                                                                </td>
                                                            @endif
                                                            @if ($test->Etat_generale_des_mains != null)
                                                                <td>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->Etat_generale_des_mains }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            </tr>
                                                            {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $signes_ongles_mains = json_decode(
                                                                    $test->signes_particuliers_ongles_mains,
                                                                );
                                                            @endphp
                                                            @if ($signes_ongles_mains !== null)
                                                                <td>
                                                                    <p>Signes particuliers des ongles</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($signes_ongles_mains !== null)
                                                                <td>
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
                                                                    <p>Signes particuliers des mains</p>  
                                                                </td>
                                                            @endif
                                                            @if ($signes_mains != null)
                                                                <td>
                                                                   
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
                                                        </tr>
                                                            {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->skinStateInput_main != null)
                                                                <td>
                                                                    <p>Etat de la peau</p>
                                                                </td>
                                                            @endif
                                                            @if ($test->skinStateInput_main != null)
                                                                <td>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->skinStateInput_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                            {{-- ************* --}}
                                                        </tr>
                                                        <tr>
                                                            @if ($test->vernisInput_main != null)
                                                                <td>
                                                                    <p>Vernis</p>
                                                                   
                                                                </td>
                                                            @endif
                                                            @if ($test->vernisInput_main != null)
                                                                <td>
                                                                    
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
                                                                    <p>Relief</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($test->reliefInput_main != null)
                                                                <td>
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->reliefInput_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            {{-- ************* --}}
                                                            @if ($test->cicatrices_main != null)
                                                                <td>
                                                                    <p>Cicatrice</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($test->cicatrices_main != null)
                                                                <td>
                                                                    
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->cicatrices_main }}
                                                                    </label>
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
                                                                    <p>Soins preferes</p>
                                                                   
                                                                </td>
                                                            @endif
                                                            @if ($soin_List_main != null)
                                                                <td>
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
                                                                    <p>callosité(s)</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($test->callosites_main != null)
                                                                <td>
                                                                    
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->callosites_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                            {{-- ************* --}}

                                                        <tr>
                                                            @if ($test->spInput_main != null)
                                                                <td>
                                                                    <p>Signes particuliers</p>
                                                                   
                                                                </td>
                                                            @endif
                                                            @if ($test->spInput_main != null)
                                                                <td>
                                                                    
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->spInput_main }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                            {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->tache_main != null)
                                                                <td>
                                                                    <p>Tache(s)</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($test->tache_main != null)
                                                                <td>
                                                                    
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
                                                                    <p>Présence des Cicatrices</p>  
                                                                </td>
                                                            @endif
                                                            @if ($test->cicatrices_main_dorsal != null)
                                                                <td>
                                                                    
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->cicatrices_main_dorsal }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                            {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->callosite_main_dorsal != null)
                                                                <td>
                                                                    <p>Espaces inter digitale</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($test->callosite_main_dorsal != null)
                                                                <td>
                                                                    
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->callosite_main_dorsal }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            {{-- ************* --}}
                                                            @if ($test->spInput_main_dorsal != null)
                                                                <td>
                                                                    <p>Signes particuliers</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($test->spInput_main_dorsal != null)
                                                                <td>
                                                                    
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
                                                        <td class="text-center" rowspan="21"></td>
                                                       <td class="text-center" rowspan="21">
                                                            <!-- décoder sous le format json-->
                                                        
                                                       </td>
                                                            @php
                                                                $sebum_grpe = json_decode($test->sebum_grp);
                                                            @endphp
                                                            @if ($sebum_grpe != null)
                                                                <td>
                                                                    <p>Sébum</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($sebum_grpe != null)
                                                                <td>
                                                                   
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
                                                        </tr>
                                                        <tr>
                                                            {{-- ************* --}}
                                                            @php
                                                                $hydratation_grpe = json_decode($test->hydratation_grp);
                                                            @endphp
                                                            @if ($hydratation_grpe != null)
                                                                <td>
                                                                    <p>Hydratation</p>   
                                                                </td>
                                                            @endif
                                                            @if ($hydratation_grpe != null)
                                                                <td>
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
                                                                $relief_grpe = json_decode($test->relief_grp);
                                                            @endphp
                                                            @if ($relief_grpe != null)
                                                                <td>
                                                                    <p>Relief</p>
                                                                </td>
                                                            @endif
                                                            @if ($relief_grpe != null)
                                                                <td>
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
                                                                    <p>Signes Particuliers de la peau</p>
                                                                   
                                                                </td>
                                                            @endif
                                                            @if ($signe_peau != null)
                                                                <td>
                                                                    
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
                                                        </tr>
                                                            {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $keratinisation_grpe = json_decode(
                                                                    $test->keratinisation_grp,
                                                                );
                                                            @endphp
                                                            @if ($keratinisation_grpe != null)
                                                                <td>
                                                                    <p>Kératinisation</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($keratinisation_grpe != null)
                                                                <td>
                                                                    
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
                                                                $elasticite_grpe = json_decode($test->elasticite_grp);
                                                            @endphp
                                                            @if ($elasticite_grpe != null)
                                                                <td>
                                                                    <p>Elasticité</p>
                                                                </td>
                                                            @endif
                                                            @if ($elasticite_grpe != null)
                                                                <td>

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
                                                                    <p>Follicule</p>
                                                                </td>
                                                            @endif
                                                            @if ($follicule_grpe != null)
                                                                <td>
                                            

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
                                                        </tr>
                                                            {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $sensibilite_grpe = json_decode($test->sensibilite_grp);
                                                            @endphp
                                                            @if ($sensibilite_grpe != null)
                                                                <td>
                                                                    <p>Sensibilité</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($sensibilite_grpe != null)
                                                                <td>
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
                                                                    <p>Circulation</p>
                                                                   
                                                                </td>
                                                            @endif
                                                            @if ($circulation_grpe != null)
                                                                <td>
                                                                    
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
                                                                    <p>Signes particuliers des pieds</p>

                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($signes_pieds != null)
                                                                <td>
                                                                    

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
                                                        </tr>
                                                            {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->Etat_generale_des_pieds != null)
                                                                <td>
                                                                    <p>Etat genéral de la peau des pieds</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($test->Etat_generale_des_pieds != null)
                                                                <td>
                                                                   
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->Etat_generale_des_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                            {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->taches_pieds != null)
                                                                <td>
                                                                    <p>Tâches sur les ongles</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($test->taches_pieds != null)
                                                                <td>
                                                                    
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->taches_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                            {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->veines_face_int_pieds != null)
                                                                <td>
                                                                    <p>Veines visibles de la face interne</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($test->veines_face_int_pieds != null)
                                                                <td>
                                                                    
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
                                                                    <p>Soins préferés</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($soinList_pieds != null)
                                                                <td>
                                                                   
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
                                                        </tr>
                                                            {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->etat_pieds != null)
                                                                <td>
                                                                    <p>Etat de la peau</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($test->etat_pieds != null)
                                                                <td>
                                                                    
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->etat_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->veines_face_ext_pieds != null)
                                                                <td>
                                                                    <p>Veines visibles de la face externe</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($test->veines_face_ext_pieds != null)
                                                                <td>
                                                                   
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->veines_face_ext_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                            {{-- ******************* --}}
                                                        <tr>
                                                            @if ($test->Etat_des_ongles_pieds != null)
                                                                <td>
                                                                    <p>Etats des ongles du pied</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($test->Etat_des_ongles_pieds != null)
                                                                <td>
                                                                    
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
                                                                    <p>Vernis preférés</p>
                                                                    
                                                                </td>
                                                            @endif
                                                            @if ($test->vernisInput_pied != null)
                                                                <td>
                                                                    
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->vernisInput_pied }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                            {{-- ************* --}}
                                                        <tr>
                                                            @php
                                                                $signes_ongles_pieds = json_decode(
                                                                    $test->signes_particuliers_ongles_pieds,
                                                                );
                                                            @endphp
                                                            @if ($signes_ongles_pieds != null)
                                                                <td>
                                                                    <p>Signes particuliers des ongles</p>
                                                                </td>
                                                            @endif
                                                            @if ($signes_ongles_pieds != null)
                                                                <td>
                                                                    
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
                                                            @if ($test->douleur_talon_pieds != null)
                                                                <td>
                                                                    <p>Douleurs particulières du talon</p>
                                                                   
                                                                </td>
                                                            @endif
                                                            @if ($test->douleur_talon_pieds != null)
                                                                <td>
                                                                    
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->douleur_talon_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                            {{-- ************* --}}
                                                        <tr>
                                                            @if ($test->aureoles_pieds != null)
                                                                <td>
                                                                    <p>Présence des auréoles</p>
                                                                   
                                                                </td>
                                                            @endif
                                                            @if ($test->aureoles_pieds != null)
                                                                <td>
                                                                    
                                                                    <label class="badge badge-primary-soft">
                                                                        {{ $test->aureoles_pieds }}
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        </tr>
                                        @endif
                                                    
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
