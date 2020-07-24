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
    		<!-- <div class="card mb-3 p-3 bg-light"> --> 	
					
	    		@foreach ($bookings as $booking)
	    			@if(strtotime($booking->date) == $date['fecha'])
							<!-- Tarjeta con los detalles de la cita -->
							<div class="card mb-3 p-2 bg-primary">
									<span class="card-tittle font-weight-bold text-white">
										<!-- Hora -->
										{{ date('g:i A -', strtotime($booking->start)) }}
										<!-- Servicio -->
										@foreach ($services as $service)							
											@if ($booking->id_service == $service->id)
												{{ $service->name }}
											@endif							
										@endforeach
										<!-- Cliente -->
										para 
										@foreach ($clients as $client)							
											@if ($booking->id_user == $client->id)
												{{ $client->name }}
											@endif							
										@endforeach
									</span>
									<span class="text-white">
										 
										@foreach ($employees as $employee)
											@if ($booking->id_employee == $employee->id)
												{{ $employee->name }}
											@endif
										@endforeach
									</span>								
							</div>
						@endif
	    		@endforeach <!-- Foreach bookings -->
    		@endforeach <!-- Foreach dates -->
    	</div>
			<div class="card-body fixed-bottom text-right">
	        <a href="{{ url('/home') }}" class="btn btn-warning">Home</a>
	        <a href="{{ Route('categories') }}" class="btn btn-primary">Reservar</a>
	    </div>
    </div>
</div>
@endsection