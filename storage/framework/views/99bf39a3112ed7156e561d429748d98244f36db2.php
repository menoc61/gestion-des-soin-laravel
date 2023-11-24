<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.View Test Detail')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col">
                            <strong><u><?php echo e(__('sentence.Test')); ?> </u></strong><br><br>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nom Diagnostic</th>
                                    <th>Type Diagnostic</th>
                                    <th>Description Diagnostic</th>
                                    <th>Détail Diagnostic</th>
                                </tr>
                                <?php $__empty_1 = true; $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($test->test_name); ?></td>
                                        <td>
                                            <!-- décoder sous le format json-->
                                            <?php
                                                $diagnosticType = json_decode($test->diagnostic_type);
                                            ?>

                                            <?php if(is_array($diagnosticType)): ?>
                                                <?php $__currentLoopData = $diagnosticType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diagnostic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($diagnostic); ?>,
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <?php echo e($diagnosticType); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($test->comment); ?></td>
                                        <td>
                                            <table class="w-100">

                                                

                                                <?php if($test->Etat_des_ongles_mains != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>ETATS DES ONGLES DE LA MAIN:</b>
                                                            <label class="badge badge-primary-soft">
                                                                <?php echo e($test->Etat_des_ongles_mains); ?>

                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php if($test->Etat_generale_des_mains != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>ETAT GÉNÉRALE DES MAINS:</b>
                                                            <label class="badge badge-primary-soft">
                                                                <?php echo e($test->Etat_generale_des_mains); ?>

                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php
                                                    $signes_mains = json_decode($test->signes_particuliers_mains);
                                                ?>
                                                <?php if($signes_mains != null): ?>
                                                    <tr>

                                                        <td>
                                                            <b>SIGNES PARTICULIERS DES MAINS :</b>
                                                            <?php if(is_array($signes_mains)): ?>
                                                                <?php $__currentLoopData = $signes_mains; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($signes_mains); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php
                                                    $signes_ongles_mains = json_decode($test->signes_particuliers_ongles_mains);
                                                ?>
                                                <?php if($signes_ongles_mains !== null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>SIGNES PARTICULIERS DES ONGLES DE LA MAIN :</b>
                                                            <?php if(is_array($signes_ongles_mains)): ?>
                                                                <?php $__currentLoopData = $signes_ongles_mains; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($signes_ongles_mains); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php
                                                    $soin_List_main = json_decode($test->soinList_main);
                                                ?>
                                                <?php if($soin_List_main != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>SOINS PREFERES :</b>
                                                            <?php if(is_array($soin_List_main)): ?>
                                                                <?php $__currentLoopData = $soin_List_main; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($soin_List_main); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php if($test->vernisInput_main != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>VERNIS PREFERE :</b>
                                                            <label class="badge badge-primary-soft">
                                                                <?php echo e($test->vernisInput_main); ?>

                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                

                                                

                                                <?php
                                                    $signe_peau = json_decode($test->signes_particuliers_peau);
                                                ?>
                                                <?php if($signe_peau != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>SIGNES PARTICULIERS DE LA PEAU :</b>

                                                            <?php if(is_array($signe_peau)): ?>
                                                                <?php $__currentLoopData = $signe_peau; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($signe_peau); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php
                                                    $sebum_grpe = json_decode($test->sebum_grp);
                                                ?>
                                                <?php if($sebum_grpe != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>SEBUM:</b>

                                                            <?php if(is_array($sebum_grpe)): ?>
                                                                <?php $__currentLoopData = $sebum_grpe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($sebum_grpe); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php
                                                    $hydratation_grpe = json_decode($test->hydratation_grp);
                                                ?>
                                                <?php if($hydratation_grpe != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>HYDRATATION:</b>

                                                            <?php if(is_array($hydratation_grpe)): ?>
                                                                <?php $__currentLoopData = $hydratation_grpe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($hydratation_grpe); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php
                                                    $keratinisation_grpe = json_decode($test->keratinisation_grp);
                                                ?>
                                                <?php if($keratinisation_grpe != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>KERATINISATION:</b>

                                                            <?php if(is_array($keratinisation_grpe)): ?>
                                                                <?php $__currentLoopData = $keratinisation_grpe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($keratinisation_grpe); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php
                                                    $follicule_grpe = json_decode($test->follicule_grp);
                                                ?>
                                                <?php if($follicule_grpe != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>FOLLICULE:</b>

                                                            <?php if(is_array($follicule_grpe)): ?>
                                                                <?php $__currentLoopData = $follicule_grpe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($follicule_grpe); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php
                                                    $relief_grpe = json_decode($test->relief_grp);
                                                ?>
                                                <?php if($relief_grpe != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>RELIEF:</b>

                                                            <?php if(is_array($relief_grpe)): ?>
                                                                <?php $__currentLoopData = $relief_grpe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($relief_grpe); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php
                                                    $elasticite_grpe = json_decode($test->elasticite_grp);
                                                ?>
                                                <?php if($elasticite_grpe != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>ELASTICITE:</b>

                                                            <?php if(is_array($elasticite_grpe)): ?>
                                                                <?php $__currentLoopData = $elasticite_grpe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($elasticite_grpe); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php
                                                    $sensibilite_grpe = json_decode($test->sensibilite_grp);
                                                ?>
                                                <?php if($sensibilite_grpe != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>SENSIBILITE:</b>

                                                            <?php if(is_array($sensibilite_grpe)): ?>
                                                                <?php $__currentLoopData = $sensibilite_grpe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($sensibilite_grpe); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php
                                                    $circulation_grpe = json_decode($test->circulation_grp);
                                                ?>
                                                <?php if($circulation_grpe != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>CIRCULATION:</b>

                                                            <?php if(is_array($circulation_grpe)): ?>
                                                                <?php $__currentLoopData = $circulation_grpe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($circulation_grpe); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>

                                                

                                                

                                                <?php
                                                    $signes_pieds = json_decode($test->signes_particuliers_pieds);
                                                ?>
                                                <?php if($signes_pieds != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>SIGNES PARTICULIERS DES PIEDS:</b>

                                                            <?php if(is_array($signes_pieds)): ?>
                                                                <?php $__currentLoopData = $signes_pieds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($signes_pieds); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php
                                                    $signes_ongles_pieds = json_decode($test->signes_particuliers_ongles_pieds);
                                                ?>
                                                <?php if($signes_ongles_pieds != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>SIGNES PARTICULIERS DES ONGLES DU PIED :</b>

                                                            <?php if(is_array($signes_ongles_pieds)): ?>
                                                                <?php $__currentLoopData = $signes_ongles_pieds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($signes_ongles_pieds); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php
                                                    $soinList_pieds = json_decode($test->soinList_pied);
                                                ?>
                                                <?php if($soinList_pieds != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>SOINS PREFERES:</b>

                                                            <?php if(is_array($soinList_pieds)): ?>
                                                                <?php $__currentLoopData = $soinList_pieds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <label class="badge badge-primary-soft">
                                                                        <?php echo e($signe); ?>

                                                                    </label>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php echo e($soinList_pieds); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php if($test->Etat_generale_des_pieds != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>ETAT GENERALE DE LA PEAU DES PIEDS:</b>
                                                            <label class="badge badge-primary-soft">
                                                                <?php echo e($test->Etat_generale_des_pieds); ?>

                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php if($test->Etat_des_ongles_pieds != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>ETATS DES ONGLES DU PIED:</b>
                                                            <label class="badge badge-primary-soft">
                                                                <?php echo e($test->Etat_des_ongles_pieds); ?>

                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php if($test->vernisInput_pied != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>VERNIS PREFERES:</b>
                                                            <label class="badge badge-primary-soft">
                                                                <?php echo e($test->vernisInput_pied); ?>

                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php if($test->etat_pieds != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>ETATS DE PEAU:</b>
                                                            <label class="badge badge-primary-soft">
                                                                <?php echo e($test->etat_pieds); ?>

                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php if($test->taches_pieds != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>TACHES SUR LES ONGLES:</b>
                                                            <label class="badge badge-primary-soft">
                                                                <?php echo e($test->taches_pieds); ?>

                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php if($test->aureoles_pieds != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>PRESENCE DES AUREOLES:</b>
                                                            <label class="badge badge-primary-soft">
                                                                <?php echo e($test->aureoles_pieds); ?>

                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php if($test->veines_face_ext_pieds != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>Veines visibles la face externe:</b>
                                                            <label class="badge badge-primary-soft">
                                                                <?php echo e($test->veines_face_ext_pieds); ?>

                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php if($test->veines_face_int_pieds != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>Veines visibles la face interne:</b>
                                                            <label class="badge badge-primary-soft">
                                                                <?php echo e($test->veines_face_int_pieds); ?>

                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php if($test->douleur_talon_pieds != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>DOULEURS PARTICULIÈRE DU TALON:</b>
                                                            <label class="badge badge-primary-soft">
                                                                <?php echo e($test->douleur_talon_pieds); ?>

                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                
                                                <?php if($test->spInput_pieds != null): ?>
                                                    <tr>
                                                        <td>
                                                            <b>ETATS DES ONGLES:</b>
                                                            <label class="badge badge-primary-soft">
                                                                <?php echo e($test->spInput_pieds); ?>

                                                            </label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </table>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="3">Aucun Diagnostic disponible.</td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\HS\gestion-des-soin-laravel\resources\views/test/view_test.blade.php ENDPATH**/ ?>