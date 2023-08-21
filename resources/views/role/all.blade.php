@extends('layouts.master')

@section('title')
{{ __('sentence.All Roles') }}
@endsection

@section('content')

          <div class="card shadow mb-4">
            <div class="card-header py-3">
               <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Roles') }}</h6>
                </div>
                <div class="col-4">
                  <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm float-right "><i class="fa fa-plus"></i> {{ __('sentence.New Role') }}</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="20%">{{ __('sentence.Name') }}</th>
                      <th class="text-center">{{ __('sentence.Permissions') }}</th>
                      <th class="text-center" width="10%">{{ __('sentence.Actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($roles as $role)
                    <tr>
                      <td><a href="#"> {{ ucfirst($role->name) }} </a></td>
                      <td>
                        @forelse($role->permissions->pluck('name') as $permission)
                        <label class="badge badge-success-soft">{{ ucfirst($permission) }}</label> 
                        @empty  
                        <label class="badge badge-warning-soft">No permissions for {{ $role->name }}</label> 
                        @endforelse
                      </td>
                      <td class="text-center">
                        @if($role->name != "Admin")
                        <a href="{{ route('role.edit_role', ['id' => $role->id]) }}" class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                        @endif
                        @if($role->name != "Admin" && $role->name != "Receptionist")
                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('role.destroy', ['id' => $role->id]) }}"><i class="fas fa-trash"></i></a>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
               <span class="float-right mt-3">{{ $roles->links() }}</span>

              </div>
            </div>
          </div>
@endsection

  