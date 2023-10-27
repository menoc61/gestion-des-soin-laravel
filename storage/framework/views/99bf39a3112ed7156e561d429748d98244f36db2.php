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
                                            <td><?php echo e($tests->Test->comment); ?></td>
                                            <td>
                                                <?php if(is_array($diagnosticType)): ?>
                                                    <?php $__currentLoopData = $diagnosticType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diagnostic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($diagnostic === 'DIAGNOSE MAIN'): ?>
                                                        <?php elseif($diagnostic === 'DIAGNOSE PEAU'): ?>
                                                            <?php echo e($tests->Test->signes_particuliers_peau); ?>

                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
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