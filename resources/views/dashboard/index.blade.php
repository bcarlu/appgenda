@extends('layouts.app')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 mb-5">
          <span class="h2">Dashboard</span>
          @can('is-admin')
             <span class="badge float-right badge-info text-white">Eres Administrador</span>
          @endcan
          @can('is-employee')
             <span class="badge float-right badge-info text-white">Eres Empleado</span>
          @endcan
      </div>
			
    	<div class="col-md-8">
    		@foreach($dates as $date)

  			<!-- Muestra titulo con dia y fecha -->
    		<h4 class="font-weight-bold">
					{{ strftime('%A %e %B',$date['fecha']) }}
				</h4>

				<!-- Tarjeta con las citas por fecha -->	
					@foreach ($employees as $employee) @endforeach
	    		@foreach ($bookings as $booking)
	    			@if(strtotime($booking->date) == $date['fecha'])
							<!-- Tarjeta con los detalles de la cita -->
							<div class="card mb-3 bg-light">								
									<div class="card-body p-1 text-left">
										<div class="row no-gutters">
											<!-- Hora -->
											<div class="col-3 text-center p-2">												
												<span class="card-tittle font-weight-bold h4">
												{{ date('g:i A', strtotime($booking->start)) }}
												</span>
											</div>
											<div class="col-9 text-left p-1">
												<!-- Imagen empleado -->
												<img src="{{ asset('img/empleado') . '/' . $booking->id_employee . '.png' }}" height="32" width="32" alt="">
												<!-- Empleado -->
												<span>											 
													@foreach ($employees as $employee)
														@if ($booking->id_employee == $employee->id)
															{{ $employee->name }}
														@endif
													@endforeach
												</span>
												
												<!-- Servicio -->
												<span>
													tiene
													<b>
														@foreach ($services as $service)							
															@if ($booking->id_service == $service->id)
																{{ $service->name }}
															@endif							
														@endforeach
													</b>
												</span>									
												
												<!-- Cliente -->
												<span>
													con 
													@foreach ($clients as $client)							
														@if ($booking->id_user == $client->id)
															{{ $client->name }}
														@endif							
													@endforeach
												</span>
											</div>
										</div>
										
										
									</div>				
							</div> <!-- Fin card -->
						@endif
	    		@endforeach <!-- Foreach bookings -->
    		@endforeach <!-- Foreach dates -->
    	</div>
			<div class="card-body fixed-bottom text-right">
				<!-- <a href="{{ url('/home') }}" class="btn btn-warning">Dashboard</a> -->
	      <a href="{{ Route('categories') }}" class="btn btn-primary">Nueva cita</a>
				
			  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Mas
			  </button>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
			    <a href="#" class="dropdown-item" type="button">Nuevo usuario</a>
			    <a href="#" class="dropdown-item" type="button">Agregar festivo</a>
			    <a href="#" class="dropdown-item" type="button">Mas</a>
			  </div>
			
	    </div>
    </div>
</div>
@endsection