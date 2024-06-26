@extends('layouts.master')

@section('title')
{{ __('sentence.All Prescriptions') }}
@endsection

@section('content')

<div class="mb-3">
    <button class="btn btn-primary" onclick="history.back()">Retour</button>
</div>

<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-8">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Prescriptions') }}</h6>
         </div>
         {{-- bouton permettant d'ajouter une prescription depuis la liste de tous les prescriptions --}}
         {{-- <div class="col-4">
            <a href="{{ route('prescription.create') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> {{ __('sentence.New Prescription') }}</a>
         </div> --}}
      </div>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>ID
                    <a href="{{ route('prescription.all', ['sort' => 'id', 'order' => 'asc']) }}"><i class="fas fa-sort-up"></i></a>
                    <a href="{{ route('prescription.all', ['sort' => 'id', 'order' => 'desc']) }}"><i class="fas fa-sort-down"></i></a>
                  </th>
                  <th>{{ __('sentence.Patient') }}
                    <a href="{{ route('prescription.all', ['sort' => 'patient_name', 'order' => 'asc']) }}"><i class="fas fa-sort-up"></i></a>
                    <a href="{{ route('prescription.all', ['sort' => 'patient_name', 'order' => 'desc']) }}"><i class="fas fa-sort-down"></i></a>
                  </th>
                  <th class="text-center">{{ __('sentence.Created') }}
                    <a href="{{ route('prescription.all', ['sort' => 'created_at', 'order' => 'asc']) }}"><i class="fas fa-sort-up"></i></a>
                    <a href="{{ route('prescription.all', ['sort' => 'created_at', 'order' => 'desc']) }}"><i class="fas fa-sort-down"></i></a>
                  </th>
                  <th class="text-center">{{ __('sentence.Content') }}</th>
                  <th class="text-center">{{ __('sentence.Actions') }}</th>
               </tr>
            </thead>
            <tbody>
               @forelse($prescriptions as $key => $prescription)
               <tr>
                  <td>{{ $key + 1 }}</td>
                  <td><a href="{{ url('patient/view/'.$prescription->user_id) }}"> {{ $prescription->User->name }} </a></td>
                  <td class="text-center">{{ $prescription->created_at->format('d M Y H:i') }}</td>
                  <td class="text-center">
                     <label class="badge badge-primary-soft">
                        {{ count($prescription->Drug) }} Soin(s)
                     </label>
                     <label class="badge badge-primary-soft">
                        {{ count($prescription->Test) }} Diagnostic(s)
                     </label>
                  </td>
                  <td class="text-center">
                     <a href="{{ url('prescription/view/'.$prescription->id) }}" class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                     {{-- <a href="{{ url('prescription/edit/'.$prescription->id) }}" class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a> --}}
                     <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ url('prescription/delete/'.$prescription->id) }}"><i class="fas fa-trash"></i></a>
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="5" class="text-center"><img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <b class="text-muted">Aucun traitement trouvé</b></td>
               </tr>
               @endforelse
            </tbody>
         </table>
         <span class="float-right mt-3">{{ $prescriptions->links() }}</span>

      </div>
   </div>
</div>
@endsection
