<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Edit Test')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail3" name="test_name"
                                    value="<?php echo e($test->test_name); ?>">
                                <?php echo e(csrf_field()); ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3"
                                class="col-sm-3 col-form-label"><?php echo e(__('sentence.Description')); ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputPassword3" name="comment"
                                    value="<?php echo e($test->comment); ?>">
                                <input type="hidden" name="test_id" value="<?php echo e($test->id); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputSection" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Form Type')); ?></label>
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
                                            <hr>
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
                                            <div class="form-group row">
                                                <label for="obseration-mains"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.obseration')); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="obseration-mains"
                                                        name="obserationInput_main"
                                                        value="<?php echo e($test->obserationInput_main); ?>">
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
                                                <label for="obseration"
                                                    class="col-sm-3 col-form-label"><?php echo e(__('sentence.obseration')); ?></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="obseration"
                                                        name="obserationInput_pied"
                                                        value="<?php echo e($test->obserationInput_pied); ?>">
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
                                <button type="submit" class="btn btn-primary"><?php echo e(__('sentence.Save')); ?></button>
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
    <script type="text/javascript"
        src="https://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
        $('#signes-particuliers,#signes-particuliers-ongles,#soin').multiselect();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Desktop\gestion des soins\v1.0\resources\views/test/edit.blade.php ENDPATH**/ ?>