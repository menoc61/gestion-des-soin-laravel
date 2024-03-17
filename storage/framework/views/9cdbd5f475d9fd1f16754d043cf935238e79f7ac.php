


<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.View Prescription')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

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
                    <div class="row">
                        <div class="col">
                            <?php if(!empty(App\Setting::get_option('logo'))): ?>
                                <img src="<?php echo e(asset('uploads/' . App\Setting::get_option('logo'))); ?>"><br><br>
                            <?php endif; ?>
                            <?php echo clean(App\Setting::get_option('header_left')); ?>

                        </div>
                        <div class="col-md-3">
                            <p><b><?php echo e(__('sentence.Date')); ?> :</b> <?php echo e($prescription->created_at->format('d M Y h:m:s')); ?></p>
                            <p><b><?php echo e(__('sentence.Reference')); ?> :</b> <?php echo e($prescription->reference); ?></p>
                        </div>
                    </div>
                    <!-- END ROW : Doctor informations -->
                    <!-- ROW : Patient informations -->
                    <div class="row">
                        <div class="col">
                            <hr>
                            <p>
                                <b><?php echo e(__('sentence.Patient Name')); ?> :</b> <?php echo e($prescription->User->name); ?>

                                <?php if(isset($prescription->User->Patient->birthday)): ?>
                                    <br><b><?php echo e(__('sentence.Age')); ?> :</b> <?php echo e($prescription->User->Patient->birthday); ?>

                                    (<?php echo e(\Carbon\Carbon::parse($prescription->User->Patient->birthday)->age); ?> Years)
                                <?php endif; ?>
                                <?php if(isset($prescription->User->Patient->gender)): ?>
                                    <br><b><?php echo e(__('sentence.Gender')); ?> :</b>
                                    <?php echo e($prescription->User->Patient->gender); ?>

                                <?php endif; ?>
                                <?php if(isset($prescription->User->Patient->weight)): ?>
                                    <br><b><?php echo e(__('sentence.Patient Weight')); ?> :</b>
                                    <?php echo e($prescription->User->Patient->weight); ?>

                                    Kg
                                <?php endif; ?>
                                <?php if(isset($prescription->User->Patient->height)): ?>
                                    <br><b><?php echo e(__('sentence.Patient Height')); ?> :</b>
                                    <?php echo e($prescription->User->Patient->height); ?>

                                <?php endif; ?>
                            </p>
                            <hr>
                        </div>
                    </div>
                    <!-- END ROW : Patient informations -->
                    <?php if(count($prescription_tests) > 0): ?>
                        <!-- ROW : Tests List -->
                        <div class="row justify-content-center">
                            <div class="col">
                                <strong><u><?php echo e(__('sentence.Test to do')); ?> </u></strong><br><br>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nom Diagnostic</th>
                                        <th>Type Diagnostic</th>
                                        <th>Description Diagnostic</th>
                                        <th>Détail Diagnostic</th>
                                    </tr>
                                    <?php $__empty_1 = true; $__currentLoopData = $prescription_tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tests): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($tests->Test->test_name); ?></td>
                                        <td>
                                            <!-- décoder sous le format json-->
                                            <?php
                                                $diagnosticType = json_decode($tests->Test->diagnostic_type);
                                            ?>

                                            <?php if(is_array($diagnosticType)): ?>
                                                <?php $__currentLoopData = $diagnosticType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diagnostic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($diagnostic); ?>,
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <?php echo e($diagnosticType); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($tests->description); ?></td>
                                        <td>
                                            <table class="w-100">

                                                
                                                <tr>
                                                    <td>
                                                        <b>ETATS DES ONGLES:</b>
                                                        <?php echo e($tests->Test->Etat_des_ongles_mains); ?>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <b>ETAT GÉNÉRALE DES MAINS:</b>
                                                        <?php echo e($tests->Test->Etat_generale_des_mains); ?>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <b>SIGNES PARTICULIERS MAINS :</b>
                                                        <?php
                                                            $signes_mains = json_decode($tests->Test->signes_particuliers_mains);
                                                        ?>
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
                                                <tr>
                                                    <td>
                                                        <b>SIGNES PARTICULIERS DES ONGLES :</b>
                                                        <?php
                                                            $signes_ongles_mains = json_decode($tests->Test->signes_particuliers_ongles_mains);
                                                        ?>
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
                                                <tr>
                                                    <td>
                                                        <b>SIGNES PARTICULIERS MAINS :</b>
                                                        <?php
                                                            $soin_List_main = json_decode($tests->Test->soinList_main);
                                                        ?>
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
                                                <tr>
                                                    <td>
                                                        <b>SIGNES PARTICULIERS MAINS :</b>
                                                        <?php echo e($tests->Test->vernisInput_main); ?>

                                                    </td>
                                                </tr>

                                                
                                                <tr>
                                                    <td>
                                                        <b>SIGNES PARTICULIERS PIEDS :</b>
                                                        <?php
                                                            $signe_peau = json_decode($tests->Test->signes_particuliers_peau);
                                                        ?>
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
                                                <tr>
                                                    <td>
                                                        <b>SEBUM:</b>
                                                        <?php
                                                            $sebum_grpe = json_decode($tests->Test->sebum_grp);
                                                        ?>
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
                                                <tr>
                                                    <td>
                                                        <b>HYDRATATION:</b>
                                                        <?php
                                                            $hydratation_grpe = json_decode($tests->Test->hydratation_grp);
                                                        ?>
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
                                                <tr>
                                                    <td>
                                                        <b>KERATINISATION:</b>
                                                        <?php
                                                            $keratinisation_grpe = json_decode($tests->Test->keratinisation_grp);
                                                        ?>
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
                                                <tr>
                                                    <td>
                                                        <b>FOLLICULE:</b>
                                                        <?php
                                                            $follicule_grpe = json_decode($tests->Test->follicule_grp);
                                                        ?>
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
                                                <tr>
                                                    <td>
                                                        <b>RELIEF:</b>
                                                        <?php
                                                            $relief_grpe = json_decode($tests->Test->relief_grp);
                                                        ?>
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
                                                <tr>
                                                    <td>
                                                        <b>ELASTICITE:</b>
                                                        <?php
                                                            $elasticite_grpe = json_decode($tests->Test->elasticite_grp);
                                                        ?>
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
                                                <tr>
                                                    <td>
                                                        <b>SENSIBILITE:</b>
                                                        <?php
                                                            $sensibilite_grpe = json_decode($tests->Test->sensibilite_grp);
                                                        ?>
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
                                                <tr>
                                                    <td>
                                                        <b>CIRCULATION:</b>
                                                        <?php
                                                            $circulation_grpe = json_decode($tests->Test->circulation_grp);
                                                        ?>
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
                        <!-- END ROW : Tests List -->
                    <?php endif; ?>
                    <?php if(count($prescription_drugs) > 0): ?>
                        <!-- ROW : Drugs List -->
                        <div class="row justify-content-center">
                            <div class="col">
                                <strong><u><?php echo e(__('sentence.Drug')); ?> : </u></strong><br><br>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nom Soin</th>
                                        <th>Type Soin</th>
                                        <th>Produits Soin</th>
                                    </tr>
                                    <?php $__empty_1 = true; $__currentLoopData = $prescription_drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td> <?php echo e($drug->type); ?> </td>
                                            <td> <?php echo e($drug->Drug->trade_name); ?> </td>
                                            <td>
                                                <?php
                                                    $product = json_decode($drug->Drug->generic_name);
                                                ?>

                                                <?php if(is_array($product)): ?>
                                                    <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <label class="badge badge-primary-soft"><?php echo e($products); ?></label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php echo e($product); ?>

                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="3">Aucun Soin disponible.</td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right'))): ?>
                        <!-- ROW : Footer informations -->
                        <div class="row">
                            <div class="col">
                                <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                            </div>
                            <div class="col">
                                <p class="float-right font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                            </div>
                        </div>
                        <!-- END ROW : Footer informations -->
                    <?php elseif(empty(App\Setting::get_option('footer_left'))): ?>
                        <!-- ROW : Footer informations -->
                        <div class="row">
                            <div class="col">
                                <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                            </div>
                        </div>
                        <!-- END ROW : Footer informations -->
                    <?php elseif(empty(App\Setting::get_option('footer_right'))): ?>
                        <!-- ROW : Footer informations -->
                        <div class="row">
                            <div class="col">
                                <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                            </div>
                        </div>
                        <!-- END ROW : Footer informations -->
                    <?php else: ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden prescription -->
    <div id="print_area" style="display: none;">
        <!-- ROW : Doctor informations -->
        <div class="row">
            <div class="col-9">
                <?php if(!empty(App\Setting::get_option('logo'))): ?>
                    <img src="<?php echo e(asset('uploads/' . App\Setting::get_option('logo'))); ?>"><br><br>
                <?php endif; ?>
                <?php echo clean(App\Setting::get_option('header_left')); ?>

            </div>
            <div class="col-3">
                <?php echo e(__('sentence.Date')); ?> <?php echo e($prescription->created_at->format('d M Y h:m:s')); ?>

            </div>
        </div>
        <!-- END ROW : Doctor informations -->
        <hr>
        <!-- ROW : Patient informations -->
        <div class="row">
            <div class="col">
                <hr>
                <p>
                    <b><?php echo e(__('sentence.Patient Name')); ?> :</b> <?php echo e($prescription->User->name); ?>

                    <?php if(isset($prescription->User->Patient->birthday)): ?>
                        <br><b><?php echo e(__('sentence.Age')); ?> :</b> <?php echo e($prescription->User->Patient->birthday); ?>

                        (<?php echo e(\Carbon\Carbon::parse($prescription->User->Patient->birthday)->age); ?> Years)
                    <?php endif; ?>
                    <?php if(isset($prescription->User->Patient->gender)): ?>
                        <br><b><?php echo e(__('sentence.Gender')); ?> :</b>
                        <?php echo e($prescription->User->Patient->gender); ?>

                    <?php endif; ?>
                    <?php if(isset($prescription->User->Patient->weight)): ?>
                        <br><b><?php echo e(__('sentence.Patient Weight')); ?> :</b>
                        <?php echo e($prescription->User->Patient->weight); ?>

                        Kg
                    <?php endif; ?>
                    <?php if(isset($prescription->User->Patient->height)): ?>
                        <br><b><?php echo e(__('sentence.Patient Height')); ?> :</b>
                        <?php echo e($prescription->User->Patient->height); ?>

                    <?php endif; ?>
                </p>
                <hr>
            </div>
        </div>
        <!-- END ROW : Patient informations -->

        <?php if(count($prescription_tests) > 0): ?>
            <!-- ROW : Tests List -->
            <div class="row justify-content-center">
                <div class="col">
                    <strong><u><?php echo e(__('sentence.Test to do')); ?> </u></strong><br><br>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nom Diagnostic</th>
                            <th>Type Diagnostic</th>
                            
                        </tr>
                        <?php $__empty_1 = true; $__currentLoopData = $prescription_tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tests): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($tests->Test->test_name); ?></td>
                                <td>
                                    <!-- décoder sous le format json-->
                                    <?php
                                        $diagnosticType = json_decode($tests->Test->diagnostic_type);
                                    ?>

                                    <?php if(is_array($diagnosticType)): ?>
                                        <?php $__currentLoopData = $diagnosticType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diagnostic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($diagnostic); ?>,
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php echo e($diagnosticType); ?>

                                    <?php endif; ?>
                                </td>
                                
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3">Aucun test disponible.</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                    <hr>
                </div>
            </div>
            <!-- END ROW : Tests List -->
        <?php endif; ?>
        <?php if(count($prescription_drugs) > 0): ?>
            <!-- ROW : Drugs List -->
            <div class="row justify-content-center">
                <div class="col">
                    <strong><u><?php echo e(__('sentence.Drug')); ?> : </u></strong><br><br>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nom Soin</th>
                            <th>Type Soin</th>
                            <th>Produits Soin</th>
                        </tr>
                        <?php $__empty_1 = true; $__currentLoopData = $prescription_drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td> <?php echo e($drug->type); ?> </td>
                                <td> <?php echo e($drug->Drug->trade_name); ?> </td>
                                <td>
                                    <?php
                                        $product = json_decode($drug->Drug->generic_name);
                                    ?>

                                    <?php if(is_array($product)): ?>
                                        <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label class="badge badge-primary-soft"><?php echo e($products); ?></label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php echo e($product); ?>

                                    <?php endif; ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3">Aucun Soin disponible.</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        <?php endif; ?>
        <!-- ROW : Footer informations -->
        <footer style="position: absolute; bottom: 0;">
            <hr>
            <?php if(!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right'))): ?>
                <!-- ROW : Footer informations -->
                <div class="row">
                    <div class="col">
                        <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                    </div>
                    <div class="col">
                        <p class="float-right font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                    </div>
                </div>
                <!-- END ROW : Footer informations -->
            <?php elseif(empty(App\Setting::get_option('footer_left'))): ?>
                <!-- ROW : Footer informations -->
                <div class="row">
                    <div class="col">
                        <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                    </div>
                </div>
                <!-- END ROW : Footer informations -->
            <?php elseif(empty(App\Setting::get_option('footer_right'))): ?>
                <!-- ROW : Footer informations -->
                <div class="row">
                    <div class="col">
                        <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                    </div>
                </div>
                <!-- END ROW : Footer informations -->
            <?php else: ?>
            <?php endif; ?>
        </footer>
        <!-- END ROW : Footer informations -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <style type="text/css">
        p,
        u,
        li {
            color: #444444 !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gille\workspace\gestion-des-soin-laravel\resources\views/prescription/view.blade.php ENDPATH**/ ?>