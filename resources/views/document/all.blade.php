@extends('layouts.master')

@section('title')
{{ __('sentence.All documents') }}
@endsection

@section('content')

   <!-- DataTable -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
               <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All documents') }}</h6>
                </div>
                <div class="col-4">
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>{{ __('sentence.Title') }}</th>
                      <th class="text-center">{{ __('sentence.Note') }}</th>
                      <th>{{ __('sentence.Patient') }}</th>
                      <th class="text-center">{{ __('sentence.Document Type') }}</th>
                      <th class="text-center">{{ __('sentence.Actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($documents as $document)
                    <tr>
                      <td>{{ $document->id }}</td>
                      <td> {{ $document->title }}</td>
                      <td class="text-center"> {{ $document->note }} </td>
                      <td><a href="{{ url('patient/view/'.$document->user_id) }}"> {{ $document->Patient->name }} </a></td>
                      <td class="text-center"> {{ $document->document_type }} </td>
                      <td class="text-center">
                        <a href="{{ url('/uploads/'.$document->file) }}" class="btn btn-success btn-circle btn-sm" download><i class="fa fa-eye"></i></a>
                        <a href="#" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection
