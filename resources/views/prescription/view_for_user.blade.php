@extends('layouts.master')

@section('title')
{{ __('sentence.All Prescriptions') }}
@endsection

@section('content')

<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-8">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Prescriptions') }}</h6>
         </div>
         <div class="col-4">
            <a href="{{ route('prescription.create') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> {{ __('sentence.New Prescription') }}</a>
         </div>
      </div>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>{{ __('sentence.Patient') }}</th>
                  <th class="text-center">{{ __('sentence.Created') }}</th>
                  <th class="text-center">{{ __('sentence.Content') }}</th>
                  <th class="text-center">{{ __('sentence.Actions') }}</th>
               </tr>
            </thead>
            <tbody>
               @forelse($prescriptions as $prescription)
               <tr>
                  <td>{{ $prescription->id }}</td>
                  <td><a href="{{ url('patient/view/'.$prescription->user_id) }}"> {{ $prescription->User->name }} </a></td>
                  <td class="text-center">{{ $prescription->created_at->format('d M Y H:i') }}</td>
                  <td class="text-center"> 
                     <label class="badge badge-primary-soft">
                        {{ count($prescription->Drug) }} Drugs
                     </label>
                     <label class="badge badge-primary-soft">
                        {{ count($prescription->Test) }} Tests
                     </label> 
                  </td>
                  <td class="text-center">
                     <a href="{{ url('prescription/view/'.$prescription->id) }}" class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                     <a href="{{ url('prescription/pdf/'.$prescription->id) }}" class="btn btn-outline-primary btn-circle btn-sm"><i class="fas fa-print"></i></a>
                     <a href="{{ url('prescription/edit/'.$prescription->id) }}" class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                     <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ url('prescription/delete/'.$prescription->id) }}"><i class="fas fa-trash"></i></a>
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="5" class="text-center"><img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <b class="text-muted">No prescriptions found</b></td>
               </tr>
               @endforelse
            </tbody>
         </table>
         <span class="float-right mt-3">{{ $prescriptions->links() }}</span>

      </div>
   </div>
</div>
@endsection