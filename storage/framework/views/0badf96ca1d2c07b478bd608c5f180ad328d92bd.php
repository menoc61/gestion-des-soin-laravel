<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.All Users')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.All Users')); ?></h6>
                </div>
                <div class="col-4">
                    <a href="<?php echo e(route('user.create')); ?>" class="btn btn-primary btn-sm float-right "><i class="fa fa-plus"></i>
                        <?php echo e(__('sentence.New User')); ?></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID
                                <a href="<?php echo e(route('user.all', ['sort' => 'id', 'order' => 'asc'])); ?>"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="<?php echo e(route('user.all', ['sort' => 'id', 'order' => 'desc'])); ?>"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th><?php echo e(__('sentence.Name')); ?>

                                <a href="<?php echo e(route('user.all', ['sort' => 'name', 'order' => 'asc'])); ?>"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="<?php echo e(route('user.all', ['sort' => 'name', 'order' => 'desc'])); ?>"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th class="text-center"><?php echo e(__('sentence.Email')); ?>

                                <a href="<?php echo e(route('user.all', ['sort' => 'email', 'order' => 'asc'])); ?>"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="<?php echo e(route('user.all', ['sort' => 'email', 'order' => 'desc'])); ?>"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th class="text-center"><?php echo e(__('sentence.Register Date')); ?>

                                <a href="<?php echo e(route('user.all', ['sort' => 'created_at', 'order' => 'asc'])); ?>"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="<?php echo e(route('user.all', ['sort' => 'created_at', 'order' => 'desc'])); ?>"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th class="text-center"><?php echo e(__('sentence.Roles')); ?></th>
                            <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($user->id); ?></td>
                                <td><a href="<?php echo e(url('patient/view/' . $user->id)); ?>"> <?php echo e($user->name); ?> </a></td>
                                <td class="text-center"> <?php echo e($user->email); ?> </td>
                                <td class="text-center"><label
                                        class="badge badge-primary-soft"><?php echo e($user->created_at->format('d M Y H:i')); ?></label>
                                </td>
                                <td class="text-center">
                                    <?php if($user->role): ?>
                                        <label class="badge badge-warning-soft"><?php echo e(ucfirst($user->role)); ?></label>
                                    <?php else: ?>
                                        <label class="badge badge-warning-soft">Hôte</label>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo e(url('patient/view/' . $user->id)); ?>"
                                        class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo e(route('user.edit', ['id' => $user->id])); ?>"
                                        class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                        data-target="#DeleteModal" data-link="#"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
                <span class="float-right mt-3"><?php echo e($users->links()); ?></span>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Desktop\gestion des soins\v1.0\resources\views/user/all.blade.php ENDPATH**/ ?>