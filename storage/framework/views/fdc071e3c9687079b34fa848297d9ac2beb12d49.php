<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    

    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'Admin')): ?>
        <div class="row top">

            

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-4 mb-4 taille marge">
                <div class="card border-bottom-primary shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-primary col-md-9">
                        <div class="col-auto">
                            <center><i class="fa fa-wallet fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <?php echo e(__('sentence.New Appointments')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_appointments_today->count()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-warning shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-warning col-md-9">
                        <div class="col-auto">
                            <center><i class="fa fa-wallet fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    <?php echo e(__('sentence.Total Appointments')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_appointments); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Tasks Card Example -->
            <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-info shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-info col-md-9">
                        <div class="col-auto">
                            <center><i class="fas fa-user-plus fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    <?php echo e(__('sentence.New Patients')); ?></div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo e($total_patients_today); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-secondary shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-secondary col-md-9">
                        <div class="col-auto">
                            <center><i class="fas fa-users fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    <?php echo e(__('sentence.All Patients')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_patients); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="row top">

             <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-primary shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-primary col-md-9">
                        <div class="col-auto">
                            <center><i class="fas fa-pills fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <?php echo e(__('sentence.Total Prescriptions')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_prescriptions); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-success shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-success col-md-9">
                        <div class="col-auto">
                            <center><i class="fa fa-wallet fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    <?php echo e(__('sentence.Total Payments')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_payments); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tasks Card Example -->
            <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-secondary shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-secondary col-md-9 ">
                        <div class="col-auto">
                            <center><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    <?php echo e(__('sentence.Payments this month')); ?></div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo e($total_payments_month); ?>

                                            <?php echo e(App\Setting::get_option('currency')); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-danger shadow h-100 py-2 card-po1 ">
                    <div class="card-body shadow-lg card-po bg-danger col-md-9  ">
                        <div class="col-auto">
                            <center><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    <?php echo e(__('sentence.Payments this year')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_payments_year); ?>

                                    <?php echo e(App\Setting::get_option('currency')); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 ">
                <div class="chart mb-4">
                        <div class="mt-5"><canvas id="myAreaChart" width="100%" height="40%"></canvas></div>
                </div>
            </div>
             <div class="col-md-5 ">
                <div class=" chart1 mb-4">
                    <div class="mt-5"><canvas id="myBarChart" width="100%" height="40%"></canvas></div>
                </div>
            </div>

        </div>
    <?php endif; ?>

    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'Praticien')): ?>
        <div class="row top">
            

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-success shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-success col-md-9">
                        <div class="col-auto">
                            <center><i class="fa fa-wallet fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    <?php echo e(__('sentence.New Appointments')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_appointments_today->count()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-success shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-success col-md-9">
                        <div class="col-auto">
                            <center><i class="fa fa-wallet fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    <?php echo e(__('sentence.Total Appointments')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_appointments); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Tasks Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-info shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-info col-md-9">
                        <div class="col-auto">
                            <center><i class="fas fa-user-plus fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    <?php echo e(__('sentence.New Patients')); ?></div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo e($total_patients_today); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-warning shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-warning col-md-9">
                        <div class="col-auto">
                            <center><i class="fas fa-users fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    <?php echo e(__('sentence.All Patients')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_patients); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-primary shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-primary col-md-9">
                        <div class="col-auto">
                            <center><i class="fas fa-pills fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <?php echo e(__('sentence.Total Prescriptions')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_prescriptions); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <!-- Afficher les rendez-vous du jour au niveau de la page d'accueil -->

    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'Admin|Praticien')): ?>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.New Appointments')); ?> -
                                    <?php echo e(Today()->format('d M Y')); ?></h6>
                            </div>
                            <div class="col-4">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all appointments')): ?>
                                    <a href="<?php echo e(route('appointment.all')); ?>" class="btn btn-primary btn-sm float-right"><i
                                            class="fas fa-calendar"></i> <?php echo e(__('sentence.All Appointments')); ?></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create appointment')): ?>
                                    <a href="<?php echo e(route('appointment.create')); ?>"
                                        class="btn btn-primary btn-sm float-right mr-2"><i class="fa fa-plus"></i>
                                        <?php echo e(__('sentence.New Appointment')); ?></a>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th><?php echo e(__('sentence.Patient Name')); ?></th>
                                        <th><?php echo e(__('sentence.Date')); ?></th>
                                        <th><?php echo e(__('sentence.Time Slot')); ?></th>
                                        <th class="text-center"><?php echo e(__('sentence.Status')); ?></th>
                                        <th class="text-center"><?php echo e(__('sentence.Created at')); ?></th>
                                        <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $total_appointments_today; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($appointment->id); ?></td>
                                            <td>
                                                <a href="<?php echo e(url('patient/view/' . $appointment->user_id)); ?>">
                                                    <?php echo e($appointment->User->name); ?> </a>
                                            </td>
                                            <td>
                                                <label class="badge badge-primary-soft"><i class="fas fa-calendar"></i>
                                                    <?php echo e($appointment->date->format('d M Y')); ?> </label>
                                            </td>
                                            <td>
                                                <label class="badge badge-primary-soft"><i class="fa fa-clock"></i>
                                                    <?php echo e($appointment->time_start); ?> - <?php echo e($appointment->time_end); ?></label>
                                            </td>
                                            <td class="text-center">
                                                <?php if($appointment->visited == 0): ?>
                                                    <label class="badge badge-warning-soft">
                                                        <i class="fas fa-hourglass-start"></i>
                                                        <?php echo e(__('sentence.Not Yet Visited')); ?>

                                                    </label>
                                                <?php elseif($appointment->visited == 1): ?>
                                                    <label class="badge badge-success-soft">
                                                        <i class="fas fa-check"></i> <?php echo e(__('sentence.Visited')); ?>

                                                    </label>
                                                <?php else: ?>
                                                    <label class="badge badge-danger-soft">
                                                        <i class="fas fa-user-times"></i> <?php echo e(__('sentence.Cancelled')); ?>

                                                    </label>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"><?php echo e($appointment->created_at->format('d M Y H:i')); ?></td>
                                            <td align="center">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit appointment')): ?>
                                                    <a data-rdv_id="<?php echo e($appointment->id); ?>"
                                                        data-rdv_date="<?php echo e($appointment->date->format('d M Y')); ?>"
                                                        data-rdv_time_start="<?php echo e($appointment->time_start); ?>"
                                                        data-rdv_time_end="<?php echo e($appointment->time_end); ?>"
                                                        data-patient_name="<?php echo e($appointment->User->name); ?>"
                                                        class="btn btn-outline-success btn-circle btn-sm" data-toggle="modal"
                                                        data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete appointment')): ?>
                                                    <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                                        data-target="#DeleteModal"
                                                        data-link="<?php echo e(url('appointment/delete/' . $appointment->id)); ?>"><i
                                                            class="fas fa-trash"></i></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="7" align="center"><img src="<?php echo e(asset('img/rest.png')); ?> " />
                                                <br><br> <b class="text-muted">You have no appointment today</b></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- EDIT Appointment Modal-->
    <div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <?php echo e(__('sentence.You are about to modify an appointment')); ?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b><?php echo e(__('sentence.Patient')); ?> :</b> <span id="patient_name"></span></p>
                    <p><b><?php echo e(__('sentence.Date')); ?> :</b> <label class="badge badge-primary-soft" id="rdv_date"></label>
                    </p>
                    <p><b><?php echo e(__('sentence.Time Slot')); ?> :</b> <label class="badge badge-primary-soft"
                            id="rdv_time"></span></label>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button"
                        data-dismiss="modal"><?php echo e(__('sentence.Close')); ?></button>
                    <a class="btn btn-primary text-white"
                        onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();"><?php echo e(__('sentence.Confirm Appointment')); ?></a>
                    <form id="rdv-form-confirm" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST"
                        class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id">
                        <input type="hidden" name="rdv_status" value="1">
                        <?php echo csrf_field(); ?>
                    </form>
                    <a class="btn btn-primary text-white"
                        onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();"><?php echo e(__('sentence.Cancel Appointment')); ?></a>
                    <form id="rdv-form-cancel" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST"
                        class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id2">
                        <input type="hidden" name="rdv_status" value="2">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard/vendor/chart.js/Chart.bundle.js"></script>
    <script type="text/javascript">
        var _ydata = JSON.parse('<?php echo json_encode($months); ?>');
        var _xdata = JSON.parse('<?php echo json_encode($totalAmounts); ?>');
    </script>
    <script src="<?php echo e(asset('assets/demo/chart-bar-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/demo/chart-area-demo.js')); ?>"></script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\gille\workspace\gestion-des-soin-laravel\resources\views/home.blade.php ENDPATH**/ ?>