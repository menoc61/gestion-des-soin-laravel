@extends('layouts.master')

@section('title')
{{ __('sentence.All Patients') }}
@endsection

@section('content')

          <div class="card shadow mb-4">
            <div class="card-header py-3">
               <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Patients') }}</h6>
                </div>
                <div class="col-4">
                 <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ route('patient.search') }}" method="post">
                        <div class="input-group">
                            <input type="text" name="term" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            @csrf
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-2">
                  @can('add patient')
                  <a href="{{ route('patient.create') }}" class="btn btn-primary btn-sm float-right "><i class="fa fa-plus"></i> {{ __('sentence.New Patient') }}</a>
                  @endcan
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>{{ __('sentence.Patient Name') }}</th>
                      <th class="text-center">{{ __('sentence.Age') }}</th>
                      <th class="text-center">{{ __('sentence.Phone') }}</th>
                      <th class="text-center">{{ __('sentence.Blood Group') }}</th>
                      <th class="text-center">{{ __('sentence.Date') }}</th>
                      <th class="text-center">{{ __('sentence.Due Balance') }}</th>
                      <th class="text-center">{{ __('sentence.Prescriptions') }}</th>
                      <th class="text-center">{{ __('sentence.Actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($patients as $patient)
                    <tr>
                      <td>{{ $patient->id }}</td>
                      <td><a href="{{ url('patient/view/'.$patient->id) }}"> {{ $patient->name }} </a></td>
                      <td class="text-center"> {{ @\Carbon\Carbon::parse($patient->Patient->birthday)->age }} </td>
                      <td class="text-center"> {{ @$patient->Patient->phone }} </td>
                      <td class="text-center"> {{ @$patient->Patient->blood }} </td>
                      <td class="text-center"><label class="badge badge-primary-soft">{{ $patient->created_at->format('d M Y H:i') }}</label></td>
                      <td class="text-center"><label class="badge badge-primary-soft">{{ Collect($patient->Billings)->where('payment_status','Partially Paid')->sum('due_amount') }} {{ App\Setting::get_option('currency') }}</label></td>
                      <td class="text-center">
                        @can('view patient')
                        <a href="{{ route('prescription.view_for_user', ['id' => $patient->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i> View</a>
                        @endcan
                      </td>
                      <td class="text-center">
                        @can('view patient')
                        <a href="{{ route('patient.view', ['id' => $patient->id]) }}" class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                        @endcan
                        @can('edit patient')
                        <a href="{{ route('patient.edit', ['id' => $patient->id]) }}" class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                        @endcan
                        @can('delete patient')
                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('patient.destroy' , ['id' => $patient->id ]) }}"><i class="fas fa-trash"></i></a>
                        @endcan
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="9"  align="center"><img src="{{ asset('img/rest.png') }} "/> <br><br> <b class="text-muted">No patients found!</b>
                        
                      </td>
                    </tr>
                    @endforelse
                   
                  </tbody>
                </table>
               <span class="float-right mt-3">{{ $patients->links() }}</span>

              </div>
            </div>
          </div>
@endsection

  