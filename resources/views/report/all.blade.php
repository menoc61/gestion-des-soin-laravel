@extends('layouts.master')

@section('title')
    {{ __('sentence.All Reports') }}
@endsection

@section('content')
    <div class="">
        <div class="mb-3">
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-12">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary text-center"> {{ __('sentence.All Reports') }}

                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mt-4 mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Reports') }}</h6>
                </div>
                {{-- <div class="col-4">
                    @can('create drug')
                        <a href="{{ route('drug.create') }}" class="btn btn-primary btn-sm float-right"><i
                                class="fa fa-plus"></i> {{ __('sentence.Add Drug') }}</a>
                    @endcan
                </div> --}}
            </div>
        </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID
                        <a href="{{ route('report.all', ['sort' => 'id', 'order' => 'asc']) }}"><i
                                class="fas fa-sort-up"></i></a>
                        <a href="{{ route('report.all', ['sort' => 'id', 'order' => 'desc']) }}"><i
                                class="fas fa-sort-down"></i></a>
                    </th>
                    <th>Date</th>
                    <th>Nom du praticien</th>
                    <th class="text-center">Hôtes</th>
                    <th class="text-center">Soin effectué(s)</th>
                    <th class="text-center">{{ __('sentence.Amount') }}</th>
                    <th class="text-center">Prochain RDV</th>
                    <!-- <th class="text-center">Observations</th>
                    <th class="text-center">Pourboires</th> -->
                    <th class="text-center">{{ __('sentence.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($activity_report as $activity_reports)
                    <tr>
                        <td>{{ $activity_reports->id }}</td>
                        <td class="badge badge-primary-soft">{{ $activity_reports->created_at->format('Y-m-d') }}</td>
                        <td align="center">{{ $activity_reports->doctor->name }}</td>
                        <td align="center">
                            @if($activity_reports->User)
                                      {{ $activity_reports->User->name }}
                            @else
                                      <span class="text-muted">tir</span>
                            @endif</td>
                        <td align="center">
                            @if ($activity_reports->drugs->count() > 0)
                                {{ $activity_reports->drugs->pluck('trade_name')->implode(', ') }}
                            @else
                                <span class="text-muted">Aucun</span>
                            @endif
                        </td>
                        <td align="center">{{ $activity_reports->drugs->sum('pivot.amountDrug') }} FCFA</td>
                        <td align="center" class="badge badge-primary-soft">{{ $activity_reports->next_rdv }}</td>
                        <!-- <td>{{ $activity_reports->observation }}</td>
                        <td align="center">{{ $activity_reports->pourboire }}</td> -->
                        <td class="text-center">
                            <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                data-target="#DeleteModal"
                                data-link="{{ route('report.destroy', ['id' => $activity_reports->id]) }}">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="{{ route('report.print', $activity_reports->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" align="center">
                            <img src="{{ asset('img/rest.png') }} " /> <br><br>
                            <b class="text-muted">Aucun rapport trouvé</b>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
    </div>
@endsection
