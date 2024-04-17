@extends('layouts.master')

@section('title')
{{ __('All Notifications') }}
@endsection

@section('content')

<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-7">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('All Notifications') }}</h6>
         </div>
         <div class="col-5">
            @can('create notification')
            <a href="{{ route('notification.create') }}" class="btn btn-outline-primary btn-sm float-right mr-2"><i class="fa fa-plus"></i> {{ __('Create New') }}</a>
            @endcan
         </div>
      </div>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr class="text-center">
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Title') }}</th>
                  <th>{{ __('Content') }}</th>
                  <th>{{ __('Start Date') }}</th>
                  <th>{{ __('End Date') }}</th>
                  <th>{{ __('Actions') }}</th>
               </tr>
            </thead>
            <tbody>
               @forelse($notifications as $notification)
               <tr class="text-center">
                  <td>{{ $notification->id }}</td>
                  <td>{{ $notification->title }}</td>
                  <td>
                     <label class="badge badge-{{ $notification->type }}-soft">{{ $notification->content }}</label>
                  </td>
                  <td><label class="badge badge-primary-soft"><i class="far fa-calendar"></i> {{ $notification->start_date }} </label></td>
                  <td><label class="badge badge-primary-soft"><i class="far fa-calendar"></i> {{ $notification->end_date }} </label></td>
                  <td class="text-center">
                     @can('edit notification')
                     <a href="{{ route('notification.edit', ['id' => $notification->id]) }}" class="btn btn-outline-warning btn-sm"><i class="fa fa-pen"></i></a>
                     @endcan
                     @can('delete notification')
                     <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('notification.delete', ['id' => $notification->id]) }}"><i class="fas fa-trash"></i></a>
                     @endcan
                  </td>
               </tr>
               @empty
               <tr class="text-center">
						<td colspan="7">{{ __('You don\'t have any notification') }}, <a href="{{ route('notification.create') }}">{{ __('create one') }}</a></td>
					</tr>
               @endforelse
            </tbody>
         </table>
         <span class="float-right mt-3">{{ $notifications->links() }}</span>

      </div>
   </div>
</div>
@endsection

@section('footer')

@endsection