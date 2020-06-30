@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 mb-3 text-center h2 text-success">
			@foreach($services as $service)
				{{ $service->name }}
			@endforeach
			<p class="h4">Duracion servicio: {{ $service->id_duration }} @if($service->id_duration > 1) horas @else hora @endif</p> 
		</div>
		<div class="h3 col-md-8 mb-3 text-center alert-warning">
			Escoja una hora de la fecha que quiera, con la esteticista que desee
		</div>
		@foreach($dates as $date) <!-- dias de la semana -->
			<div class="col-md-8 mb-3">
				<hr>
				<span class="h2">{{ strftime('%A %d %b',$date) }}</span>
			</div>

			@foreach($employeesCategories as $employeeCategory) <!-- categoria empleados -->
				@foreach($employees as $employee) <!-- empleados -->

					@if($employee->id == $employeeCategory->id_employee) <!-- if empleados -->
					<div class="col-md-8">

						<div class="card mb-3">

	           	<div class="card-header text-left">
								<img src="{{ asset('img/empleado') . '/' . $employeeCategory->id_employee . '.png' }}" height="32" width="32" alt="">{{ $employee->name }}
							</div>
							<!-- Se aplica d-flex y table-responsive para permitir el scroll horizontal -->
							<div class="card-body d-flex table-responsive">
								
								@foreach($hours as $hour) <!-- ciclo horas -->
									
									@foreach($bookings as $booking)	<!-- ciclo citas -->
										
										@if($booking->date == date('Y-m-d',$date) && $booking->id_employee == $employee->id) <!-- if condicionales horas ocupadas -->

											@if($hour['hora'] == $booking->start)
												@php $hour['state'] = 'ocupado' @endphp
											@endif
											
											@if($hour['hora'] > $booking->start and $hour['hora'] < $booking->end)
												@php $hour['state'] = 'ocupado' @endphp
											@endif
											
											@if($service->id_duration == 2) <!-- Si el servicio escogido es de 2 horas -->
												@if($hour['hora'] + 1 == $booking->start)
													@php $hour['state'] = 'ocupado' @endphp
												@endif
											@endif

										@endif <!-- Fin if horas ocupadas -->

									@endforeach <!-- Fin ciclo citas -->
									
									@if($service->id_duration == 2)
										@if($hour['hora'] == 17)
											@php $hour['state'] = 'ocupado' @endphp
										@endif
									@endif									
									
									@if($hour['state'] == 'disponible') <!-- if horas disponibles -->
										<a href="{{ url('confirmation') . '/' . $service->id . '/' . $employee->id . '/' . $date . '/' . $hour['hora']}}" class="btn btn-success mr-2">
										{{ date('ga', strtotime($hour['hora'] . ':00')) }}
										</a>
									@endif <!-- Fin if horas disponibles -->
									

								@endforeach <!-- Fin ciclo horas -->
							</div>

						</div>

					</div>
					<!-- Fin if empleados -->						
					@endif

				<!-- Fin ciclo empleados -->
				@endforeach

			<!-- Fin ciclo employeeCategory -->
			@endforeach

		<!-- Fin ciclo dias semana -->
		@endforeach
	</div>	
</div>
@endsection