@extends('layouts.master')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-multiselect.css') }}">
@endsection

@section('title')
    {{ __('sentence.Add Test') }}
@endsection

@section('content')
    <div class="">
        <div class="mb-3">
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-12">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary text-center"> {{ __('sentence.Test') }} De
                        {{ $userName }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <form method="post" action="{{ route('test.store_id', ['id' => $userId]) }}">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        {{ __('sentence.Add Test') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <input type="hidden" class="form-control" value="{{ $userId }}"
                                            name="patient_id" readonly>
                                        {{ csrf_field() }}
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail3">{{ __('sentence.Test Name') }}<font color="red">*
                                                </font>
                                            </label>
                                            <input type="text" class="form-control" id="inputPassword2"
                                                value="{{ $userName }}" name="test_name" readonly>
                                            {{ csrf_field() }}
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword3">{{ __('sentence.Description') }}</label>
                                            <input type="text" class="form-control" id="inputPassword3" name="comment"
                                                placeholder="Entre une description correspondant au type de diagnostic sélectionné">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputSection">{{ __('sentence.Form Type') }}</label>
                                            <select multiple="multiple" class="form-control" id="inputSection"
                                                name="diagnostic_type[]">
                                                <option value="DIAGNOSE PEAU">DIAGNOSE PEAU</option>
                                                <option value="DIAGNOSE MAIN">DIAGNOSE MAIN</option>
                                                <option value="DIAGNOSE PIED">DIAGNOSE PIED</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <button type="submit"
                                                class="btn btn-success">{{ __('sentence.Save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <div class="form-group row" id="section-DIAGNOSE PEAU" style="display: none;">
                                <!-- Content for DIAGNOSE PEAU section -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            {{ __('sentence.skin diagnostic sheet') }}
                                        </h6>
                                    </div>
                                    <div class="card-body">

                                        <div class="form-group row">
                                            {{-- SEBUM --}}
                                            <div class="col-sm-6">
                                                <label for="SEBUM"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.SEBUM') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="sebum" class="form-control" multiple="multiple"
                                                        name="sebum_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger">Léger</option>
                                                            <option value="Normale">Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE"
                                                            disabled>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Grasse">Grasse</option>
                                                            <option value="Acnéique">Acnéique</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- HYDRATATION -->
                                            <div class="col-sm-6">
                                                <label for="HYDRATATION"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.HYDRATATION') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="hydratation" class="form-control" multiple="multiple"
                                                        name="hydratation_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger">Léger</option>
                                                            <option value="Normale">Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Sèche">Sèche</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Tiraillement">Tiraillement</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <!-- KERATINISATION -->
                                            <div class="col-sm-6">
                                                <label for="KERATINISATION"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.KERATINISATION') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="keratinisation" class="form-control" multiple="multiple"
                                                        name="keratinisation_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger">Léger</option>
                                                            <option value="Normale">Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Sèche">Sèche</option>
                                                            <option value="Desquamée">Desquamée</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Gerssures">Gerssures</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- FOLLICULE -->
                                            <div class="col-sm-6">
                                                <label for="FOLLICULE"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.FOLLICULE') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="follicule" class="form-control" multiple="multiple"
                                                        name="follicule_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger">Léger</option>
                                                            <option value="Normale">Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Faible">Faible</option>
                                                            <option value="Sèche">Sèche</option>
                                                            <option value="Desquamée">Desquamée</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE"
                                                            disabled>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <!-- RELIEF -->
                                            <div class="col-sm-6">
                                                <label for="RELIEF"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.RELIEF') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="relief" class="form-control" multiple="multiple"
                                                        name="relief_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger">Léger</option>
                                                            <option value="Normale">Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Fin">Fin</option>
                                                            <option value="Serré">Serré</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Pores dilatés">Pores dilatés</option>
                                                            <option value="Pores obstrués">Pores obstrués</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- ELASTICITE -->
                                            <div class="col-sm-6">
                                                <label for="ELASTICITE"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.ELASTICITE') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="elasticite" class="form-control" multiple="multiple"
                                                        name="elasticite_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger">Léger</option>
                                                            <option value="Normale">Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Faible">Faible</option>
                                                            <option value="Bonne">Bonne</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE"
                                                            disabled>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <!-- SENSIBILITE -->
                                            <div class="col-sm-6">
                                                <label for="SENSIBILITE"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.SENSIBILITE') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="sensibilite" class="form-control" multiple="multiple"
                                                        name="sensibilite_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger">Léger</option>
                                                            <option value="Normale">Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Sensible">Sensible</option>
                                                            <option value="Réactive">Réactive</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Hypersensibilité">Hypersensibilité</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- CIRCULATION -->
                                            <div class="col-sm-6">
                                                <label for="CIRCULATION"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.CIRCULATION') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="circulation" class="form-control" multiple="multiple"
                                                        name="circulation_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Régulière">Régulière</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Irrégulière">Irrégulière</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Plaques">Plaques</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="signes-particuliers-peau"
                                                class="col-sm-3 col-form-label">{{ __('sentence.SIGNES PARTICULIERS') }}</label>
                                            <div class="col-sm-9">
                                                <select id="signes-particuliers" class="form-control" multiple="multiple"
                                                    name="signes_particuliers_peau[]">
                                                    <option value="Points noirs">Points noirs</option>
                                                    <option value="Rosacée">Rosacée</option>
                                                    <option value="Rousseurs">Rousseurs</option>
                                                    <option value="Télangiectasie">Télangiectasie</option>
                                                    <option value="Pustules">Pustules</option>
                                                    <option value="Hypertrichose">Hypertrichose</option>
                                                    <option value="Pigmentations">Pigmentations</option>
                                                    <option value="Vitiligo">Vitiligo</option>
                                                    <option value="Cicatrice">Cicatrice</option>
                                                    <option value="Chéloïdes">Chéloïdes</option>
                                                    <option value="Comédons">Comédons</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="section-DIAGNOSE MAIN" style="display: none;">
                                <!-- Content for DIAGNOSE MAIN section -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            {{ __('sentence.hand diagnostic sheet') }}
                                        </h6>
                                    </div>
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="Etat-generale-des-mains"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.general hand state') }}</label>
                                                <div class="col-sm-12">
                                                    <select id="Etat-generale-des-mains" class="form-control"
                                                        name="Etat_generale_des_mains">
                                                        <option value="" disabled selected>Selectionner une option
                                                            ...
                                                        </option>
                                                        <option value="Normale">Normale</option>
                                                        <option value="Sèche">Sèche</option>
                                                        <option value="Très sèches">Très sèches</option>
                                                        <option value="Atrophiées">Atrophiées</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="Etat-des-ongles-mains"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.nail state') }}</label>
                                                <div class="col-sm-12">
                                                    <select id="Etat-des-ongles-mains" class="form-control"
                                                        name="Etat_des_ongles_mains">
                                                        <option value="" disabled selected>Selectionner une option
                                                            ...
                                                        </option>
                                                        <option value="Normaux">Normaux</option>
                                                        <option value="Dures">Dures</option>
                                                        <option value="Cassants">Cassants</option>
                                                        <option value="Fragiles">Fragiles</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="signes-particuliers-mains"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.particular type hand') }}</label>
                                                <div class="col-sm-12">
                                                    <select id="signes-particuliers" class="form-control"
                                                        multiple="multiple" name="signes_particuliers_mains[]">
                                                        <option value="Rousseurs">Rousseurs</option>
                                                        <option value="Pigmentation">Pigmentation</option>
                                                        <option value="Desquamations">Desquamations</option>
                                                        <option value="Cicatrices">Cicatrices</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="soin"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.soin') }}</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="soin" multiple="multiple"
                                                        name="soinList_main[]">
                                                        <option value="1">soin 1</option>
                                                        <option value="2">soin 2</option>
                                                        <option value="3">soin 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="vernis"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.vernis') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="vernis"
                                                        name="vernisInput_main">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="signes-particuliers-ongles-mains"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.finger state') }}</label>
                                                <div class="col-sm-12">
                                                    <select id="signes-particuliers-ongles" class="form-control"
                                                        multiple="multiple" name="signes_particuliers_ongles_mains[]">
                                                        <option value="Epais">Epais</option>
                                                        <option value="Décollés">Décollés</option>
                                                        <option value="Colorés">Colorés (jaunâtre, vert)</option>
                                                        <option value="Petites taches">Petites taches</option>
                                                        <option value="Fripés">Fripés</option>
                                                        <option value="Friables et poudreux">Friables et poudreux</option>
                                                        <option value="Striées">Striées</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <h5>FACE INTERNE</h5>

                                        <div class="form-group row">
                                            {{-- <div class="col-sm-4">
                                                <label for="relief"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.relief') }}</label>
                                                <input type="text" class="form-control" id="relief"
                                                    name="reliefInput_main">
                                            </div> --}}
                                            <div class="col-sm-4">
                                                <label for="relief"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.relief') }}</label>
                                                <input type="text" class="form-control"
                                                    name="reliefInput_main">
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="cicatrices-main"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.cicatrices') }}</label>
                                                <select class="form-control" id="cicatrices-main" name="cicatrices_main">
                                                    <option value="" disabled selected>Selectionner une option ...
                                                    </option>
                                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                                    <option value="non">{{ __('sentence.non') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="callosites-main"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.callosites') }}</label>
                                                <select class="form-control" id="callosites-main" name="callosites_main">
                                                    <option value="" disabled selected>Selectionner une option ...
                                                    </option>
                                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                                    <option value="non">{{ __('sentence.non') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-9">
                                                <label for="sp1"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.signe particulier') }}</label>
                                                <textarea type="text" class="form-control" id="sp1" name="spInput_main"></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <h5>FACE DORSALE</h5>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="skinState-main"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.etat de la peau') }}</label>
                                                <input type="text" class="form-control" id="skinState-main"
                                                    name="skinStateInput_main">
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="tache-main"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.taches') }}</label>
                                                <select class="form-control" id="tache-main" name="tache_main">
                                                    <option value="" disabled selected>Selectionner une option ...
                                                    </option>
                                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                                    <option value="non">{{ __('sentence.non') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="cicatrices-main-dorsal"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.cicatrices') }}</label>
                                                <select class="form-control" id="cicatrices-main-dorsal"
                                                    name="cicatrices_main_dorsal">
                                                    <option value="" disabled selected>Selectionner une option ...
                                                    </option>
                                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                                    <option value="non">{{ __('sentence.non') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="callosites-main-dorsal"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.espaces inter digitale') }}</label>
                                                <select class="form-control" id="callosites-main-dorsal"
                                                    name="callosite_main_dorsal">
                                                    <option value="" disabled selected>Selectionner une option ...
                                                    </option>
                                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                                    <option value="non">{{ __('sentence.non') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-8">
                                                <label for="sp2"
                                                    class="col-sm-12 col-form-label">{{ __('sentence.signe particulier') }}</label>
                                                <textarea type="text" class="form-control" id="sp2" name="spInput_main_dorsal"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="section-DIAGNOSE PIED" style="display: none;">
                                <!-- Content for DIAGNOSE PIED section -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            {{ __('sentence.foot diagnostic sheet') }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="Etat-generale-des-pied"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.general foot state') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="Etat-generale-des-pied" class="form-control"
                                                        name="Etat_generale_des_pieds">
                                                        <option value="" disabled selected>Selectionner une option ...
                                                        </option>
                                                        <option value="Normale">Normale</option>
                                                        <option value="Sèche">Sèche</option>
                                                        <option value="Très sèches">Très sèches</option>
                                                        <option value="Atrophiées">Atrophiées</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="Etat-des-ongles"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.nail state') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="Etat-des-ongles" class="form-control"
                                                        name="Etat_des_ongles_pieds">
                                                        <option value="" disabled selected>Selectionner une option ...
                                                        </option>
                                                        <option value="Normaux">Normaux</option>
                                                        <option value="Dures">Dures</option>
                                                        <option value="Cassants">Cassants</option>
                                                        <option value="Fragiles">Fragiles</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="signes-particuliers-mains"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.particular type foot') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="signes-particuliers" class="form-control "
                                                        multiple="multiple" name="signes_particuliers_pieds[]">
                                                        <option value="Rousseurs">Rousseurs</option>
                                                        <option value="Pigmentation">Pigmentation</option>
                                                        <option value="Desquamations">Desquamations</option>
                                                        <option value="Cicatrices">Cicatrices</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="signes-particuliers-ongles"
                                                    class="col-sm- col-form-label">{{ __('sentence.finger state') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="signes-particuliers-ongles" class="form-control"
                                                        multiple="multiple" name="signes_particuliers_ongles_pieds[]">
                                                        <option value="Epais">Epais</option>
                                                        <option value="Décollés">Décollés</option>
                                                        <option value="Colorés">Colorés (jaunâtre, vert)</option>
                                                        <option value="Petites taches">Petites taches</option>
                                                        <option value="Fripés">Fripés</option>
                                                        <option value="Friables et poudreux">Friables et poudreux
                                                        </option>
                                                        <option value="Striées">Striées</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="soin"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.soin') }}</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="soin" multiple="multiple"
                                                        name="soinList_pied[]">
                                                        <option value="1">soin 1</option>
                                                        <option value="2">soin 2</option>
                                                        <option value="3">soin 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="vernis"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.vernis') }}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="vernis"
                                                        name="vernisInput_pied">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="etat_pieds"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.general foot state') }}</label>
                                                <input type="text" class="form-control col-sm-9" id="etat_pieds"
                                                    name="etat_pieds">
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="cicatrices"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.taches foot') }}</label>
                                                <select class="form-control col-sm-9" id="cicatrices"
                                                    name="taches_pieds">
                                                    <option value="" disabled selected>Selectionner une option ...
                                                    </option>
                                                    <option value="oui">{{ __('oui') }}</option>
                                                    <option value="non">{{ __('non') }}</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="aureoles_pieds"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.aureoles') }}</label>
                                                <select class="form-control col-sm-9" id="aureoles_pieds"
                                                    name="aureoles_pieds">
                                                    <option value="" disabled selected>Selectionner une option ...
                                                    </option>
                                                    <option value="oui">{{ __('oui') }}</option>
                                                    <option value="non">{{ __('non') }}</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="veines_face_ext_pieds"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.veines face ext') }}</label>
                                                <select class="form-control col-sm-9" id="veines_face_ext_pieds"
                                                    name="veines_face_ext_pieds">
                                                    <option value="" disabled selected>Selectionner une option ...
                                                    </option>
                                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                                    <option value="non">{{ __('sentence.non') }}</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="veines_face_int_pieds"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.veines face int') }}</label>
                                                <select class="form-control col-sm-9" id="veines_face_int_pieds"
                                                    name="veines_face_int_pieds">
                                                    <option value="" disabled selected>Selectionner une option ...
                                                    </option>
                                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                                    <option value="non">{{ __('sentence.non') }}</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="douleur_talon_pieds"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.douleur talon') }}</label>
                                                <select class="form-control col-sm-9" id="douleur_talon_pieds"
                                                    name="douleur_talon_pieds">
                                                    <option value="" disabled selected>Selectionner une option ...
                                                    </option>
                                                    <option value="oui">{{ __('sentence.oui') }}</option>
                                                    <option value="non">{{ __('sentence.non') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-9">
                                                <label for="sp2"
                                                    class="col-sm-9 col-form-label">{{ __('sentence.signe particulier') }}</label>
                                                <textarea type="text" class="form-control" id="sp2" name="spInput_pieds"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('footer')
    <script type="text/javascript" defer>
        window.addEventListener('DOMContentLoaded', function() {
            var sections = document.querySelectorAll('.form-group.row[id^="section-"]');

            sections.forEach(function(section) {
                section.style.display = 'none';
            });

            document.getElementById('inputSection').addEventListener('change', function() {
                var selectedOptions = Array.from(this.selectedOptions).map(option => option.value);

                sections.forEach(function(section) {
                    if (selectedOptions.includes(section.id.replace('section-', ''))) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
            });
        });

        function updateTestName() {
            var patientSelect = document.getElementById('PatientID');
            var testNameInput = document.getElementById('test_name');

            // Get the selected option element
            var selectedOption = patientSelect.options[patientSelect.selectedIndex];

            // Get the patient's name from the data-name attribute of the selected option
            var patientName = selectedOption.getAttribute('data-name');

            // Update the test_name input field value with the selected patient's name
            testNameInput.value = "Diagnostic de Mr(s) - " + patientName;
        }
        document.getElementById('inputSection').addEventListener('change', function() {
            var selectedOptions = Array.from(this.selectedOptions).map(option => option.value);
            var descriptionInput = document.getElementById('inputPassword3');
            var descriptions = {
                'DIAGNOSE PEAU': 'DIAGNOSE PEAU',
                'DIAGNOSE MAIN': 'DIAGNOSE MAIN',
                'DIAGNOSE PIED': 'DIAGNOSE PIED'
            };

            var selectedDescriptions = selectedOptions.map(option => descriptions[option]);

            descriptionInput.value = selectedDescriptions.join(', ');
        });
        var defaultInputValue = document.getElementById('inputPassword2').defaultValue;
        var selectedOption = defaultInputValue;
        var selectedValues = [];

        document.getElementById('inputSection').addEventListener('change', function() {
            var newSelectedOption = this.value;
            var descriptionInput = document.getElementById('inputPassword2');

            // Mettre à jour la valeur du selectedOption en fonction de la sélection de l'utilisateur
            selectedOption = newSelectedOption + ' ' + defaultInputValue;

            // Mettre à jour la valeur de l'input
            descriptionInput.value = selectedOption;
        });
    </script>

    <script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    {{-- <script type="text/javascript">
        $('#inputSection').multiselect();
    </script> --}}
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
        $('#signes-particuliers,#signes-particuliers-ongles,#soin,#PatientID').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            enableResetButton: true,
            nonSelectedText: 'sélectionnez une option',
            filterPlaceholder: 'Recherche un Hôte...',
            buttonContainer: '<div class="btn-group w-100" />'
        });
    </script>
    <script type="text/javascript">
        $('#sebum,#hydratation,#keratinisation,#follicule,#relief,#elasticite,#sensibilite,#circulation').multiselect({
            enableFiltering: true,
            enableResetButton: true,
            enableCollapsibleOptGroups: true,
            nonSelectedText: 'sélectionnez une option',
            filterPlaceholder: 'Rechercher une option...',
            buttonContainer: '<div class="btn-group w-100" />'
        });
    </script>
@endsection
