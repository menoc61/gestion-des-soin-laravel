@extends('layouts.master')

@section('title')
    {{ __('sentence.All Tests') }}
@endsection

@section('content')
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Tests') }}</h6>
                </div>
                <div class="col-4">
                    {{-- bouton permettant d'ajouter un test depuis la liste de tous les tests --}}
                    {{-- @can('create diagnostic test')
                        <a href="{{ route('test.create') }}" class="btn btn-primary btn-sm float-right"><i
                                class="fa fa-plus"></i> {{ __('sentence.Add Test') }}</a>
                    @endcan --}}
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID
                                <a href="{{ route('test.all', ['sort' => 'id', 'order' => 'asc']) }}"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="{{ route('test.all', ['sort' => 'id', 'order' => 'desc']) }}"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th>{{ __('sentence.Test Name') }}
                                <a href="{{ route('test.all', ['sort' => 'test_name', 'order' => 'asc']) }}"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="{{ route('test.all', ['sort' => 'test_name', 'order' => 'desc']) }}"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th>{{ __('sentence.Description') }}
                                <a href="{{ route('test.all', ['sort' => 'comment', 'order' => 'asc']) }}"><i
                                        class="fas fa-sort-up"></i></a>
                                <a href="{{ route('test.all', ['sort' => 'comment', 'order' => 'desc']) }}"><i
                                        class="fas fa-sort-down"></i></a>
                            </th>
                            <th class="text-center">{{ __('sentence.Total Use') }}</th>
                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tests as $key => $test)
                            <tr>
                                <td>{{  $key + 1 }}</td>
                                <td>{{ $test->test_name }}</td>
                                <td> {{ $test->comment }} </td>
                                <td align="center">{{ __('sentence.In Prescription') }} :
                                    {{ $test->Prescription->count() }} {{ __('sentence.time use') }}</td>
                                <td class="text-center">

                                        <a href="{{ url('test/view/' . $test->id) }}"
                                        class="btn btn-outline-primary btn-circle btn-sm"><i class="fa fa-eye"></i></a>

                                    @can('edit diagnostic test')
                                        <a href="{{ url('test/edit/' . $test->id) }}"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('delete diagnostic test')
                                        <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal" data-link="{{ url('test/delete/' . $test->id) }}"><i
                                                class="fa fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center"><img src="{{ asset('img/not-found.svg') }}"
                                        width="200" /> <br><br> <b class="text-muted">pas de diagnostic trouvé</b></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
