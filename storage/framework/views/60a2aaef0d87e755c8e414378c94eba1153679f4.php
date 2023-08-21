<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.Edit role')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="row justify-content-center">                  

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Edit role')); ?></h6>
                </div>
                <div class="card-body">
                 <form method="post" action="<?php echo e(route('role.store_edit_role')); ?>">
                    <div class="form-group row">
                      <label for="Name" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Name')); ?><font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="Name" name="name" value="<?php echo e($role->name); ?>">
                        <input type="hidden" class="form-control" name="role_id" value="<?php echo e($role->id); ?>">
                        <?php echo e(csrf_field()); ?>

                      </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                      <label for="Email" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Permissions')); ?><font color="red">*</font></label>
                      <div class="col-sm-9">
                        <select id="example-multiple-selected" multiple="multiple" name="permissions[]">
                          <?php $__empty_1 = true; $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <option value="<?php echo e($permission->name); ?>" <?php if($role->hasPermissionTo($permission->id)): ?> selected="selected" <?php endif; ?>><?php echo e($permission->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <?php endif; ?>
                           
                        </select>
                        <hr>
                          <?php $__empty_1 = true; $__currentLoopData = $role->permissions->pluck('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <label class="badge badge-success-soft"><?php echo e(ucfirst($permission)); ?></label> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>  
                        <label class="badge badge-warning-soft">No permissions for <?php echo e($role->name); ?></label> 
                        <?php endif; ?>
                      </div>
                    </div>

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
<link rel="stylesheet" type="text/css" href="https://davidstutz.github.io/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<script type="text/javascript" src="https://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
<!-- Initialize the plugin: -->
<script type="text/javascript">
    $('#example-multiple-selected').multiselect();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v3.4\resources\views/user/edit_role.blade.php ENDPATH**/ ?>