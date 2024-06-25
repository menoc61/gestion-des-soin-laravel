@extends('layouts.master')

@section('title')
    {{ __('sentence.Dashboard') }}
@endsection

@section('content')
    {{-- @can('create prescription')
        <div class="row">
            <div class="col">
                <div class="alert alert-warning">Simplifie la prescription et les rendez-vous, vous aidant à gérer les patients
                    et votre chambre de manière intelligente. <br><b><a href="{{ route('appointment.create') }}">enregistrez
                            votre premier rendez-vous</a></b> en moins de 60 secondes.</div>
            </div>
        </div>
    @endcan --}}

    @role('Admin')
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
                                <td class="text-center"><b>Notification Rendez-Vous</b></td>
                            </tr>
                            @forelse ($appointments as $appointment)
                                <div class="row notify_item d-flex justify-content-center">
                                    <div class="card w-100">
                                        <div class="card-header">
                                            <tr class="text-center">
                                                <td>Nom</td>
                                                <td>Nom</td>
                                            </tr>
                                        </div>
                                        <div class="card-body">
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
        {{-- <div class="row top"> --}}

        {{-- carte contenant le nombre de rendez-vous qu'aura lieu un jour  --}}
        <!-- Earnings (Monthly) Card Example -->
        {{-- <div class="col-xl-2 col-md-6 mb-4 taille marge">
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
                                {{ __('sentence.Payments this month') }} {{ date('M') }} </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_payments_month }}
                                        {{ App\Setting::get_option('currency') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- carte contenant le nommbre total de rendez-vous --}}
        <!-- Earnings (Annual) Card Example -->
        {{-- <div class="col-xl-2 col-md-6 mb-4 taille marge">
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
            </div> --}}
        {{-- carte contenant le nommbre total de nouveau du jour --}}
        <!-- Tasks Card Example -->
        {{-- <div class="col-xl-2 col-md-6 mb-4 taille marge">
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
                                    {{ __('sentence.New Patients') }}</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_patients_today }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        {{-- carte contenant le nommbre total de hôtes du système --}}
        <!-- Pending Requests Card Example -->
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
                                    {{ __('sentence.All Patients') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_patients }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        {{-- </div> --}}

        <div class="row top">
            {{-- carte contenant le montant du chiffre d'affaire du mois en cour --}}
            <!-- Tasks Card Example -->
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
                                    {{ __('sentence.Total Appointments today') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_appointments_today->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- carte contenant le nommbre total de paiements du système --}}
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
                                    {{ __('sentence.Total Payments today') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_payments_days }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- carte contenant le nommbre de traitement du système --}}
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
                                    {{ __('sentence.Total Prescriptions') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_prescriptions }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- carte contenant le montant du chiffre d'affaire de l'année en cour --}}
            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6 mb-4 taille marge">
                <div class="card border-bottom-warning shadow h-100 py-2 card-po1 ">
                    <div class="card-body shadow-lg card-po bg-warning col-md-9  ">
                        <div class="col-auto">
                            <center><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    {{ __('sentence.Payments this year') }} {{ date('Y') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_payments_year }}
                                    {{ App\Setting::get_option('currency') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        {{-- graph section --}}
        <div class="row d-flex justify-content-between">
            <div class="col-sm-5">
                <div class="card h-90 shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Votre Agenda du Mois</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
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
                                                    <i class="fas fa-calendar"></i> {{ $appointment->date->format('d M Y') }}
                                                </label>
                                                <label class="badge badge-primary-soft text-dark">
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
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="card h-90 mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Chiffre d'affaire par Mois</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class=""><canvas id="myAreaChart" width="100%"></canvas></div>
                    </div>
                </div>
            </div>

        </div>

        {{-- graph section end --}}
        <div class="modal fade" id="viewDetailsModal" tabindex="-1" role="dialog" aria-labelledby="viewDetailsModalLabel"
            aria-hidden="true">
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
                                <tr>
                                    <td><b>ID: </b></td>
                                    <td> <label class="badge badge-primary-soft" id="appointmentID"></label></td>
                                </tr>
                                <tr>
                                    <td><b>Consulter</b></td>
                                    <td> <label class="badge badge-primary-soft" id="appointmentRead"></label></td>
                                </tr>
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
                            l'hô<template></template> </a>
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

    @role('Praticien')
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
                                <td class="text-center">Notification</td>
                            </tr>
                            @forelse ($appointments as $appointment)
                                <div class="row notify_item d-flex justify-content-center">
                                    <table class="w-100">
                                        <thead>
                                            <tr class="text-center">
                                                <td>Nom</td>
                                                <td>date RDV</td>
                                                <td>Période</td>
                                                <td>Consulter</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td><span class="badge badge-primary-soft"><a
                                                            href="{{ url('patient/view/' . $appointment->User->id) }}">
                                                            {{ $appointment->User->name }} </a></span></td>
                                                <td><span
                                                        class="badge badge-primary-soft">{{ $appointment->date->format('d M Y') }}</span>
                                                </td>
                                                <td><span class="badge badge-primary-soft">{{ $appointment->time_start }} -
                                                        {{ $appointment->time_end }}</span></td>
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
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row top">

            {{-- carte contenant le nombre de rendez-vous qu'aura lieu un jour  --}}
            <!-- Earnings (Monthly) Card Example -->
            {{-- <div class="col-xl-2 col-md-4 mb-4 taille marge">

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
        </div> --}}

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
                                    {{ __('sentence.Prescription Number') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_prescriptions_for_pratician }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endrole

    @role('Hôte')
        <div class="row top">

            {{-- carte contenant le nombre de rendez-vous qu'aura lieu un jour  --}}
            <!-- Earnings (Monthly) Card Example -->
            {{-- <div class="col-xl-2 col-md-4 mb-4 taille marge">

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
        </div> --}}

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
                            <center><i class="fas fa-users fa-2x text-gray-300"></i></center>
                        </div>
                    </div>
                    <div class="card-body card-po1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    {{ __('sentence.Prescription Number') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $prescriptionHote }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endrole



    <!-- Afficher les rendez-vous du jour au niveau de la page d'accueil -->

    @role('Admin|Praticien')
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.New Appointments') }} -
                                    {{ Today()->format('d M Y') }}</h6>
                            </div>
                            {{-- <div class="col-4">
                                @can('view all appointments')
                                    <a href="{{ route('appointment.all') }}" class="btn btn-primary btn-sm float-right"><i
                                            class="fas fa-calendar"></i> {{ __('sentence.All Appointments') }}</a>
                                @endcan
                                @can('create appointment')
                                    <a href="{{ route('appointment.create') }}"
                                        class="btn btn-primary btn-sm float-right mr-2"><i class="fa fa-plus"></i>
                                        {{ __('sentence.New Appointment') }}</a>
                                @endcan

                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>{{ __('sentence.Patient Name') }}</th>
                                        <th class="text-center">{{ __('sentence.Schedule Info') }}</th>
                                        <th class="text-center">{{ __('sentence.Status') }}</th>
                                        <th class="text-center">{{ __('sentence.Created at') }}</th>
                                        <th class="text-center">{{ __('sentence.Visited At') }}</th>
                                        <th class="text-center">{{ __('sentence.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($total_appointments_today as $key => $appointment)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td><a href="{{ url('patient/view/' . $appointment->user_id) }}">
                                                    {{ $appointment->User->name }} </a></td>
                                            <td class="text-center">
                                                <label class="badge badge-primary-soft">
                                                    <i class="fas fa-calendar"></i> {{ $appointment->date->format('d M Y') }}
                                                </label>
                                                <label class="badge badge-primary-soft">
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
                                            <td class="text-center">{{ $appointment->created_at->format('d M Y H:i') }}</td>
                                            <td class="text-center">
                                                @if ($appointment->visited == 1)
                                                    <label class="badge badge-primary-soft">
                                                        <i class="fas fa-calendar"></i>
                                                        {{ $appointment->updated_at->format('d M Y H:i') }}
                                                    </label>
                                                @endif
                                            </td>
                                            <td align="center">
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
                                                @can('delete appointment')
                                                    @if ($appointment->visited != 1)
                                                        <a href="{{ url('appointment/delete/' . $appointment->id) }}"
                                                            class="btn btn-outline-danger btn-circle btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @endif
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
                    </div>
                </div>
            </div>
        </div>
    @endrole


    <!-- EDIT Appointment Modal-->

    {{-- <div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ __('sentence.You are about to modify an appointment') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient_name"></span></p>
                    <p><b>{{ __('sentence.Date') }} :</b> <label class="badge badge-primary-soft" id="rdv_date"></label>
                    </p>
                    <p><b>{{ __('sentence.Time Slot') }} :</b> <label class="badge badge-primary-soft"
                            id="rdv_time"></span></label>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button"
                        data-dismiss="modal">{{ __('sentence.Close') }}</button>
                    <a class="btn btn-primary text-white"
                        onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();">{{ __('sentence.Confirm Appointment') }}</a>
                    <form id="rdv-form-confirm" action="{{ route('appointment.store_edit') }}" method="POST"
                        class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id">
                        <input type="hidden" name="rdv_status" value="1">
                        @csrf
                    </form>
                    <a class="btn btn-primary text-white"
                        onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();">{{ __('sentence.Cancel Appointment') }}</a>
                    <form id="rdv-form-cancel" action="{{ route('appointment.store_edit') }}" method="POST"
                        class="d-none">
                        <input type="hidden" name="rdv_id" id="rdv_id2">
                        <input type="hidden" name="rdv_status" value="2">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('header')
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard/vendor/chart.js/Chart.bundle.js"></script>
    <script type="text/javascript">
        var _ydata = JSON.parse('{!! json_encode($days) !!}');
        var _xdata = JSON.parse('{!! json_encode($totalAmounts) !!}');
        var visitedCount = {{ $visitedCount }};
        var nonVisitedCount = {{ $nonVisitedCount }};
        var allAppointment = {{ $allAppointment }}
    </script>

    <script>
        var startDate = null;
        var endDate = null;

        function StartDateFilter(input) {
            startDate = input.value;
            updateChart();
        }

        function EndDateFilter(input) {
            endDate = input.value;
            updateChart();
        }

        function updateChart() {
            var filteredLabels = [];
            var filteredData = [];

            for (var i = 0; i < _ydata.length; i++) {
                var currentDate = _ydata[i];
                var currentAmount = _xdata[i];

                if (isDateInRange(currentDate)) {
                    filteredLabels.push(currentDate);
                    filteredData.push(currentAmount);
                }
            }

            myLineChart.data.labels = filteredLabels;
            myLineChart.data.datasets[0].data = filteredData;
            myLineChart.update();
        }

        function isDateInRange(date) {
            if (!startDate || !endDate) {
                return true;
            }

            return date >= startDate && date <= endDate;
        }
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
