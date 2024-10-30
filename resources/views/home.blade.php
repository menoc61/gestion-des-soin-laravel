@extends('layouts.master')

@section('title')
    {{ __('sentence.Dashboard') }}
@endsection

@section('content')


    @role('Hôte')
    @if (Auth::user()->role_id == 3)
        <div class="row top">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-primary shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-primary col-md-9">
                        <div class="col-auto">
                            <center><a href="{{ url('patient/view/' . Auth::user()->id) }}"><i class="fas fa-pills fa-2x text-gray-300"></i></a></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <a href="{{ url('patient/view/' . Auth::user()->id) }}">Montant des dépenses</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_amount_for_hote }} fcfa
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- carte contenant le nommbre total de rendez-vous --}}
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-warning shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-warning col-md-9">
                        <div class="col-auto">
                            <center><a class="nav-link active" id="appointements-tab" data-toggle="tab"
                            href="{{ url('patient/view/' . Auth::user()->id) }}" role="tab" aria-controls="appointements"
                            aria-selected="false"><i class="fa fa-wallet fa-2x text-gray-300"></i></a></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                <a href="{{ url('patient/view/' . Auth::user()->id) }}">{{ __('sentence.Total Appointments') }}</a> </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $appointmentHote }}</div>
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
                            <center><a href="{{ url('patient/view/' . Auth::user()->id) }}"><i class="fas fa-user-plus fa-2x text-gray-300"></i></a></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <a href="{{ url('patient/view/' . Auth::user()->id) }}">{{ __('sentence.Tests Number') }}</a></div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            {{ $diagnoseHote }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nombre de traitement fait par un praticien précis -->
            <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-secondary shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-secondary col-md-9">
                        <div class="col-auto">
                            <center><a href="{{ url('patient/view/' . Auth::user()->id) }}"><i class="fas fa-users fa-2x text-gray-300"></i></a></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                <a href="{{ url('patient/view/' . Auth::user()->id) }}">{{ __('sentence.Prescription Number') }}</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $prescriptionHote }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endif
    @endrole



    <!-- Afficher les rendez-vous du jour au niveau de la page d'accueil -->
    @role('Admin|Praticien')
        <div class="row ">
            <div class="col-md-6">
                <input type="date" onchange="StartDateFilter(this)" value={{ $defaultStartDate }}>
                <input type="date" onchange="EndDateFilter(this)" value={{ $defaultEndDate }}>
            </div>
            <div class="col-md-6">
                <div class="wrapper">
                    <div class="notification_wrap float-right">
                        <div class="posi float-right btn btn-secondary rounded-circle">
                            <span><i class="fas fa-bell"></i></span>
                            <div class="btn btn-danger rounded-circle posi_value">{{ $countRDVread }}</div>
                        </div>
                        <div class="dropdown">
                            <tr>
                                <td class="text-center "><b>Notification Rendez-Vous</b></td>
                            </tr>
                            @forelse ($appointments as $appointment)
                                <div class="row notify_item d-flex justify-content-center">
                                    <div class="card w-100 ">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <td>Nom</td>
                                                            <td>Action</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="text-center">
                                                            <td><span class="badge badge-primary-soft"><a
                                                                        href="{{ url('patient/view/' . $appointment->User->id) }}">
                                                                        {{ $appointment->User->name }} </a></span></td>
                                                            <td><a class="btn btn-outline-success btn-circle btn-sm view-details-btn"
                                                                    data-id="{{ $appointment->id }}"
                                                                    data-date="{{ $appointment->date->format('d M Y') }}"
                                                                    data-time="{{ $appointment->time_start }} - {{ $appointment->time_end }}"
                                                                    data-doctor="{{ $appointment->Doctor->name }}"
                                                                    data-read="{{ $appointment->is_read }}"
                                                                    data-visited="{{ $appointment->visited }}"
                                                                    data-prescription="{{ $appointment->Prescription ? $appointment->Prescription->nom : '' }}"
                                                                    data-drugs="{{ $appointment->drugs->pluck('trade_name')->implode(', ') }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endrole

    @role('Admin')
        {{-- <div class="row top"> --}}
        <div class="row top">
            {{-- carte contenant le nombre de rendez vous du mois en cour --}}
            <!-- Tasks Card Example -->
            <div class="col-xl-2 col-md-4 mb-4 taille marge">
                <div class="card border-bottom-primary shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-primary col-md-9">
                        <div class="col-auto">
                            <center><a class="collapse-item" href="{{ route('appointment.all') }}"><i class="fa fa-wallet fa-2x text-gray-300"></i></a></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <a class="collapse-item" href="{{ route('appointment.all') }}">Rendez-vous</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_appointments">
                                    {{ $total_appointments }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- carte contenant le nommbre total de patients enregistrés du mois en cour --}}
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-success shadow h-100 py-2 card-po1">
                  
                    <div class="card-body shadow-lg card-po bg-success col-md-9">
                        <div class="col-auto">
                            <center><a class="collapse-item" href="{{ route('patient.create') }}"><i class="fa fa-user fa-2x text-gray-300"></i></a></center>
                        </div>
                    </div>
                  
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <a class="collapse-item" href="{{ route('patient.create') }}">total patient</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_patients">
                                    {{ $total_patients }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- carte contenant le nommbre de traitement du mois en cour --}}
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-primary shadow h-100 py-2 card-po1">
                    <div class="card-body shadow-lg card-po bg-primary col-md-9">
                        <div class="col-auto">
                            <center><a class="collapse-item" href="{{ route('prescription.all') }}"><i class="fas fa-pills fa-2x text-gray-300"></i></a></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <a class="collapse-item" href="{{ route('prescription.all') }}">Prescription</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_prescriptions">
                                   {{ $total_prescriptions }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- carte contenant le montant du chiffre d'affaire du mois en cour --}}
            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-success shadow h-100 py-2 card-po1 ">
                    <div class="card-body shadow-lg card-po bg-success col-md-9  ">
                        <div class="col-auto">
                            <center><a class="collapse-item" href="{{ route('billing.all') }}"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></a></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <a class="collapse-item" href="{{ route('billing.all') }}">{{ __('sentence.Payments this year') }} {{ date('Y') }}</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_payments">
                                    {{ $total_payments }}
                                    {{ App\Setting::get_option('currency') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-8">
                            <h6 class="m-0 font-weight-bold text-dark p-2">GRAPHE DES MONTANTS GENERES</h6>
                        </div>
                    </div>
                    <div class=""><canvas id="myAreaChart" width="100%"></canvas></div>
                </div>
            </div>
        </div>
    @endrole

    @role('Praticien')
        <div class="row top">
            {{-- carte contenant le nombre de rendez-vous qu'aura un praticien durant le mois en cour  --}}
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
                                    {{ __('sentence.New Appointments') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_appointments_today->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- carte contenant le montant qu'aura un praticien durant le mois en cour  --}}
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
                                    {{ __('sentence.Amount Generated') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_amount_for_pratician }} fcfa
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- carte contenant le nommbre total de rendez-vous --}}
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
                                    {{ __('sentence.Total Appointments') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_appointments }}</div>
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
                                    {{ __('sentence.Tests Number') }}</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            {{ $total_tests_for_pratician }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nombre de traitement fait par un praticien précis -->
            {{-- <div class="col-xl-2 col-md-6 mb-4 taille marge">
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
                                    {{ __('sentence.Prescription Number') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_prescriptions_for_pratician }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    @endrole

    @role('Admin|Praticien')
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row mb-4">
                            <div class="col-8">
                                <h6 class="m-0 font-weight-bold text-dark w-75 p-2">
                                    {{ __('sentence.New Appointments') }} -
                                    {{ Today()->format('d M Y') }}</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead class=>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">{{ __('sentence.Patient Name') }}</th>
                                        <th class="text-center">{{ __('sentence.Schedule Info') }}</th>
                                        <th class="text-center">{{ __('sentence.Status') }}</th>
                                        <th class="text-center">{{ __('sentence.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($total_appointments_today as $key => $appointment)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td><b>{{ $appointment->User->name }}</b> </td>
                                            {{-- <td ><a
                                                        href="{{ url('patient/view/' . $appointment->user_id) }}">
                                                        {{ $appointment->User->name }} </a></td> --}}
                                            <td class="text-center">
                                                <label class="badge badge-dark-soft">
                                                    <i class="fa fa-clock"></i> {{ $appointment->time_start }} -
                                                    {{ $appointment->time_end }}
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                @if ($appointment->visited == 0)
                                                    <label class="badge badge-warning-soft">
                                                        <i class="fas fa-hourglass-start"></i>
                                                        {{ __('sentence.Not Yet Visited') }}
                                                    </label>
                                                @elseif($appointment->visited == 1)
                                                    <label class="badge badge-success-soft">
                                                        <i class="fas fa-check"></i> {{ __('sentence.Visited') }}
                                                    </label>
                                                @else
                                                    <label class="badge badge-danger-soft">
                                                        <i class="fas fa-user-times"></i> {{ __('sentence.Cancelled') }}
                                                    </label>
                                                @endif
                                            </td>
                                            {{-- <td class="text-center">{{ $appointment->created_at->format('d M Y H:i') }}
                                                </td> --}}
                                            {{-- <td class="text-center">
                                                @if ($appointment->visited == 1)
                                                    <label class="badge badge-primary-soft">
                                                        <i class="fas fa-calendar"></i>
                                                        {{ $appointment->updated_at->format('d M Y H:i') }}
                                                    </label>
                                                @endif
                                            </td> --}}
                                            <td align="center">
                                                @can('delete appointment')
                                                    @if ($appointment->visited != 1)
                                                        <a href="{{ url('appointment/delete/' . $appointment->id) }}"
                                                            class="btn btn-outline-danger btn-circle btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @endif
                                                @endcan
                                                @can('edit appointment')
                                                    <a data-rdv_id="{{ $appointment->id }}"
                                                        data-rdv_date="{{ $appointment->date->format('d M Y') }}"
                                                        data-rdv_time_start="{{ $appointment->time_start }}"
                                                        data-rdv_time_end="{{ $appointment->time_end }}"
                                                        data-patient_name="{{ $appointment->User->name }}"
                                                        class=" btn btn-outline-success btn-circle btn-sm
                                                    {{ $appointment->visited == 1 ? ' disabled opacity-button' : '' }}"
                                                        data-toggle="modal" data-target="#EDITRDVModal">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" align="center"><img src="{{ asset('img/rest.png') }} " />
                                                <br><br> <b class="text-muted">Vous n'avez pas de Rendez-Vous</b>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div class="card-footer">
                            {{ $total_appointments_today->links() }} <!-- Ajoutez cette ligne pour la pagination -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row mb-4">
                            <div class="col-8">
                                <h6 class="m-0 font-weight-bold text-dark w-75 p-2">
                                    Agenda de la Semaine</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>{{ __('sentence.Patient Name') }}</th>
                                        <th class="text-center">{{ __('sentence.Schedule Info') }}</th>
                                        <th class="text-center">{{ __('sentence.Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($agendaDoctors as $key => $appointment)
                                        <tr>
                                            {{-- <td><a href="{{ url('patient/view/' . $appointment->user_id) }}">
                                                    {{ $appointment->User->name }} </a></td> --}}
                                            <td><b>{{ $appointment->User->name }}</b> </td>
                                            <td class="text-center">
                                                <label class="badge badge-primary-soft text-dark">
                                                    <i class="fas fa-calendar"></i>
                                                    {{ $appointment->date->format('d M Y') }}
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                @if ($appointment->visited == 0)
                                                    <label class="badge badge-warning-soft">
                                                        <i class="fas fa-hourglass-start"></i>
                                                        {{ __('sentence.Not Yet Visited') }}
                                                    </label>
                                                @elseif($appointment->visited == 1)
                                                    <label class="badge badge-success-soft">
                                                        <i class="fas fa-check"></i> {{ __('sentence.Visited') }}
                                                    </label>
                                                @else
                                                    <label class="badge badge-danger-soft">
                                                        <i class="fas fa-user-times"></i>
                                                        {{ __('sentence.Cancelled') }}
                                                    </label>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" align="center"><img src="{{ asset('img/rest.png') }} " />
                                                <br><br> <b class="text-muted">Vous n'avez pas de Rendez-Vous</b>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div class="card-footer">
                            {{ $agendaDoctors->links() }} <!-- Ajoutez cette ligne pour la pagination -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewDetailsModal" tabindex="-1" role="dialog" aria-labelledby="viewDetailsModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="viewDetailsModalLabel">Détail du Rendez vous</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                {{-- <tr>
                                    <td><b>ID: </b></td>
                                    <td> <label class="badge badge-primary-soft" id="appointmentID"></label></td>
                                </tr>
                                <tr>
                                    <td><b>Consulter</b></td>
                                    <td> <label class="badge badge-primary-soft" id="appointmentRead"></label></td>
                                </tr> --}}
                                <tr>
                                    <td><b>{{ __('sentence.Praticien') }} : </b></td>
                                    <td> <label class="badge badge-primary-soft" id="appointmentDoctor"></label></td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('sentence.Date') }} : </b></td>
                                    <td><label class="badge badge-primary-soft" id="appointmentDate"></label></td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('sentence.Time Slot') }} : </b></td>
                                    <td><label class="badge badge-primary-soft" id="appointmentTime"></span></label></td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('sentence.Prescription') }} : </b></td>
                                    <td><label class="badge badge-primary-soft" id="appointmentPrescription"></span></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>{{ __('sentence.Drug') }} : </b></td>
                                    <td><span id="appointmentPrescriptiondrug"></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-primary text-white"
                            onclick="event.preventDefault(); document.getElementById('rdv-form').submit();"> Page de
                            l'hôte </a>
                        <form id="rdv-form" action="{{ route('appointment.store_edit') }}" method="POST" class="d-none">
                            <input type="hidden" name="rdv_id" id="rdvId">
                            <input type="hidden" name="is_read" value="1">
                            <input type="hidden" name="rdv_status" id="rdvStatus">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endrole

@endsection

@section('header')
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard/vendor/chart.js/Chart.bundle.js"></script>

    <script>
        var startDate = null;
        var endDate = null;

        function StartDateFilter(input) {
            startDate = input.value;
            updateData();
        }

        function EndDateFilter(input) {
            endDate = input.value;
            updateData();
        }

        function updateData() {
            if (!startDate || !endDate) {
                return; // Vérifier que les deux dates sont sélectionnées
            }

            // Requête AJAX pour récupérer les données filtrées
            $.ajax({
                url: '/home', // Remplacez par l'URL de votre route
                method: 'GET',
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                success: function(response) {
                    // Mettre à jour les données de la page avec la réponse reçue
                    $('#total_appointments').text(response.total_appointments);
                    $('#total_patients').text(response.total_patients);
                    $('#total_prescriptions').text(response.total_prescriptions);
                    $('#total_payments').text(response.total_payments);
                },
                error: function(error) {
                    console.error("Erreur lors de la récupération des données : ", error);
                }
            });
        }
    </script>

    <script type="text/javascript">
        var _ydata = JSON.parse('{!! json_encode($days) !!}');
        var _xdata = JSON.parse('{!! json_encode($totalAmounts) !!}');
        // var visitedCount = {{ $visitedCount }};
        // var nonVisitedCount = {{ $nonVisitedCount }};
        // var allAppointment = {{ $allAppointment }}
    </script>

    <script>
        $(document).ready(function() {
            $('.view-details-btn').on('click', function() {
                var id = $(this).data('id');
                var date = $(this).data('date');
                var time = $(this).data('time');
                var doctor = $(this).data('doctor');
                var prescription = $(this).data('prescription');
                var drugs = $(this).data('drugs');
                var read = $(this).data('read');
                var visited = $(this).data('visited');


                $('#appointmentDate').text(date);
                $('#appointmentTime').text(time);
                $('#appointmentRead').text(read);
                $('#appointmentID').text(id);
                $('#appointmentDoctor').text(doctor);
                $('#appointmentPrescription').text(prescription);

                // Clear previous drug badges
                $('#appointmentPrescriptiondrug').empty();

                // Split drugs string into an array and create badges
                var drugArray = drugs.split(', ');
                drugArray.forEach(function(drug) {
                    var badge = $('<label>').addClass('badge badge-primary-soft').text(drug);
                    $('#appointmentPrescriptiondrug').append(badge).append(' ');
                });

                $('#rdvId').val(id);
                $('#rdvStatus').val(visited);

                $('#viewDetailsModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".posi").click(function() {
                $(".dropdown").toggleClass("active");
            });
        });
    </script>

    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-polarArea-demo.js') }}"></script>
@endsection
