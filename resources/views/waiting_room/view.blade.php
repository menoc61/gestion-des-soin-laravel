@extends('layouts.master')
@section('title')
{{ __('Waiting Room') }}
@endsection
@section('content')
<div class="row">
	<div class="col-9">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<div class="row">
					<div class="col-3">
						<h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('All visitors') }}</h6>
					</div>
					<div class="col-4">
						<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ route('wr.search') }}" method="post">
							<div class="input-group">
								<input type="text" name="visitor" class="form-control bg-light border-0 small" placeholder="{{ __('Search for...') }}" aria-label="Search" aria-describedby="basic-addon2">
								@csrf
								<div class="input-group-append">
									<button class="btn btn-primary" type="submit">
									<i class="fas fa-search fa-sm"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-5">
						<a class="btn btn-primary btn-sm float-right mr-2" data-toggle="modal" data-target="#NewPatientModal" data-link=""><i class="fa fa-plus"></i> {{ __('Add visitor') }}</a>
						<a href="#" class="btn btn-danger btn-sm float-right mr-2" data-toggle="modal" data-target="#ArchiveModal" data-link="{{ route('wr.archive') }}"><i class="fas fa-archive"></i> {{ __('Archive list') }}</a>
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
									@if(@Collect($list)->where('status', 1)->first()['id'] == $visitor->id)
									<a href="{{ route('wr.update.ongoing', ['id' => $visitor->id]) }}" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Ongoing"><i class="fa fa-user-check"></i></a>
									@endif
									<a href="#" data-toggle="modal" data-target="#ArchiveModal" data-link="{{ route('wr.update.archive', ['id' => $visitor->id]) }}" class="btn btn-outline-warning btn-sm" data-toggle="tooltip" data-placement="left" title="Archive"><i class="fa fa-archive"></i></a>
									<a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('wr.delete', ['id' => $visitor->id]) }}"><i class="fas fa-trash" data-toggle="tooltip" data-placement="left" title="Delete"></i></a>
								</td>
							</tr>
							@empty
							<tr class="text-center">
								<td colspan="7"><img src="{{ asset('img/rest.png') }} "/> <br><br> <b class="text-muted">{{ __('There are no patients in the waiting room') }}</b></td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-3">
		<div class="card border-left-success shadow py-2 my-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('Current patient') }}</div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">@if(isset(Collect($list)->where('status',2)->first()->User->name)) {{ @Collect($list)->where('status',2)->first()->User->name }} @else -- @endif</div>
							</div>
						</div>
					</div>
					<div class="col-auto"><i class="fas fa-user-check fa-2x text-gray-300"></i></div>
				</div>
			</div>
		</div>
		<div class="card border-left-warning shadow py-2 my-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('Next patient') }}</div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">@if(isset(Collect($list)->where('status',1)->first()->User->name)) {{ @Collect($list)->where('status',1)->first()->User->name }} @else -- @endif</div>
							</div>
						</div>
					</div>
					<div class="col-auto"><i class=" fas fa-user-injured fa-2x text-gray-300"></i></div>
				</div>
			</div>
		</div>
		<div class="card border-left-danger shadow py-2 my-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">{{ __('Waiting patients') }}</div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ @Collect($list)->where('status', 1)->count() }}</div>
							</div>
						</div>
					</div>
					<div class="col-auto"><i class="  fas fa-user-clock fa-2x text-gray-300"></i></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Delete Modal-->
