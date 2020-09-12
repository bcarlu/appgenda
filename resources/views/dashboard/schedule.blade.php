@extends('layouts.app')

@section('content')
	<div class="container">

		<div class="row justify-content-center">
			<div class="col-md-8 mb-3">
	      <span class="h3">Empleados</span>
	      @can('is-admin')
	         <span class="badge float-right badge-info text-white">Eres Administrador</span>
	      @endcan
	      @can('is-employee')
	         <span class="badge float-right badge-info text-white">Eres Empleado</span>
	      @endcan
	    </div>
  	</div>
		
		<!-- Avatar de empleado -->
		<div class="row justify-content-center">    	
			<div class="col-md-8 mb-3">
				<div class="card mb-3">
					<div class="card-body d-flex table-responsive">
						@foreach($employees as $employee)
							<a href="{{ '#' . $employee->id }}" class="btn btn-outline-success mr-2">
								<img src="{{ asset('img/empleado') . '/' . $employee->id . '.png' }}" height="32" width="32" alt="">
								{{ $employee->name }}
							</a>
						@endforeach
					</div>
				</div>
			</div>
		</div>

		<!-- Agenda -->
		<div class="row justify-content-center">
			<div class="col-md-8 mb-3">
	      <span class="h3">Agenda</span>
	    </div>
  	</div>

		<div class="row justify-content-center"> <!-- Row container -->
			<div class="col-md-8"> <!-- Col container -->
					
						@foreach($employees as $employee) <!-- Empleados -->
							<div class="row">
								<div class="col-12 pt-2 bg-primary" id="{{ $employee->id }}">
										<img src="{{ asset('img/empleado') . '/' . $employee->id . '.png' }}" height="32" width="32" alt="">
									{{ $employee->name }}
								</div>

								@foreach($dates as $date) <!-- Fechas -->

									<div class="col-12 text-left bg-light">
										{{ strftime('%a',$date['fecha']) }} <br>
										{{ strftime('%e',$date['fecha']) }}
									</div>
								
									@foreach ($hours as $hour) <!-- Horas -->									
							    	<div class="col-2 px-1 text-right">
							    		{{ date('g a', strtotime($hour['hora'] . ':00')) }}
							    	</div>

							    	<div class="col-10 text-left border">
							    		@foreach($bookings as $booking) <!-- Citas -->
												@if($booking->id_employee == $employee->id 
												&& strtotime($booking->date) == $date['fecha'] 
												&& $booking->start == $hour['hora'])
													@foreach($services as $service) <!-- Nombre servicio -->
														@if($service->id == $booking->id_service)
															{{ $service->name }}
														@endif
													@endforeach <!-- Fin Nombre servicio -->
												@endif
											@endforeach <!-- Fin Citas -->
										</div>							    				
									@endforeach <!-- Fin Horas -->
								@endforeach <!-- Fin Fechas -->
							</div>
						@endforeach <!-- Fin Empleados -->
					
			</div> <!-- Fin col container -->
		</div> <!-- Fin row container -->

		@include('layouts.footeradmin')

</div> <!-- Container -->
@endsection