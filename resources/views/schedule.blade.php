@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<!-- Si el usuario es redireccionado a esta pagina y viene con mensaje de error -->
		@if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            	<span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endif

  

		<!-- Título con el nombre e informacion del servicio y la hora actual -->
		<div class="col-md-8 mb-2 pt-2 text-center" style="color: #2d3436;">
			<h1 class="font-weight-bold">
				@foreach($services as $service)
					{{ $service->name }}
				@endforeach
			</h1>
			
		  <p class="lead">Escoja la fecha, empleado y hora que desee. Todas las fechas y horas mostradas están disponibles. Este servicio tiene una duración de {{ $service->id_duration }} @if($service->id_duration > 1) horas. @else hora. @endif
			</p>		  
			<!-- Son las {{ date('g:ia') }} -->
		</div>

		@foreach($dates as $date) <!-- dias y fechas de la semana -->
			
			@foreach($festivos as $festivo) <!-- Se establecen dias festivos para ocultarlos de la agenda disponible -->
				@if($date['fecha'] == strtotime($festivo->date)) 
					@php $date['status'] = 'festivo' @endphp
				@endif
			@endforeach
			
			@if($date['status'] == 'laboral') <!-- If para mostrar solo dias laborales -->
				<div class="col-md-8 mb-3">
					<hr>
					<span class="h2">{{ strftime('%A %d %b',$date['fecha']) }}</span>
				</div>

				@foreach($employeesCategories as $employeeCategory) <!-- empleados que pertenecen a la categoria -->
					
					@foreach($employees as $employee) <!-- ciclo empleados -->

						@if($employee->id == $employeeCategory->id_employee) <!-- if empleados -->
						<div class="col-md-8">

							<div class="card mb-3">
								<!-- Nombre y foto del empleado -->
		           	<div class="card-header text-left">
									<img src="{{ asset('img/empleado') . '/' . $employeeCategory->id_employee . '.png' }}" height="32" width="32" alt="">{{ $employee->name }}
								</div>

								<!-- Se aplica d-flex y table-responsive para permitir el scroll horizontal -->
								<div class="card-body d-flex table-responsive">
									@foreach($hours as $hour) <!-- ciclo horas -->
										
										@foreach($bookings as $booking)	<!-- ciclo citas -->
											
											@if($booking->date == date('Y-m-d',$date['fecha']) && $booking->id_employee == $employee->id) <!-- if condicionales horas ocupadas -->

												@if($hour['hora'] == $booking->start) <!-- Si la hora es igual a la hora de inicio de la cita programada -->
													@php $hour['status'] = 'ocupado' @endphp
												@endif
												
												@if($hour['hora'] > $booking->start and $hour['hora'] < $booking->end) <!-- Si la hora es mayor a la hora de inicio y menor a la hora de fin de las cita programada -->
													@php $hour['status'] = 'ocupado' @endphp
												@endif
												
												@if($service->id_duration == 2) <!-- Si el servicio escogido dura 2 horas -->
													@if($hour['hora'] + 1 == $booking->start) <!-- Si la hora actual + 1 es igual a la hora de inicio de la cita -->
														@php $hour['status'] = 'ocupado' @endphp
													@endif
												@endif

											@endif <!-- Fin if horas ocupadas -->
										@endforeach <!-- Fin ciclo citas -->
										
										@if($service->id_duration == 2) <!-- Si el servicio escodigo dura 2 horas se marca la penultima hora del dia como ocupada -->
											@if($hour['hora'] == 17)
												@php $hour['status'] = 'ocupado' @endphp
											@endif
										@endif									
										
										@if($hour['status'] == 'disponible') <!-- if horas disponibles -->

											@if(date('Ymd', $date['fecha']) == date('Ymd') && $hour['hora'] > date('G', mktime(date('G')+2, 0, 0, date('m'), date('d'), date('Y')))) <!-- Si las horas son del mismo dia se muestra disponibilidad 2 horas adelante de la hora actual -->
												<a href="{{ url('confirmation') . '/' . $service->id . '/' . $employee->id . '/' . $date['fecha'] . '/' . $hour['hora'] . '/' . $service->id_duration }}" class="btn btn-outline-success mr-2">
												{{ date('ga', strtotime($hour['hora'] . ':00')) }}
												</a>
											@endif 

											@if(date('Ymd', $date['fecha']) > date('Ymd')) <!-- Si la reserva es para el dia siguiente o mayor se muestra el horario normal -->
												<a href="{{ url('confirmation') . '/' . $service->id . '/' . $employee->id . '/' . $date['fecha'] . '/' . $hour['hora'] . '/' . $service->id_duration }}" class="btn btn-outline-success mr-2">
												{{ date('ga', strtotime($hour['hora'] . ':00')) }}
												</a>
											@endif

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
			
			<!-- Fin if dias laborales -->
			@endif
		<!-- Fin ciclo dias semana -->
		@endforeach
	</div>	
</div>
@endsection