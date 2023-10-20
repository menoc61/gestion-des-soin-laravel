<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="gillemomeni">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <title>Gestion soin - @yield('title') </title>
    <!-- Custom styles for this template-->
    <!-- Custom fonts for this template-->
    <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"
        media="all">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" media="all">


    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/css/gijgo.min.css') }}" rel="stylesheet" media="all">

    <script>
        "use strict";
        const SITE_URL = "{{ url('/') }}";
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    @yield('header')


</head>

<body id="page-top">
    <div id="app">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav custom-colors sidebar sidebar-dark accordion" id="accordionSidebar">
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                    <div class="sidebar-brand-icon rotate-n-15 d-none d-lg-block d-xl-none">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3"><img src="{{ asset('img/logo.png') }}" class="img-fluid"></div>
                </a>
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>{{ __('sentence.Dashboard') }}</span></a>
                </li>
                @if (Auth::user()->can('add patient') || Auth::user()->can('view all patients'))
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        {{ __('sentence.Patients') }}
                    </div>
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapsePatient" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-user-injured"></i>
                            <span>{{ __('sentence.Patients') }}</span>
                        </a>
                        <div id="collapsePatient" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                @can('add patient')
                                    <a class="collapse-item"
                                        href="{{ route('patient.create') }}">{{ __('sentence.New Patient') }}</a>
                                @endcan
                                @can('view all patients')
                                    <a class="collapse-item"
                                        href="{{ route('patient.all') }}">{{ __('sentence.All Patients') }}</a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endif


                {{-- Code concernant le Module Rendez-Vous sur la Sidenav --}}

                {{-- @if (Auth::user()->can('create appointment') || Auth::user()->can('view all appointments') || Auth::user()->can('delete appointment'))
               <!-- Divider -->
               <hr class="sidebar-divider">
               <!-- Heading -->
               <div class="sidebar-heading">
                  {{ __('sentence.Appointment') }}
               </div>
               <!-- Nav Item - Pages Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAppointment" aria-expanded="true" aria-controls="collapseAppointment">
                  <i class="fas fa-fw fa-calendar-plus"></i>
                  <span>{{ __('sentence.Appointment') }}</span>
                  </a>
                  <div id="collapseAppointment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        @can('create appointment')
                        <a class="collapse-item" href="{{ route('appointment.create') }}">{{ __('sentence.New Appointment') }}</a>
                        @endcan
                        @can('view all appointments')
                        <a class="collapse-item" href="{{ route('appointment.pending') }}">{{ __('sentence.Upcoming Appointments') }}</a>

                        <a class="collapse-item" href="{{ route('appointment.all') }}">{{ __('sentence.All Appointments') }}</a>
                        @endcan
                     </div>
                  </div>
               </li>
               @endif --}}


                @if (Auth::user()->can('create diagnostic test') ||
                        Auth::user()->can('edit diagnostic test') ||
                        Auth::user()->can('view all diagnostic tests'))
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        {{ __('sentence.Prescriptions') }}
                    </div>
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTests"
                            aria-expanded="true" aria-controls="collapseTests">
                            <i class="fas fa-fw fa-heartbeat"></i>
                            <span>{{ __('sentence.Tests') }}</span>
                        </a>
                        <div id="collapseTests" class="collapse" aria-labelledby="headingPages"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                @can('create diagnostic test')
                                    <a class="collapse-item"
                                        href="{{ route('test.create') }}">{{ __('sentence.Add Test') }}</a>
                                @endcan
                                @can('view all diagnostic tests')
                                    <a class="collapse-item"
                                        href="{{ route('test.all') }}">{{ __('sentence.All Tests') }}</a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endif



                @if (Auth::user()->can('create prescription') ||
                        Auth::user()->can('view all prescriptions') ||
                        Auth::user()->can('view prescription') ||
                        Auth::user()->can('view prescription'))
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-prescription"></i>
                            <span>{{ __('sentence.Prescriptions') }}</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                @can('create prescription')
                                    <a class="collapse-item"
                                        href="{{ route('prescription.create') }}">{{ __('sentence.New Prescription') }}</a>
                                @endcan
                                @can('view all prescriptions')
                                    <a class="collapse-item"
                                        href="{{ route('prescription.all') }}">{{ __('sentence.All Prescriptions') }}</a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endif


                @if (Auth::user()->can('create drug') ||
                        Auth::user()->can('view all drugs') ||
                        Auth::user()->can('view drug') ||
                        Auth::user()->can('edit drug'))
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages"
                            aria-expanded="true" aria-controls="collapsePages">
                            <i class="fas fa-fw fa-pills"></i>
                            <span>{{ __('sentence.Drugs') }}</span>
                        </a>
                        <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                @can('create drug')
                                    <a class="collapse-item"
                                        href="{{ route('drug.create') }}">{{ __('sentence.Add Drug') }}</a>
                                @endcan
                                @can('view all drugs')
                                    <a class="collapse-item"
                                        href="{{ route('drug.all') }}">{{ __('sentence.All Drugs') }}</a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endif


                @if (Auth::user()->can('create invoice') ||
                        Auth::user()->can('edit invoice') ||
                        Auth::user()->can('view invoice') ||
                        Auth::user()->can('view all invoices'))
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        {{ __('sentence.Billings') }}
                    </div>
                    <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseBilling" aria-expanded="true" aria-controls="collapseBilling">
                            <i class="fas fa-fw fa-dollar-sign"></i>
                            <span>{{ __('sentence.Billings') }}</span>
                        </a>
                        <div id="collapseBilling" class="collapse" aria-labelledby="headingUtilities"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                @can('create invoice')
                                    <a class="collapse-item"
                                        href="{{ route('billing.create') }}">{{ __('sentence.Create Invoice') }}</a>
                                @endcan
                                @can('view all invoices')
                                    <a class="collapse-item"
                                        href="{{ route('billing.all') }}">{{ __('sentence.Billing List') }}</a>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endif

                @if (Auth::user()->can('manage roles'))
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        {{ __('sentence.Users & Roles') }}
                    </div>
                    <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-fw fa-users"></i>
                            <span>{{ __('sentence.Users Management') }}</span>
                        </a>
                        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item"
                                    href="{{ route('user.create') }}">{{ __('sentence.Create User') }}</a>
                                <a class="collapse-item"
                                    href="{{ route('user.all') }}">{{ __('sentence.All Users') }}</a>
                                <a class="collapse-item"
                                    href="{{ route('roles.all') }}">{{ __('sentence.Roles & Permissions') }}</a>
                            </div>
                        </div>
                    </li>
                @endif

                @if (Auth::user()->can('manage settings'))
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        {{ __('sentence.Settings') }}
                    </div>
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSettings"
                            aria-expanded="true" aria-controls="collapseSettings">
                            <i class="fas fa-fw fa-cogs"></i>
                            <span>{{ __('sentence.Settings') }}</span>
                        </a>
                        <div id="collapseSettings" class="collapse" aria-labelledby="headingPages"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item"
                                    href="{{ route('doctorino_settings.edit') }}">{{ __('sentence.Doctorino Settings') }}</a>
                                <a class="collapse-item"
                                    href="{{ route('prescription_settings.edit') }}">{{ __('sentence.Prescription Settings') }}</a>
                                <a class="collapse-item"
                                    href="{{ route('sms_settings.edit') }}">{{ __('sentence.SMS Gateway Setup') }}</a>
                            </div>
                        </div>
                    </li>
                @endif

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            </ul>
            <!-- End of Sidebar -->
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <div class="dropdown shortcut-menu mr-4">
                            <button type="button" class="btn btn-doctorino brd-20 dropdown-toggle"
                                data-toggle="dropdown" aria-expanded="false">
                                {{ __('sentence.Create as new') }} </button>
                            <div class="dropdown-menu shadow">
                                @if (Auth::user()->can('add patient'))
                                    <a class="dropdown-item"
                                        href="{{ route('patient.create') }}">{{ __('sentence.Patient') }}</a>
                                @endif
                                @if (Auth::user()->can('create diagnostic test'))
                                    <a class="dropdown-item"
                                        href="{{ route('test.create') }}">{{ __('sentence.Test') }}</a>
                                @endif
                                @if (Auth::user()->can('create prescription'))
                                    <a class="dropdown-item"
                                        href="{{ route('prescription.create') }}">{{ __('sentence.Prescription') }}</a>
                                @endif
                                @if (Auth::user()->can('create drug'))
                                    <a class="dropdown-item"
                                        href="{{ route('drug.create') }}">{{ __('sentence.Drug') }}</a>
                                @endif
                                {{-- Module pour créer une facture depuis la navbar --}}

                                {{-- @if (Auth::user()->can('create appointment'))
                                    <a class="dropdown-item"
                                        href="{{ route('appointment.create') }}">{{ __('sentence.Appointment') }}</a>
                                @endif --}}
                                @if (Auth::user()->can('create invoice'))
                                    <a class="dropdown-item"
                                        href="{{ route('billing.create') }}">{{ __('sentence.Invoice') }}</a>
                                @endif
                            </div>
                        </div>

                        @can('view all patients')
                            <form
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                                action="{{ route('patient.search') }}" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2"
                                        name="term">
                                    @csrf
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endcan

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-900 small-600">{{ Auth::user()->name }}</span>
                                    <img class="img-profile rounded-circle" src="{{ asset('img/favicon.png') }}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">

                                    <a class="dropdown-item"
                                        href="{{ route('patient.view', ['id' => Auth::user()->id]) }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('sentence.View Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.edit_profile') }}">
                                        <i class="fas fa-pen fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('sentence.Update Profile') }}
                                    </a>
                                    @if (Auth::user()->can('manage settings'))
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('doctorino_settings.edit') }}">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{ __('sentence.Doctorino Settings') }}
                                        </a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('sentence.Logout') }}
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->
                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>



                        @yield('content')



                        <!-- Page Heading -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright my-auto">
                            <span>Copyright &copy; Created by <a href="https://digit-tech-innov.com/" target="_blank">
                                    DIGIT-TECH-INNOV SARL</a> {{ date('Y') }}</span>
                            <span style="float: right;">Version 1.0</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('sentence.Ready to Leave') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">{{ __('sentence.Ready to Leave Msg') }}</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button"
                        data-dismiss="modal">{{ __('sentence.Cancel') }}</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('sentence.Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Modal-->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('sentence.Delete') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">{{ __('sentence.Delete Alert') }}</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button"
                        data-dismiss="modal">{{ __('sentence.Cancel') }}</button>
                    <a class="btn btn-danger" id="delete_link">{{ __('sentence.Delete') }}</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('dashboard/js/vue.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap core JavaScript-->
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('dashboard/js/gijgo.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dashboard/js/jquery.repeatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dashboard/js/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('https://jasonday.github.io/printThis/printThis.js') }}"></script>

    <script src="{{ asset('js/custom.js') }}"></script>


    @if (session('success'))
        <script type="text/javascript">
            $.notify({
                message: "<?php echo session('success'); ?>"
            }, {
                type: "success",
                delay: 5000,
            });
        </script>
    @endif

    @if (session('danger'))
        <script type="text/javascript">
            $.notify({
                message: "<?php echo session('danger'); ?>"
            }, {
                type: "danger",
                delay: 5000,
            });
        </script>
    @endif

    @if (session('warning'))
        <script type="text/javascript">
            $.notify({
                message: "<?php echo session('warning'); ?>"
            }, {
                type: "warning",
                delay: 5000,
            });
        </script>
    @endif

    @yield('footer')

</body>

</html>
