<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Edit Test')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Edit Test')); ?></h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo e(route('test.store_edit')); ?>">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Test Name')); ?><font
                                    color="red">*</font></label>
                            
                            <div class="col-sm-9 input-group">
                                <select class="input-group-text" name="patient_id" id="PatientID" required
                                    aria-placeholder="<?php echo e(__('sentence.Select Patient')); ?>" onchange="updateTestName()">
                                    <option @readonly(true)><?php echo e(__('sentence.Select Patient')); ?></option>
                                    <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($patient->id); ?>" data-name="<?php echo e($patient->name); ?>">
                                            <?php echo e($patient->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <input type="text" class="form-control" id="inputEmail3" name="test_name"
                                    value="<?php echo e($test->test_name); ?>" readonly>
                                <?php echo e(csrf_field()); ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3"
                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.Description')); ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputPassword3" name="comment"
                                    value="<?php echo e($test->comment); ?>" placeholder="Aucune description trouvée ">
                                <input type="hidden" name="test_id" value="<?php echo e($test->id); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputSection"
                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.Form Type')); ?></label>
                            <div class="col-sm-9">
                                <select multiple="multiple" class="form-control" id="inputSection" name="diagnostic_type[]">
                                    <?php $__currentLoopData = ['DIAGNOSE PEAU', 'DIAGNOSE MAIN', 'DIAGNOSE PIED']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($option); ?>"
                                            <?php echo e(in_array($option, json_decode($test->diagnostic_type)) ? 'selected' : ''); ?>>
                                            <?php echo e($option); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <?php $__currentLoopData = json_decode($test->diagnostic_type); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diagnosticType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group row" id="section-<?php echo e($diagnosticType); ?>" style="display: block;">
                                <?php if($diagnosticType === 'DIAGNOSE PEAU'): ?>
                                    <!-- Content for DIAGNOSE PEAU section -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">
                                                <?php echo e(__('sentence.skin diagnostic sheet')); ?>

                                            </h6>
                                        </div>
                                        <!-- Rest of the content -->
                                        <div class="card-body">
                                            
                                            <div class="form-group row">
                                                <label for="SEBUM"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.SEBUM')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="sebum" class="form-control" multiple="multiple"
                                                        name="sebum_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                <?php echo e(in_array('Léger', json_decode($test->sebum_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                <?php echo e(in_array('Normale', json_decode($test->sebum_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE"
                                                            disabled>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Grasse"
                                                                <?php echo e(in_array('Grasse', json_decode($test->sebum_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Grasse</option>
                                                            <option value="Acnéique"
                                                                <?php echo e(in_array('Acnéique', json_decode($test->sebum_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Acnéique</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- HYDRATATION -->
                                            <div class="form-group row">
                                                <label for="HYDRATATION"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.HYDRATATION')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="hydratation" class="form-control" multiple="multiple"
                                                        name="hydratation_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                <?php echo e(in_array('Léger', json_decode($test->hydratation_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                <?php echo e(in_array('Normale', json_decode($test->hydratation_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Sèche"
                                                                <?php echo e(in_array('Sèche', json_decode($test->hydratation_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Sèche</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Tiraillement"
                                                                <?php echo e(in_array('Tiraillement', json_decode($test->hydratation_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Tiraillement</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- KERATINISATION -->
                                            <div class="form-group row">
                                                <label for="KERATINISATION"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.KERATINISATION')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="keratinisation" class="form-control" multiple="multiple"
                                                        name="keratinisation_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                <?php echo e(in_array('Léger', json_decode($test->keratinisation_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                <?php echo e(in_array('Normale', json_decode($test->keratinisation_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Sèche"
                                                                <?php echo e(in_array('Sèche', json_decode($test->keratinisation_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Sèche</option>
                                                            <option value="Desquamée"
                                                                <?php echo e(in_array('Desquamée', json_decode($test->keratinisation_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Desquamée</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Gerssures"
                                                                <?php echo e(in_array('Gerssures', json_decode($test->keratinisation_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Gerssures</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- FOLLICULE -->
                                            <div class="form-group row">
                                                <label for="FOLLICULE"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.FOLLICULE')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="follicule" class="form-control" multiple="multiple"
                                                        name="follicule_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                <?php echo e(in_array('Léger', json_decode($test->follicule_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                <?php echo e(in_array('Normale', json_decode($test->follicule_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Faible"
                                                                <?php echo e(in_array('Faible', json_decode($test->follicule_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Faible</option>
                                                            <option value="Sèche"
                                                                <?php echo e(in_array('Sèche', json_decode($test->follicule_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Sèche</option>
                                                            <option value="Desquamée"
                                                                <?php echo e(in_array('Desquamée', json_decode($test->follicule_grp) ?: []) ? 'selected' : ''); ?>>
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
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.RELIEF')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="relief" class="form-control" multiple="multiple"
                                                        name="relief_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                <?php echo e(in_array('Léger', json_decode($test->relief_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                <?php echo e(in_array('Normale', json_decode($test->relief_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Fin"
                                                                <?php echo e(in_array('Fin', json_decode($test->relief_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Fin</option>
                                                            <option value="Serré"
                                                                <?php echo e(in_array('Serré', json_decode($test->relief_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Serré</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Pores dilatés"
                                                                <?php echo e(in_array('Pores dilatés', json_decode($test->relief_grp)) ? 'selected' : ''); ?>>
                                                                Pores dilatés</option>
                                                            <option value="Pores obstrués"
                                                                <?php echo e(in_array('Pores obstrués', json_decode($test->relief_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Pores obstrués</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- ELASTICITE -->
                                            <div class="form-group row">
                                                <label for="ELASTICITE"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.ELASTICITE')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="elasticite" class="form-control" multiple="multiple"
                                                        name="elasticite_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                <?php echo e(in_array('Léger', json_decode($test->elasticite_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                <?php echo e(in_array('Normale', json_decode($test->elasticite_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Faible"
                                                                <?php echo e(in_array('Faible', json_decode($test->elasticite_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Faible</option>
                                                            <option value="Bonne"
                                                                <?php echo e(in_array('Bonne', json_decode($test->elasticite_grp) ?: []) ? 'selected' : ''); ?>>
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
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.SENSIBILITE')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="sensibilite" class="form-control" multiple="multiple"
                                                        name="sensibilite_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Léger"
                                                                <?php echo e(in_array('Léger', json_decode($test->sensibilite_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Léger</option>
                                                            <option value="Normale"
                                                                <?php echo e(in_array('Normale', json_decode($test->sensibilite_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Normale</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Sensible"
                                                                <?php echo e(in_array('Sensible', json_decode($test->sensibilite_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Sensible</option>
                                                            <option value="Réactive"
                                                                <?php echo e(in_array('Réactive', json_decode($test->sensibilite_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Réactive</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Hypersensibilité"
                                                                <?php echo e(in_array('Hypersensibilité', json_decode($test->sensibilite_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Hypersensibilité</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- CIRCULATION -->
                                            <div class="form-group row">
                                                <label for="CIRCULATION"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.CIRCULATION')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="circulation" class="form-control" multiple="multiple"
                                                        name="circulation_grp[]">
                                                        <optgroup label="NORMALE">
                                                            <option value="Régulière"
                                                                <?php echo e(in_array('Régulière', json_decode($test->circulation_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Régulière</option>
                                                        </optgroup>
                                                        <optgroup label="ANOMALIE DU DERME / ATROPHIE OU SEBOSTASEE">
                                                            <option value="Irrégulière"
                                                                <?php echo e(in_array('Irrégulière', json_decode($test->circulation_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Irrégulière</option>
                                                        </optgroup>
                                                        <optgroup
                                                            label="ANOMALIE DE L’EPIDERME /SEBORRHEE  OU HYPERSENSIBLE">
                                                            <option value="Plaques"
                                                                <?php echo e(in_array('Plaques', json_decode($test->circulation_grp) ?: []) ? 'selected' : ''); ?>>
                                                                Plaques</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="signes-particuliers-peau"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.SIGNES PARTICULIERS')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="signes-particuliers" class="form-control"
                                                        multiple="multiple" name="signes_particuliers_peau[]">
                                                        <?php if($test->signes_particuliers_peau): ?>
                                                            <?php $__currentLoopData = ['Points noirs', 'Rosacée', 'Rousseurs', 'Télangiectasie', 'Pustules', 'Hypertrichose', 'Pigmentations', 'Vitiligo', 'Cicatrice', 'Chéloïdes', 'Comédons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($option); ?>"
                                                                    <?php echo e(in_array($option, json_decode($test->signes_particuliers_peau) ?: []) ? 'selected' : ''); ?>>
                                                                    <?php echo e($option); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif($diagnosticType === 'DIAGNOSE MAIN'): ?>
                                    <!-- Content for DIAGNOSE MAIN section -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">
                                                <?php echo e(__('sentence.hand diagnostic sheet')); ?>

                                            </h6>
                                        </div>
                                        <!-- Rest of the content -->
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="Etat-generale-des-mains"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.general hand state')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="Etat-generale-des-mains" class="form-control"
                                                        name="Etat_generale_des_mains">
                                                        <?php $__currentLoopData = ['Normale', 'Sèche', 'Très sèches', 'Atrophiées']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->Etat_generale_des_mains === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="Etat-des-ongles-mains"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.nail state')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="Etat-des-ongles-mains" class="form-control"
                                                        name="Etat_des_ongles_mains">
                                                        <?php $__currentLoopData = ['Normaux', 'Dures', 'Cassants', 'Fragiles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->Etat_des_ongles_mains === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="signes-particuliers-mains"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.particular type hand')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="signes-particuliers" class="form-control"
                                                        multiple="multiple" name="signes_particuliers_mains[]">
                                                        <?php if($test->signes_particuliers_peau): ?>
                                                            <?php $__currentLoopData = ['Cicatrices', 'Rousseurs', 'Pigmentation', 'Desquamations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($option); ?>"
                                                                    <?php echo e(in_array($option, json_decode($test->signes_particuliers_peau) ?: []) ? 'selected' : ''); ?>>
                                                                    <?php echo e($option); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="signes-particuliers-ongles-mains"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.finger state')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="signes-particuliers-ongles" class="form-control"
                                                        multiple="multiple" name="signes_particuliers_ongles_mains[]">

                                                        <?php if($test->signes_particuliers_ongles_mains): ?>
                                                            <?php $__currentLoopData = ['Epais', 'Décollés', 'Colorés', 'Petites taches', 'Fripés', 'Friables et poudreux', 'Striées']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($option); ?>"
                                                                    <?php echo e(in_array($option, json_decode($test->signes_particuliers_ongles_mains) ?: []) ? 'selected' : ''); ?>>
                                                                    <?php echo e($option); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="soin"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.soin')); ?></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="soin" multiple="multiple"
                                                        name="soinList_main[]">
                                                        <?php if($test->soinList_main): ?>
                                                            <?php $__currentLoopData = ['1', '2', '3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($option); ?>"
                                                                    <?php echo e(in_array($option, json_decode($test->soinList_main) ?: []) ? 'selected' : ''); ?>>
                                                                    <?php echo e($option); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="vernis"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.vernis')); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="vernis"
                                                        name="vernisInput_main" value="<?php echo e($test->vernisInput_main); ?>">
                                                </div>
                                            </div>
                                            <hr>
                                            <h5>FACE INTERNE</h5>
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <label for="relief"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.relief')); ?></label>
                                                    <input type="text" class="form-control" id="relief"
                                                        name="reliefInput_main" value="<?php echo e($test->reliefInput_main); ?>">
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="cicatrices-main"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.cicatrices')); ?></label>
                                                    <select class="form-control" id="cicatrices-main"
                                                        name="cicatrices_main">
                                                        <?php $__currentLoopData = ['oui', 'non']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->cicatrices_main === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="callosites-main"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.callosites')); ?></label>
                                                    <select class="form-control" id="callosites-main"
                                                        name="callosites_main">
                                                        <?php $__currentLoopData = ['oui', 'non']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->callosites_main === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="sp1"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.signe particulier')); ?></label>
                                                    <textarea type="text" class="form-control" id="sp1" name="spInput_main"
                                                        value="<?php echo e($test->spInput_main); ?>"></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <h5>FACE DORSALE</h5>
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <label for="skinState-main"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.etat de la peau')); ?></label>
                                                    <input type="text" class="form-control" id="skinState-main"
                                                        name="skinStateInput_main"value="<?php echo e($test->skinStateInput_main); ?>">
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="tache-main"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.taches')); ?></label>
                                                    <select class="form-control" id="tache-main" name="tache_main">
                                                        <?php $__currentLoopData = ['oui', 'non']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->tache_main === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="cicatrices-main-dorsal"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.cicatrices')); ?></label>
                                                    <select class="form-control" id="cicatrices-main-dorsal"
                                                        name="cicatrices_main_dorsal">
                                                        <?php $__currentLoopData = ['oui', 'non']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->cicatrices_main_dorsal === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="callosites-main-dorsal"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.espaces inter digitale')); ?></label>
                                                    <select class="form-control" id="callosites-main-dorsal"
                                                        name="callosite_main_dorsal">
                                                        <?php $__currentLoopData = ['oui', 'non']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->callosite_main_dorsal === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="sp2"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.signe particulier')); ?></label>
                                                    <textarea type="text" class="form-control" id="sp2" name="spInput_main_dorsal"
                                                        value="<?php echo e($test->spInput_main_dorsal); ?>"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php elseif($diagnosticType === 'DIAGNOSE PIED'): ?>
                                    <!-- Content for DIAGNOSE PIED section -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">
                                                <?php echo e(__('sentence.foot diagnostic sheet')); ?>

                                            </h6>
                                        </div>
                                        <!-- Rest of the content -->
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="Etat-generale-des-pied"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.general foot state')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="Etat-generale-des-pied" class="form-control"
                                                        name="Etat_generale_des_pieds">
                                                        <?php $__currentLoopData = ['Normale', 'Sèche', 'Très sèches', 'Atrophiées']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->Etat_generale_des_pieds === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="Etat-des-ongles"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.nail state')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="Etat-des-ongles" class="form-control"
                                                        name="Etat_des_ongles_pieds">
                                                        <?php $__currentLoopData = ['Normaux', 'Dures', 'Cassants', 'Fragiles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->Etat_des_ongles_pieds === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="signes-particuliers-mains"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.particular type foot')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="signes-particuliers" class="form-control"
                                                        multiple="multiple" name="signes_particuliers_pieds[]">
                                                        <?php if($test->signes_particuliers_pieds): ?>
                                                            <?php $__currentLoopData = ['Cicatrices', 'Rousseurs', 'Pigmentation', 'Desquamations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($option); ?>"
                                                                    <?php echo e(in_array($option, json_decode($test->signes_particuliers_pieds) ?: []) ? 'selected' : ''); ?>>
                                                                    <?php echo e($option); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="signes-particuliers-ongles"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.finger state')); ?></label>
                                                <div class="col-sm-9">
                                                    <select id="signes-particuliers-ongles" class="form-control"
                                                        multiple="multiple" name="signes_particuliers_ongles_pieds[]">

                                                        <?php if($test->signes_particuliers_ongles_pieds): ?>
                                                            <?php $__currentLoopData = ['Epais', 'Décollés', 'Colorés', 'Petites taches', 'Fripés', 'Friables et poudreux', 'Striées']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($option); ?>"
                                                                    <?php echo e(in_array($option, json_decode($test->signes_particuliers_ongles_pieds) ?: []) ? 'selected' : ''); ?>>
                                                                    <?php echo e($option); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="soin"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.soin')); ?></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="soin" multiple="multiple"
                                                        name="soinList_pied[]">
                                                        <?php if($test->soinList_main): ?>
                                                            <?php $__currentLoopData = ['1', '2', '3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($option); ?>"
                                                                    <?php echo e(in_array($option, json_decode($test->soinList_pied) ?: []) ? 'selected' : ''); ?>>
                                                                    <?php echo e($option); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="vernis"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.vernis')); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="vernis"
                                                        name="vernisInput_pied" value="<?php echo e($test->vernisInput_pied); ?>">
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <label for="etat_pieds"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.general foot state')); ?></label>
                                                    <input type="text" class="form-control" id="etat_pieds"
                                                        name="etat_pieds" value="<?php echo e($test->etat_pieds); ?>">
                                                </div>

                                                <div class="col-sm-9">
                                                    <label for="cicatrices"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.taches foot')); ?></label>
                                                    <select class="form-control" id="taches_pieds" name="taches_pieds">
                                                        <?php $__currentLoopData = ['oui', 'non']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->taches_pieds === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>

                                                <div class="col-sm-9">
                                                    <label for="aureoles_pieds"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.aureoles')); ?></label>
                                                    <select class="form-control" id="aureoles_pieds"
                                                        name="aureoles_pieds">
                                                        <?php $__currentLoopData = ['oui', 'non']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->aureoles_pieds === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>

                                                <div class="col-sm-9">
                                                    <label for="veines_face_ext_pieds"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.veines face ext')); ?></label>
                                                    <select class="form-control" id="veines_face_ext_pieds"
                                                        name="veines_face_ext_pieds">
                                                        <?php $__currentLoopData = ['oui', 'non']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->veines_face_ext_pieds === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>

                                                <div class="col-sm-9">
                                                    <label for="veines_face_int_pieds"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.veines face int')); ?></label>
                                                    <select class="form-control" id="veines_face_int_pieds"
                                                        name="veines_face_int_pieds">
                                                        <?php $__currentLoopData = ['oui', 'non']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->veines_face_int_pieds === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>

                                                <div class="col-sm-9">
                                                    <label for="douleur_talon_pieds"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.douleur talon')); ?></label>
                                                    <select class="form-control" id="douleur_talon_pieds"
                                                        name="douleur_talon_pieds">
                                                        <?php $__currentLoopData = ['oui', 'non']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($option); ?>"
                                                                <?php echo e($test->douleur_talon_pieds === $option ? 'selected' : ''); ?>>
                                                                <?php echo e($option); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="sp2"
                                                        class="col-sm-3 col-form-label"><?php echo e(__('sentence.signe particulier')); ?></label>
                                                    <textarea type="text" class="form-control" id="sp2" name="spInput_pieds"
                                                        value="<?php echo e($test->spInput_pieds); ?>"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success"><?php echo e(__('sentence.Save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
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
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap-multiselect.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('js/bootstrap-multiselect.js')); ?>"></script>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Desktop\gestion des soins\v1.0\resources\views/test/edit.blade.php ENDPATH**/ ?>