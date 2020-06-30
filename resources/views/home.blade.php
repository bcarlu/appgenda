@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <span class="h2">Mis servicios</span>
        </div>
        
        <div class="col-md-8">
        <!--Valida si el usuario no tiene citas-->    
        @if(count($bookings) == 0)
            <div class="alert alert-warning alert-dismissible fade show h3 text-center" role="alert">Aún no haz agendado tu primera cita, Animate a reservar una ahora! :)</div>
        @endif
        
        <!-- Valida si el usuario ya ha programado citas --> 
        @foreach($bookings as $booking) @endforeach
        @if(isset($booking) && strtotime($booking->date) < strtotime(date('Ymd')))
            <div class="alert alert-warning alert-dismissible fade show h3 text-center" role="alert">Estás al dia, que tal si agendas una nueva cita ahora! :)</div>
        @endif
        
        <!-- Valida si el usuario tiene citas pendientes -->
        @foreach($bookings as $booking)                
            @if(strtotime($booking->date) >= strtotime(date('Ymd')) && $booking->id_bookings_state == 1)
                <div class="card mb-3">
                   <div class="card-header text-center">
                        <span class="h4">@foreach($services as $service)
                             @if($booking->id_service == $service->id)
                                {{ $service->name }}
                             @endif
                        @endforeach</span>                    
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <span><b>Fecha:</b> {{ strftime('%A %e %B',strtotime($booking->date)) }} de {{ $booking->start }} a {{ $booking->end }}</span><br>
                        
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
                        <a href="#" class="btn btn-warning float-right">Editar</a>
                    </div>                
                </div>
            @endif
        @endforeach
        
    

            <div class="card-footer fixed-bottom text-center">
                <a href="{{ Route('categories') }}" class="btn btn-primary">Reservar</a>
            </div>            
        </div>
    </div>
</div>
@endsection
