@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 mb-3">
			<h2>{{ $users->name }}</h2>
		</div>

		<div class="col-md-8 mb-3">
			<!--Valida si el usuario no tiene citas-->    
      @if(count($bookings) == 0)
          <div class="alert alert-warning h3 text-center" role="alert">El usuario no ha agendado citas.
          </div>
      @endif

			<!-- Valida si el usuario ya ha programado citas --> 
      @foreach($bookings as $booking) @endforeach
      @if(isset($booking) && strtotime($booking->date) < strtotime(date('Ymd')))
        <div class="alert alert-warning alert-dismissible fade show h3 text-center" role="alert">El usuario esta al dia.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @endif

      @foreach ($bookings as $booking)
      	@if(strtotime($booking->date) >= strtotime(date('Ymd')))
				 	<div class="card mb-3">
					 	<div class="card-body ">
						 	<h4 class="h4">
	              @foreach($services as $service)
	                  @if($booking->id_service == $service->id)
	                      {{ $service->name }}
	                  @endif
	              @endforeach
	            </h4>

	            <span><b>Fecha:</b> {{ strftime('%A %e %B',strtotime($booking->date)) }} de {{ date('ga', strtotime($booking->start)) }} a {{ date('ga', strtotime($booking->end)) }}</span><br>
                            
              <span><b>Esteticista:</b>
                  @foreach($employees as $employee)
                       @if($booking->id_employee == $employee->id)
                          {{ $employee->name }}
                       @endif
                  @endforeach
              </span><br>
              <span><b>Precio:</b> 
                  @foreach($services as $service)
                       @if($booking->id_service == $service->id)
                          $COP {{ $service->price }}
                       @endif
                  @endforeach
              </span>
					 	</div>
				 	</div>
				@endif
			@endforeach
		</div>
	</div>

  @include('layouts.footeradmin')
  
</div>
@endsection