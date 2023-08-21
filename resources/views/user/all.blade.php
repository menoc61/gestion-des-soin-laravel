@extends('layouts.master')

@section('title')
{{ __('sentence.All users') }}
@endsection

@section('content')

          <div class="card shadow mb-4">
            <div class="card-header py-3">
               <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Users') }}</h6>
                </div>
                <div class="col-4">
                  <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm float-right "><i class="fa fa-plus"></i> {{ __('sentence.New User') }}</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>{{ __('sentence.Name') }}</th>
                      <th class="text-center">{{ __('sentence.Email') }}</th>
                      <th class="text-center">{{ __('sentence.Register Date') }}</th>
                      <th class="text-center">{{ __('sentence.Roles') }}</th>
                      <th class="text-center">{{ __('sentence.Actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td><a href="{{ url('patient/view/'.$user->id) }}"> {{ $user->name }} </a></td>
                      <td class="text-center"> {{ $user->email }} </td>
                      <td class="text-center"><label class="badge badge-primary-soft">{{ $user->created_at->format('d M Y H:i') }}</label></td>
                      <td class="text-center">
                        @forelse($user->getRoleNames() as $role)
                        <label class="badge badge-warning-soft">{{ ucfirst($role) }}</label> 
                        @empty  
                        <label class="badge badge-warning-soft">no role for {{ $user->name }}</label> 
                        @endforelse
                      </td>
                      <td class="text-center">
                        <a href="{{ url('patient/view/'.$user->id) }}" class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="#"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
               <span class="float-right mt-3">{{ $users->links() }}</span>

              </div>
            </div>
          </div>
@endsection

  