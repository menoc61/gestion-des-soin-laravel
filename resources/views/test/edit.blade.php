@extends('layouts.master')

@section('title')
    {{ __('sentence.Edit Test') }}
@endsection

@section('content')
    <div class="toast" id="myToast" data-delay="5000" style="position: absolute; top: 0; right: 0; z-index: 1">
        <div class="toast-header bg-primary text-white">
            <strong class="mr-auto ">Remark :</strong>
            <small class="text-muted">a l'instant</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
        </div>
        <div class="toast-body">
            Rappelez-vous de toujours sélectionner à nouveau le type de diagnostic, sinon vous obtiendrez un message
            d'erreur.
        </div>
    </div>

    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Edit Test') }}</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('test.store_edit') }}">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">{{ __('sentence.Test Name') }}<font
                                    color="red">*</font></label>
                            {{-- <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail3" name="test_name"
                                    value="{{ $test->test_name }}">
                                {{ csrf_field() }}
                            </div> --}}
                            <div class="col-sm-9 input-group">
                                <select class="input-group-text" name="patient_id" id="PatientID" required
                                    aria-placeholder="{{ __('sentence.Select Patient') }}" onchange="updateTestName()">
                                    <option @readonly(true)>{{ __('sentence.Select Patient') }}</option>
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}" data-name="{{ $patient->name }}">
                                            {{ $patient->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control" id="inputEmail3" name="test_name"
                                    value="{{ $test->test_name }}" readonly>
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3"
                                class="col-sm-3 col-form-label">{{ __('sentence.Description') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputPassword3" name="comment"
                                    value="{{ $test->comment }}" placeholder="Aucune description trouvée ">
                                <input type="hidden" name="test_id" value="{{ $test->id }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputSection"
                                class="col-sm-3 col-form-label">{{ __('sentence.Form Type') }}</label>
                            <div class="col-sm-9">
                                <select multiple="multiple" class="form-control" id="inputSection" name="diagnostic_type[]">
                                    @foreach (['DIAGNOSE PEAU', 'DIAGNOSE MAIN', 'DIAGNOSE PIED'] as $option)
                                        <option value="{{ $option }}"
                                            {{ in_array($option, json_decode($test->diagnostic_type)) ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @foreach (json_decode($test->diagnostic_type) as $diagnosticType)
                            <div class="form-group row" id="section-{{ $diagnosticType }}" style="display: block;">
                                @if ($diagnosticType === 'DIAGNOSE PEAU')
                                    <!-- Content for DIAGNOSE PEAU section -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">
                                                {{ __('sentence.skin diagnostic sheet') }}
                                            </h6>
                                        </div>
                                        <!-- Rest of the content -->
                                        <div class="card-body">
                                            {{-- SEBUM --}}
                                            <div class="form-group row">
                                                <label for="SEBUM"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.SEBUM') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="sebum" class="form-control" multiple="multiple"
                                                        name="sebum_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                {{ in_array('Léger', json_decode($test->sebum_grp) ?: []) ? 'selected' : '' }}>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                {{ in_array('Normale', json_decode($test->sebum_grp) ?: []) ? 'selected' : '' }}>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE"
                                                            disabled>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Grasse"
                                                                {{ in_array('Grasse', json_decode($test->sebum_grp) ?: []) ? 'selected' : '' }}>
                                                                Grasse</option>
                                                            <option value="Acnéique"
                                                                {{ in_array('Acnéique', json_decode($test->sebum_grp) ?: []) ? 'selected' : '' }}>
                                                                Acnéique</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- HYDRATATION -->
                                            <div class="form-group row">
                                                <label for="HYDRATATION"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.HYDRATATION') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="hydratation" class="form-control" multiple="multiple"
                                                        name="hydratation_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                {{ in_array('Léger', json_decode($test->hydratation_grp) ?: []) ? 'selected' : '' }}>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                {{ in_array('Normale', json_decode($test->hydratation_grp) ?: []) ? 'selected' : '' }}>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Sèche"
                                                                {{ in_array('Sèche', json_decode($test->hydratation_grp) ?: []) ? 'selected' : '' }}>
                                                                Sèche</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Tiraillement"
                                                                {{ in_array('Tiraillement', json_decode($test->hydratation_grp) ?: []) ? 'selected' : '' }}>
                                                                Tiraillement</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- KERATINISATION -->
                                            <div class="form-group row">
                                                <label for="KERATINISATION"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.KERATINISATION') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="keratinisation" class="form-control" multiple="multiple"
                                                        name="keratinisation_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                {{ in_array('Léger', json_decode($test->keratinisation_grp) ?: []) ? 'selected' : '' }}>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                {{ in_array('Normale', json_decode($test->keratinisation_grp) ?: []) ? 'selected' : '' }}>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Sèche"
                                                                {{ in_array('Sèche', json_decode($test->keratinisation_grp) ?: []) ? 'selected' : '' }}>
                                                                Sèche</option>
                                                            <option value="Desquamée"
                                                                {{ in_array('Desquamée', json_decode($test->keratinisation_grp) ?: []) ? 'selected' : '' }}>
                                                                Desquamée</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Gerssures"
                                                                {{ in_array('Gerssures', json_decode($test->keratinisation_grp) ?: []) ? 'selected' : '' }}>
                                                                Gerssures</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- FOLLICULE -->
                                            <div class="form-group row">
                                                <label for="FOLLICULE"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.FOLLICULE') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="follicule" class="form-control" multiple="multiple"
                                                        name="follicule_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                {{ in_array('Léger', json_decode($test->follicule_grp) ?: []) ? 'selected' : '' }}>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                {{ in_array('Normale', json_decode($test->follicule_grp) ?: []) ? 'selected' : '' }}>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Faible"
                                                                {{ in_array('Faible', json_decode($test->follicule_grp) ?: []) ? 'selected' : '' }}>
                                                                Faible</option>
                                                            <option value="Sèche"
                                                                {{ in_array('Sèche', json_decode($test->follicule_grp) ?: []) ? 'selected' : '' }}>
                                                                Sèche</option>
                                                            <option value="Desquamée"
                                                                {{ in_array('Desquamée', json_decode($test->follicule_grp) ?: []) ? 'selected' : '' }}>
                                                                Desquamée</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE"
                                                            disabled></optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- RELIEF -->
                                            <div class="form-group row">
                                                <label for="RELIEF"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.RELIEF') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="relief" class="form-control" multiple="multiple"
                                                        name="relief_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                {{ in_array('Léger', json_decode($test->relief_grp) ?: []) ? 'selected' : '' }}>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                {{ in_array('Normale', json_decode($test->relief_grp) ?: []) ? 'selected' : '' }}>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Fin"
                                                                {{ in_array('Fin', json_decode($test->relief_grp) ?: []) ? 'selected' : '' }}>
                                                                Fin</option>
                                                            <option value="Serré"
                                                                {{ in_array('Serré', json_decode($test->relief_grp) ?: []) ? 'selected' : '' }}>
                                                                Serré</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Pores dilatés"
                                                                {{ in_array('Pores dilatés', json_decode($test->relief_grp)) ? 'selected' : '' }}>
                                                                Pores dilatés</option>
                                                            <option value="Pores obstrués"
                                                                {{ in_array('Pores obstrués', json_decode($test->relief_grp) ?: []) ? 'selected' : '' }}>
                                                                Pores obstrués</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- ELASTICITE -->
                                            <div class="form-group row">
                                                <label for="ELASTICITE"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.ELASTICITE') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="elasticite" class="form-control" multiple="multiple"
                                                        name="elasticite_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                {{ in_array('Léger', json_decode($test->elasticite_grp) ?: []) ? 'selected' : '' }}>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                {{ in_array('Normale', json_decode($test->elasticite_grp) ?: []) ? 'selected' : '' }}>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Faible"
                                                                {{ in_array('Faible', json_decode($test->elasticite_grp) ?: []) ? 'selected' : '' }}>
                                                                Faible</option>
                                                            <option value="Bonne"
                                                                {{ in_array('Bonne', json_decode($test->elasticite_grp) ?: []) ? 'selected' : '' }}>
                                                                Bonne</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE"
                                                            disabled></optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- SENSIBILITE -->
                                            <div class="form-group row">
                                                <label for="SENSIBILITE"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.SENSIBILITE') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="sensibilite" class="form-control" multiple="multiple"
                                                        name="sensibilite_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                {{ in_array('Léger', json_decode($test->sensibilite_grp) ?: []) ? 'selected' : '' }}>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                {{ in_array('Normale', json_decode($test->sensibilite_grp) ?: []) ? 'selected' : '' }}>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Sensible"
                                                                {{ in_array('Sensible', json_decode($test->sensibilite_grp) ?: []) ? 'selected' : '' }}>
                                                                Sensible</option>
                                                            <option value="Réactive"
                                                                {{ in_array('Réactive', json_decode($test->sensibilite_grp) ?: []) ? 'selected' : '' }}>
                                                                Réactive</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Hypersensibilité"
                                                                {{ in_array('Hypersensibilité', json_decode($test->sensibilite_grp) ?: []) ? 'selected' : '' }}>
                                                                Hypersensibilité</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- CIRCULATION -->
                                            <div class="form-group row">
                                                <label for="CIRCULATION"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.CIRCULATION') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="circulation" class="form-control" multiple="multiple"
                                                        name="circulation_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Régulière"
                                                                {{ in_array('Régulière', json_decode($test->circulation_grp) ?: []) ? 'selected' : '' }}>
                                                                Régulière</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Irrégulière"
                                                                {{ in_array('Irrégulière', json_decode($test->circulation_grp) ?: []) ? 'selected' : '' }}>
                                                                Irrégulière</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Plaques"
                                                                {{ in_array('Plaques', json_decode($test->circulation_grp) ?: []) ? 'selected' : '' }}>
                                                                Plaques</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="signes-particuliers-peau"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.SIGNES PARTICULIERS') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="signes-particuliers" class="form-control"
                                                        multiple="multiple" name="signes_particuliers_peau[]">
                                                        @if ($test->signes_particuliers_peau)
                                                            @foreach (['Points noirs', 'Rosacée', 'Rousseurs', 'Télangiectasie', 'Pustules', 'Hypertrichose', 'Pigmentations', 'Vitiligo', 'Cicatrice', 'Chéloïdes', 'Comédons'] as $option)
                                                                <option value="{{ $option }}"
                                                                    {{ in_array($option, json_decode($test->signes_particuliers_peau) ?: []) ? 'selected' : '' }}>
                                                                    {{ $option }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($diagnosticType === 'DIAGNOSE MAIN')
                                    <!-- Content for DIAGNOSE MAIN section -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">
                                                {{ __('sentence.hand diagnostic sheet') }}
                                            </h6>
                                        </div>
                                        <!-- Rest of the content -->
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="Etat-generale-des-mains"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.general hand state') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="Etat-generale-des-mains" class="form-control"
                                                        name="Etat_generale_des_mains">
                                                        @foreach (['Normale', 'Sèche', 'Très sèches', 'Atrophiées'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->Etat_generale_des_mains === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="Etat-des-ongles-mains"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.nail state') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="Etat-des-ongles-mains" class="form-control"
                                                        name="Etat_des_ongles_mains">
                                                        @foreach (['Normaux', 'Dures', 'Cassants', 'Fragiles'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->Etat_des_ongles_mains === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="signes-particuliers-mains"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.particular type hand') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="signes-particuliers" class="form-control"
                                                        multiple="multiple" name="signes_particuliers_mains[]">
                                                        @if ($test->signes_particuliers_peau)
                                                            @foreach (['Cicatrices', 'Rousseurs', 'Pigmentation', 'Desquamations'] as $option)
                                                                <option value="{{ $option }}"
                                                                    {{ in_array($option, json_decode($test->signes_particuliers_peau) ?: []) ? 'selected' : '' }}>
                                                                    {{ $option }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="signes-particuliers-ongles-mains"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.finger state') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="signes-particuliers-ongles" class="form-control"
                                                        multiple="multiple" name="signes_particuliers_ongles_mains[]">

                                                        @if ($test->signes_particuliers_ongles_mains)
                                                            @foreach (['Epais', 'Décollés', 'Colorés', 'Petites taches', 'Fripés', 'Friables et poudreux', 'Striées'] as $option)
                                                                <option value="{{ $option }}"
                                                                    {{ in_array($option, json_decode($test->signes_particuliers_ongles_mains) ?: []) ? 'selected' : '' }}>
                                                                    {{ $option }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="soin"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.soin') }}</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="soin" multiple="multiple"
                                                        name="soinList_main[]">
                                                        @if ($test->soinList_main)
                                                            @foreach (['1', '2', '3'] as $option)
                                                                <option value="{{ $option }}"
                                                                    {{ in_array($option, json_decode($test->soinList_main) ?: []) ? 'selected' : '' }}>
                                                                    {{ $option }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="vernis"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.vernis') }}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="vernis"
                                                        name="vernisInput_main" value="{{ $test->vernisInput_main }}">
                                                </div>
                                            </div>
                                            <hr>
                                            <h5>FACE INTERNE</h5>
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <label for="relief"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.relief') }}</label>
                                                    <input type="text" class="form-control" id="relief"
                                                        name="reliefInput_main" value="{{ $test->reliefInput_main }}">
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="cicatrices-main"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.cicatrices') }}</label>
                                                    <select class="form-control" id="cicatrices-main"
                                                        name="cicatrices_main">
                                                        @foreach (['oui', 'non'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->cicatrices_main === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="callosites-main"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.callosites') }}</label>
                                                    <select class="form-control" id="callosites-main"
                                                        name="callosites_main">
                                                        @foreach (['oui', 'non'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->callosites_main === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="sp1"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.signe particulier') }}</label>
                                                    <textarea type="text" class="form-control" id="sp1" name="spInput_main"
                                                        value="{{ $test->spInput_main }}"></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <h5>FACE DORSALE</h5>
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <label for="skinState-main"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.etat de la peau') }}</label>
                                                    <input type="text" class="form-control" id="skinState-main"
                                                        name="skinStateInput_main"value="{{ $test->skinStateInput_main }}">
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="tache-main"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.taches') }}</label>
                                                    <select class="form-control" id="tache-main" name="tache_main">
                                                        @foreach (['oui', 'non'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->tache_main === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="cicatrices-main-dorsal"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.cicatrices') }}</label>
                                                    <select class="form-control" id="cicatrices-main-dorsal"
                                                        name="cicatrices_main_dorsal">
                                                        @foreach (['oui', 'non'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->cicatrices_main_dorsal === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="callosites-main-dorsal"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.espaces inter digitale') }}</label>
                                                    <select class="form-control" id="callosites-main-dorsal"
                                                        name="callosite_main_dorsal">
                                                        @foreach (['oui', 'non'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->callosite_main_dorsal === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="sp2"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.signe particulier') }}</label>
                                                    <textarea type="text" class="form-control" id="sp2" name="spInput_main_dorsal"
                                                        value="{{ $test->spInput_main_dorsal }}"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @elseif ($diagnosticType === 'DIAGNOSE PIED')
                                    <!-- Content for DIAGNOSE PIED section -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">
                                                {{ __('sentence.foot diagnostic sheet') }}
                                            </h6>
                                        </div>
                                        <!-- Rest of the content -->
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="Etat-generale-des-pied"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.general foot state') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="Etat-generale-des-pied" class="form-control"
                                                        name="Etat_generale_des_pieds">
                                                        @foreach (['Normale', 'Sèche', 'Très sèches', 'Atrophiées'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->Etat_generale_des_pieds === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="Etat-des-ongles"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.nail state') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="Etat-des-ongles" class="form-control"
                                                        name="Etat_des_ongles_pieds">
                                                        @foreach (['Normaux', 'Dures', 'Cassants', 'Fragiles'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->Etat_des_ongles_pieds === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="signes-particuliers-mains"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.particular type foot') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="signes-particuliers" class="form-control"
                                                        multiple="multiple" name="signes_particuliers_pieds[]">
                                                        @if ($test->signes_particuliers_pieds)
                                                            @foreach (['Cicatrices', 'Rousseurs', 'Pigmentation', 'Desquamations'] as $option)
                                                                <option value="{{ $option }}"
                                                                    {{ in_array($option, json_decode($test->signes_particuliers_pieds) ?: []) ? 'selected' : '' }}>
                                                                    {{ $option }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="signes-particuliers-ongles"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.finger state') }}</label>
                                                <div class="col-sm-9">
                                                    <select id="signes-particuliers-ongles" class="form-control"
                                                        multiple="multiple" name="signes_particuliers_ongles_pieds[]">

                                                        @if ($test->signes_particuliers_ongles_pieds)
                                                            @foreach (['Epais', 'Décollés', 'Colorés', 'Petites taches', 'Fripés', 'Friables et poudreux', 'Striées'] as $option)
                                                                <option value="{{ $option }}"
                                                                    {{ in_array($option, json_decode($test->signes_particuliers_ongles_pieds) ?: []) ? 'selected' : '' }}>
                                                                    {{ $option }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="soin"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.soin') }}</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="soin" multiple="multiple"
                                                        name="soinList_pied[]">
                                                        @if ($test->soinList_main)
                                                            @foreach (['1', '2', '3'] as $option)
                                                                <option value="{{ $option }}"
                                                                    {{ in_array($option, json_decode($test->soinList_pied) ?: []) ? 'selected' : '' }}>
                                                                    {{ $option }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="vernis"
                                                    class="col-sm-3 col-form-label">{{ __('sentence.vernis') }}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="vernis"
                                                        name="vernisInput_pied" value="{{ $test->vernisInput_pied }}">
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <label for="etat_pieds"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.general foot state') }}</label>
                                                    <input type="text" class="form-control" id="etat_pieds"
                                                        name="etat_pieds" value="{{ $test->etat_pieds }}">
                                                </div>

                                                <div class="col-sm-9">
                                                    <label for="cicatrices"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.taches foot') }}</label>
                                                    <select class="form-control" id="taches_pieds" name="taches_pieds">
                                                        @foreach (['oui', 'non'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->taches_pieds === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-sm-9">
                                                    <label for="aureoles_pieds"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.aureoles') }}</label>
                                                    <select class="form-control" id="aureoles_pieds"
                                                        name="aureoles_pieds">
                                                        @foreach (['oui', 'non'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->aureoles_pieds === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-sm-9">
                                                    <label for="veines_face_ext_pieds"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.veines face ext') }}</label>
                                                    <select class="form-control" id="veines_face_ext_pieds"
                                                        name="veines_face_ext_pieds">
                                                        @foreach (['oui', 'non'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->veines_face_ext_pieds === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-sm-9">
                                                    <label for="veines_face_int_pieds"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.veines face int') }}</label>
                                                    <select class="form-control" id="veines_face_int_pieds"
                                                        name="veines_face_int_pieds">
                                                        @foreach (['oui', 'non'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->veines_face_int_pieds === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-sm-9">
                                                    <label for="douleur_talon_pieds"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.douleur talon') }}</label>
                                                    <select class="form-control" id="douleur_talon_pieds"
                                                        name="douleur_talon_pieds">
                                                        @foreach (['oui', 'non'] as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $test->douleur_talon_pieds === $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="sp2"
                                                        class="col-sm-3 col-form-label">{{ __('sentence.signe particulier') }}</label>
                                                    <textarea type="text" class="form-control" id="sp2" name="spInput_pieds"
                                                        value="{{ $test->spInput_pieds }}"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success">{{ __('sentence.Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('header')
@endsection

@section('footer')
    <script>
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
    </script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-multiselect.css') }}">
    <script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
        $('#signes-particuliers,#signes-particuliers-ongles,#soin,#PatientID').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            enableResetButton: true,
            nonSelectedText: 'sélectionnez un option',
            filterPlaceholder: 'Recherche un Hôte...',
            buttonContainer: '<div class="btn-group w-100" />'
        });
    </script>
    <script type="text/javascript">
        $('#sebum,#hydratation,#keratinisation,#follicule,#relief,#elasticite,#sensibilite,#circulation').multiselect({
            enableFiltering: true,
            enableResetButton: true,
            enableCollapsibleOptGroups: true,
            nonSelectedText: 'sélectionnez un option',
            filterPlaceholder: 'Rechercher une option...',
            buttonContainer: '<div class="btn-group w-100" />'
        });
    </script>
    <script>
        // Function to show the toast
        function showToast() {
            $('.toast').toast('show');
        }

        // Trigger the toast when the page is loaded
        $(document).ready(function() {
            showToast();
        });
    </script>
@endsection
