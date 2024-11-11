@extends('layouts.master')

@section('title')
    {{ __('sentence.All Drugs') }}
@endsection

@section('content')
    <div class="">
        <div class="mb-3">
            <button class="btn btn-primary" onclick="history.back()">Retour</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-12">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary text-center"> {{ __('sentence.Drugs list') }}

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
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Drugs') }}</h6>
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
                                <a href="{{ route('drug.all', ['sort' => 'id', 'order' => 'asc']) }}"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="{{ route('drug.all', ['sort' => 'id', 'order' => 'desc']) }}"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th>{{ __('sentence.Trade Name') }}
                                <a href="{{ route('drug.all', ['sort' => 'trade_name', 'order' => 'asc']) }}"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="{{ route('drug.all', ['sort' => 'trade_name', 'order' => 'desc']) }}"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th class="text-center">{{ __('sentence.Total Use') }}</th>
                            <th class="text-center">{{ __('sentence.Amount') }}</th>
                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($drugs as $drug)
                            <tr>
                                <td>{{ $drug->id }}</td>
                                <td>{{ $drug->trade_name }}</td>
                                
                                <td align="center">{{ __('sentence.time use') }} :
                                    <label class="badge badge-primary-soft">{{ $drug->Prescription->count() }}</label>
                                    {{ __('sentence.In Prescription') }}
                                </td>
                                <td align="center"><label class="badge badge-primary-soft">{{ $drug->amountDrug }}
                                        fcfa</label></td>
                                <td class="text-center">
                                    @can('edit drug')
                                        <a href="{{ url('drug/edit/' . $drug->id) }}"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('delete drug')
                                        <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal" data-link="{{ url('drug/delete/' . $drug->id) }}"><i
                                                class="fas fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" align="center"><img src="{{ asset('img/rest.png') }} " /> <br><br> <b
                                        class="text-muted">Aucun soin trouvé</b>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
