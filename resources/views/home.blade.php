@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <span class="h2">Mis servicios</span>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <div class="col-md-8">
            <!--Valida si el usuario no tiene citas-->    
            @if(count($bookings) == 0)
                <div class="alert alert-warning alert-dismissible fade show h3 text-center" role="alert">Aún no haz agendado tu primera cita, Animate a reservar una ahora! :)</div>
            @endif
            
            <!-- Valida si el usuario ya ha programado citas --> 
            @foreach($bookings as $booking) @endforeach
            @if(isset($booking) && strtotime($booking->date) < strtotime(date('Ymd')))
                <div class="alert alert-warning alert-dismissible fade show h3 text-center" role="alert">Estás al dia, que tal si agendas una nueva cita ahora! :)
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            <!-- Valida si el usuario tiene citas pendientes -->
            @foreach($bookings as $booking)     
                @if(strtotime($booking->date) >= strtotime(date('Ymd')) && $booking->id_bookings_state == 1)
                    <div class="card mb-3">
                       <div class="card-header text-center">
                            <span class="h4">
                                @foreach($services as $service)
                                    @if($booking->id_service == $service->id)
                                        {{ $service->name }}
                                    @endif
                                @endforeach
                            </span>

                            <!-- Si la cita es para la fecha actual pero ya paso la hora -->
                            @if(strtotime($booking->date) == strtotime(date('Ymd')) && date('G', strtotime($booking->start)) < date('G'))
                               <span class="badge badge-success float-right">Finalizada</span>
                            @endif                   
                        </div>

                        <div class="card-body">                      
                            
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
                            <a href="#" class="btn btn-warning float-right">Editar</a>
                        </div>                
                    </div>
                @endif
            @endforeach
            
            <div class="card-body fixed-bottom text-right">
                <a href="{{ Route('categories') }}" class="btn btn-primary">Reservar</a>
            </div>  
                                 
        </div>
    </div>
</div>
@endsection
