<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.All users')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
               <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.All Users')); ?></h6>
                </div>
                <div class="col-4">
                  <a href="<?php echo e(route('user.create')); ?>" class="btn btn-primary btn-sm float-right "><i class="fa fa-plus"></i> <?php echo e(__('sentence.New User')); ?></a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th><?php echo e(__('sentence.Name')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Email')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Register Date')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Roles')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($user->id); ?></td>
                      <td><a href="<?php echo e(url('patient/view/'.$user->id)); ?>"> <?php echo e($user->name); ?> </a></td>
                      <td class="text-center"> <?php echo e($user->email); ?> </td>
                      <td class="text-center"><label class="badge badge-primary-soft"><?php echo e($user->created_at->format('d M Y H:i')); ?></label></td>
                      <td class="text-center">
                        <?php $__empty_1 = true; $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <label class="badge badge-warning-soft"><?php echo e(ucfirst($role)); ?></label> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>  
                        <label class="badge badge-warning-soft">no role for <?php echo e($user->name); ?></label> 
                        <?php endif; ?>
                      </td>
                      <td class="text-center">
                        <a href="<?php echo e(url('patient/view/'.$user->id)); ?>" class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="<?php echo e(route('user.edit', ['id' => $user->id])); ?>" class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="#"><i class="fas fa-trash"></i></a>
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

  
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v4.0\resources\views/user/all.blade.php ENDPATH**/ ?>