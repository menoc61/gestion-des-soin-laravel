<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.All Patients')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
               <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.All Patients')); ?></h6>
                </div>
                <div class="col-4">
                 <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="<?php echo e(route('patient.search')); ?>" method="post">
                        <div class="input-group">
                            <input type="text" name="term" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <?php echo csrf_field(); ?>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-2">
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add patient')): ?>
                  <a href="<?php echo e(route('patient.create')); ?>" class="btn btn-primary btn-sm float-right "><i class="fa fa-plus"></i> <?php echo e(__('sentence.New Patient')); ?></a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th><?php echo e(__('sentence.Patient Name')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Age')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Phone')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Blood Group')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Date')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Due Balance')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Prescriptions')); ?></th>
                      <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                      <td><?php echo e($patient->id); ?></td>
                      <td><a href="<?php echo e(url('patient/view/'.$patient->id)); ?>"> <?php echo e($patient->name); ?> </a></td>
                      <td class="text-center"> <?php echo e(@\Carbon\Carbon::parse($patient->Patient->birthday)->age); ?> </td>
                      <td class="text-center"> <?php echo e(@$patient->Patient->phone); ?> </td>
                      <td class="text-center"> <?php echo e(@$patient->Patient->blood); ?> </td>
                      <td class="text-center"><label class="badge badge-primary-soft"><?php echo e($patient->created_at->format('d M Y H:i')); ?></label></td>
                      <td class="text-center"><label class="badge badge-primary-soft"><?php echo e(Collect($patient->Billings)->where('payment_status','Partially Paid')->sum('due_amount')); ?> <?php echo e(App\Setting::get_option('currency')); ?></label></td>
                      <td class="text-center">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view patient')): ?>
                        <a href="<?php echo e(route('prescription.view_for_user', ['id' => $patient->id])); ?>" class="btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i> View</a>
                        <?php endif; ?>
                      </td>
                      <td class="text-center">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view patient')): ?>
                        <a href="<?php echo e(route('patient.view', ['id' => $patient->id])); ?>" class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
                        <a href="<?php echo e(route('patient.edit', ['id' => $patient->id])); ?>" class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete patient')): ?>
                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(route('patient.destroy' , ['id' => $patient->id ])); ?>"><i class="fas fa-trash"></i></a>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                      <td colspan="9"  align="center"><img src="<?php echo e(asset('img/rest.png')); ?> "/> <br><br> <b class="text-muted">No patients found!</b>
                        
                      </td>
                    </tr>
                    <?php endif; ?>
                   
                  </tbody>
                </table>
               <span class="float-right mt-3"><?php echo e($patients->links()); ?></span>

              </div>
            </div>
          </div>
<?php $__env->stopSection(); ?>

  
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\doctorino\v4.0\resources\views/patient/all.blade.php ENDPATH**/ ?>