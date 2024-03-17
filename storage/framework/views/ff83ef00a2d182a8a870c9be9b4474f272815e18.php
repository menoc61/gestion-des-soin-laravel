

<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Billing List')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <!-- DataTables  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.Billing List')); ?></h6>
                </div>
                <div class="col-4">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
                        <a href="<?php echo e(route('billing.create')); ?>" class="btn btn-primary btn-sm float-right"><i
                                class="fa fa-plus"></i> <?php echo e(__('sentence.Create Invoice')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><?php echo e(__('sentence.Reference')); ?>

                                <a href="<?php echo e(route('billing.all', ['sort' => 'reference', 'order' => 'asc'])); ?>"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="<?php echo e(route('billing.all', ['sort' => 'reference', 'order' => 'desc'])); ?>"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th><?php echo e(__('sentence.Patients')); ?> </th>
                            <th><?php echo e(__('sentence.Doctors')); ?> </th>
                            <th><?php echo e(__('sentence.Date')); ?>

                                <a href="<?php echo e(route('billing.all', ['sort' => 'created_at', 'order' => 'asc'])); ?>"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="<?php echo e(route('billing.all', ['sort' => 'created_at', 'order' => 'desc'])); ?>"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th class="text-center"><?php echo e(__('sentence.Amount')); ?> - <font class="text-danger">
                                    <?php echo e(__('sentence.Due Balance')); ?></font>
                                <a href="<?php echo e(route('billing.all', ['sort' => 'due_amount', 'order' => 'asc'])); ?>"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="<?php echo e(route('billing.all', ['sort' => 'due_amount', 'order' => 'desc'])); ?>"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th class="text-center"><?php echo e(__('sentence.Status')); ?></th>
                            <th class="text-center"><?php echo e(__('sentence.Payment Method')); ?></th>
                            <th><?php echo e(__('sentence.Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($invoice->reference); ?></td>
                                <td><a href="<?php echo e(url('patient/view/' . $invoice->user_id)); ?>"> <?php echo e($invoice->User->name); ?>

                                    </a></td>
                                <td> <?php echo e($invoice->UserSessions->name); ?> </a></td>
                                <td><?php echo e($invoice->created_at->format('d M Y h:m:s')); ?></td>
                                <td class="text-center"> <?php echo e($invoice->total_with_tax); ?>

                                    
                                    <?php if($invoice->payment_status == 'Unpaid' or $invoice->payment_status == 'Partially Paid'): ?>
                                        <label class="badge badge-danger-soft"><?php echo e($invoice->due_amount); ?></label>
                                        
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if($invoice->payment_status == 'Unpaid'): ?>
                                        <label class="badge badge-danger-soft">
                                            <i class="fas fa-hourglass-start"></i> <?php echo e(__('sentence.Unpaid')); ?>

                                        </label>
                                    <?php elseif($invoice->payment_status == 'Paid'): ?>
                                        <label class="badge badge-success-soft">
                                            <i class="fas fa-check"></i> <?php echo e(__('sentence.Paid')); ?>

                                        </label>
                                    <?php elseif($invoice->payment_status == 'Partially Paid'): ?>
                                        <label class="badge badge-warning-soft">
                                            <i class="fas fa-hourglass-start"></i> <?php echo e(__('sentence.Partially Paid')); ?>

                                        </label>
                                    <?php else: ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><label class="badge badge-primary-soft"><i
                                            class="fa fa-handshake"></i> <?php echo e($invoice->payment_mode); ?></label></td>
                                <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view invoice')): ?>
                                        <a href="<?php echo e(url('billing/view/' . $invoice->id)); ?>"
                                            class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
                                        <a href="<?php echo e(url('billing/edit/' . $invoice->id)); ?>"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice')): ?>
                                        <a data-toggle="modal" data-target="#DeleteModal"
                                            data-link="<?php echo e(url('billing/delete/' . $invoice->id)); ?>"
                                            class="btn btn-outline-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                               <td colspan="9" class="text-center"><img src="<?php echo e(asset('img/not-found.svg')); ?>" width="200" /> <br><br> <b class="text-muted">Aucune facture trouvé</b></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <span class="float-right mt-3"><?php echo e($invoices->links()); ?></span>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gille\workspace\gestion-des-soin-laravel\resources\views/billing/all.blade.php ENDPATH**/ ?>