<div class="modal fade" id="NewPatientModal" tabindex="-1" role="dialog" aria-labelledby="NewPatientModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('Add visitor') }}</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<form method="post" action="{{ route('wr.store') }}">
				@csrf
				<div class="modal-body">
					<div class="mb-3" id="SelectPatient">
						<label for="patient" class="form-label">{{ __('Select Patient') }}</label>
						<div class="">
							<select class="form-control" name="patient" id="patient">
								<option value="0">{{ __('Select Patient') }}</option>
								@foreach($users as $user)
								<option value="{{ $user->id }}">{{ $user->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-check my-3">
						<input type="checkbox" class="form-check-input" id="newPatient" name="new_patient" value="1">
						<label class="form-check-label" for="newPatient">{{ __('First visit ?') }}</label>
					</div>
					<div style="display:none;" id="newPatientDIV">
						<div class="mb-3">
							<label for="firstname" class="form-label pt-0">{{ __('First Name') }}</label>
							<div class="">
								<input class="form-control" type="text" id="firstname" placeholder="John" name="firstname">
							</div>
						</div>
						<div class="mb-3 ">
							<label for="familyname" class="form-label pt-0">{{ __('Family Name') }}</label>
							<div class="">
								<input class="form-control" type="text" id="familyname" placeholder="Doe" name="familyname">
							</div>
						</div>
					</div>
					<div class="mb-3 ">
						<label for="reason" class="form-label">{{ __('Reason for consultation') }}</label>
						<div class="">
							<input class="form-control" type="test" id="reason" placeholder="eg. Consultation" name="reason">
						</div>
					</div>
					<div class="form-check my-3">
						<input type="checkbox" class="form-check-input" id="has_appointment" name="has_appointment" value="1">
						<label class="form-check-label" for="has_appointment">{{ __('Has appointment ?') }}</label>
					</div>
					<div class="form-check my-3">
					<div id="appointmentDropdownContainer"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
					<button class="btn btn-primary" type="submit">{{ __('Add to queue') }}</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script>
	$(document).ready(function() {
	$('#newPatient').change(function() {
	 if(this.checked) {
	   $('#SelectPatient').hide();
	   $('#newPatientDIV').show();
	 } else {
	   $('#SelectPatient').show();
	   $('#newPatientDIV').hide();
	 }
	});

	$("#accordionSidebar").attr("class", "navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled");

	});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
	$(document).ready(function() {
    // Fonction de gestion du changement de la case à cocher "Has appointment" et du choix du patient.
    function updateAppointmentDropdown() {
        var selectedUserId = $('#patient').val();
        var hasAppointment = $('#has_appointment').is(':checked');

        // Vérifiez si le patient est sélectionné et l'option "Has appointment" est cochée.
        if (selectedUserId !== '0' && hasAppointment) {
            // Effectuez une requête AJAX pour obtenir les rendez-vous du patient.
            $.ajax({
                url: 'http://localhost/doctorino/v4.5/public/appointment/get-appointment/' + selectedUserId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var appointmentDropdown = $('#appointmentDropdownContainer');
                    appointmentDropdown.empty(); // Effacez le contenu actuel de la liste déroulante.

                    if (data.length > 0) {
                        // S'il y a des rendez-vous, créez la liste déroulante.
                        var appointmentSelect = $('<select/>', {
                            class: 'form-control',
                            name: 'appointment_id',
                            id: 'appointment_id'
                        });

                        appointmentSelect.append($('<option>', {
                            value: '0',
                            text: '{{ __('Select Appointment') }}'
                        }));

                        $.each(data, function(index, appointment) {
							// Utilisez Moment.js pour formater la date au format "YYYY-MM-DD".
							var formattedDate = moment(appointment.date).format('YYYY-MM-DD');

							appointmentSelect.append($('<option>', {
								value: appointment.id,
								text: formattedDate+' : '+appointment.time_start + ' to '+ appointment.time_end
							}));
						});


                        appointmentDropdown.append(appointmentSelect);
                    } else {
                        // S'il n'y a pas de rendez-vous, affichez un message.
                        appointmentDropdown.html('<p>{{ __('No Appointments available') }}</p>');
                    }
                },
                error: function() {
                    console.error('Erreur lors de la récupération des rendez-vous.');
                }
            });
        } else {
            // Si l'une des conditions n'est pas remplie, videz la liste déroulante.
            $('#appointmentDropdownContainer').empty();
        }
    }

    // Appelez la fonction lors du chargement de la page et à chaque changement de choix.
    updateAppointmentDropdown();

    $('#patient, #has_appointment').change(updateAppointmentDropdown);
});

</script>
@endsection
