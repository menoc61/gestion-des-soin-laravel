<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Edit User')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Edit User')); ?></h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo e(route('user.store_edit')); ?>">
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Full Name')); ?><font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Name" name="name"
                                    value="<?php echo e($user->name); ?>">
                                <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">

                                <?php echo e(csrf_field()); ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Email" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Email Adress')); ?><font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="Email" name="email"
                                    value="<?php echo e($user->email); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Password" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Password')); ?></label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="Password" name="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Phone" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Phone')); ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Phone" name="phone"
                                    value="<?php echo e(@$user->Patient->phone); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Gender" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Gender')); ?></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="gender" id="Gender">
                                    <option value="<?php echo e(@$user->Patient->gender); ?>" selected="selected">
                                        <?php echo e(@$user->Patient->gender); ?></option>
                                    <option value="Male"><?php echo e(__('sentence.Male')); ?></option>
                                    <option value="Female"><?php echo e(__('sentence.Female')); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Role')); ?></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="role" id="role">
                                    
                                    <option value="admin"><?php echo e(__('sentence.Admin')); ?></option>
                                    <option value="praticien"><?php echo e(__('sentence.Doctor')); ?></option>

                                    
                                </select>
                            </div>
                        </div>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\HS\gestion-des-soin-laravel\resources\views/user/edit.blade.php ENDPATH**/ ?>