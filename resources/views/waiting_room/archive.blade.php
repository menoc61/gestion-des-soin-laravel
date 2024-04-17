@extends('layouts.master')
@section('title')
{{ __('All visitors') }}
@endsection
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<div class="row">
					<div class="col-6">
						<h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('All archived visitors') }}</h6>
					</div>
					<div class="col-3">
						<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right" action="{{ route('wr.search_in_archive') }}" method="post">
							<div class="input-group">
								<input type="text" name="visitor" class="form-control bg-light border-0 small" placeholder="{{ __('Search in archive') }}..." aria-label="Search" aria-describedby="basic-addon2">
								@csrf
								<div class="input-group-append">
									<button class="btn btn-primary" type="submit">
									<i class="fas fa-search fa-sm"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-3">
						<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right" action="{{ route('wr.filter') }}" method="post">
							<div class="input-group">
								<input type="date" name="date" class="form-control border-0 small" value="@isset($date){{ $date }}@endisset">
								@csrf
								<div class="input-group-append">
									<button class="btn btn-primary" type="submit">
									<i class="fas fa-search fa-sm"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr class="text-center">
								<th>{{ __('Order') }}</th>
								<th>{{ __('Visitor') }}</th>
								<th>{{ __('With appointment') }}</th>
								<th>{{ __('Reason for consultation') }}</th>
								<th>{{ __('Created at') }}</th>
								<th>{{ __('Status') }}</th>
								<th>{{ __('Actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@forelse($list as $key => $visitor)
							<tr class="text-center">
								<td>{{ $key+1 }}</td>
								<td>{{ $visitor->User->name }}</td>
								<td>@if($visitor->has_appointment == 1) <label class="badge badge-success-soft">{{ yes_or_no($visitor->has_appointment) }}</label> @else <label class="badge badge-danger-soft">{{ yes_or_no($visitor->has_appointment) }}</label>  @endif</td>
								<td>{{ $visitor->reason ?? __('N/A') }}</td>
								<td><label class="badge badge-primary-soft">
									<i class="far fa-clock"></i> {{ $visitor->created_at }}</label>
								</td>
								<td>@if($visitor->status == 1) <label class="badge badge-warning-soft">{{ get_visitor_status($visitor->status) }}</label> @else <label class="badge badge-success-soft">{{ get_visitor_status($visitor->status) }}</label>  @endif</td>
								<td>
									@can('edit drug')
									@if($visitor->status == 1)
									<a href="{{ route('wr.update.ongoing', ['id' => $visitor->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-user-check"></i></a>
									@endif
									<a href="{{ route('wr.update.archive', ['id' => $visitor->id]) }}" class="btn btn-outline-warning btn-sm"><i class="fa fa-archive"></i></a>
									@endcan
									@can('delete drug')
									<a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('wr.delete', ['id' => $visitor->id]) }}"><i class="fas fa-trash"></i></a>
									@endcan
								</td>
							</tr>
							@empty
							<tr class="text-center">
								<td colspan="7"><img src="{{ asset('img/rest.png') }} "/> <br><br> <b class="text-muted">{{ __('No patient found') }}</b></td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
