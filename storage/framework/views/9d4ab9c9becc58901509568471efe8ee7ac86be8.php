<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.New Patient')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-center">
                  
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.New Patient')); ?></h6>
                </div>
                <div class="card-body">
                 <form method="post" action="<?php echo e(route('patient.create')); ?>" enctype="multipart/form-data">
                    <div class="form-group row">
                      <label for="Name" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Full Name')); ?><font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="Name" name="name">
                        <?php echo e(csrf_field()); ?>

                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Email" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Email Adress')); ?><font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" id="Email" name="email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="birthday" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Birthday')); ?><font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" id="Birthday" name="birthday" autocomplete="off">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Phone" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Phone')); ?></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="Phone" name="phone">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Gender" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Gender')); ?><font color="red">*</font></label>
                      <div class="col-sm-9">
                        <select class="form-control" name="gender" id="Gender">
                          <option value="Male"><?php echo e(__('sentence.Male')); ?></option>
                          <option value="Female"><?php echo e(__('sentence.Female')); ?></option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="Image" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Image')); ?></label>
                      <div class="col-sm-9">
                        <input type="file" class="form-control" id="Image" name="image">
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="Blood" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Blood Group')); ?></label>
                      <div class="col-sm-9">
                        <select class="form-control" name="blood" id="Blood">
                                            <option value="Unknown"><?php echo e(__('sentence.Unknown')); ?></option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Address" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Address')); ?></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="Address" name="adress">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="weight" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Patient Weight')); ?></label>
                      <div class="col-sm-9">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="weight" name="weight">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Kg</div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="Height" class="col-sm-3 col-form-label"><?php echo e(__('sentence.Patient Height')); ?></label>
                      <div class="col-sm-9">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="Height" name="height">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Cm</div>
                          </div>
                        </div>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v3.4\resources\views/patient/create.blade.php ENDPATH**/ ?>