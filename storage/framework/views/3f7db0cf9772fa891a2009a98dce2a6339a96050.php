<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create prescription')): ?>
        <div class="row">
            <div class="col">
                <div class="alert alert-warning">Simplifie la prescription et les rendez-vous, vous aidant à gérer les patients
                    et votre chambre de manière intelligente. <br><b><a href="<?php echo e(route('appointment.create')); ?>">enregistrez
                            votre premier rendez-vous</a></b> en moins de 60 secondes.</div>
            </div>
        </div>
    <?php endif; ?>

    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'Admin')): ?>
        <div class="row top">

            

            <!-- Earnings (Monthly) Card Example -->
            



            

            <!-- Earnings (Annual) Card Example -->
            


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


        <div class="row top">
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
                                    <?php echo e(__('sentence.Total Payments')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_payments); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tasks Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 taille marge">
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
            <div class="col-xl-3 col-md-6 mb-4 taille marge">
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

            <div class="col-xl-5">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class=" fas fa-chart-bar "> Chiffre d'affaire par mois </i>
                    </div>
                    <div class="card-body">
                        <canvas id="myBarChart" width="100%" height="40%"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-5">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar "> Test Line</i>
                    </div>
                    <div class="card-body">
                        <canvas id="myAreaChart" width="100%" height="40%"></canvas>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'Praticien')): ?>
        <div class="row top">
            <!-- Earnings (Monthly) Card Example -->
            

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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\HS\gestion-des-soin-laravel\resources\views/home.blade.php ENDPATH**/ ?>