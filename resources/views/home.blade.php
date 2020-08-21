@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <span class="h2">
                Mis servicios
            </span>
            @can('is-admin')
               <span class="badge float-right badge-info text-white">Eres Administrador</span>
            @endcan
            @can('is-employee')
               <span class="badge float-right badge-info text-white">Eres Empleado</span>
            @endcan
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('cita-pendiente'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('cita-pendiente') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <div class="col-md-8">
            <!--Valida si el usuario no tiene citas-->    
            @if(count($bookings) == 0)
                <div class="alert alert-success h3 text-center" role="alert">Hola y bienvenido a Appgenda, que te parece si empezamos agendado tu primera cita, Animate, es facil y rapido! :)
                </div>
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
                @if(strtotime($booking->date) >= strtotime(date('Ymd')))
                    <div class="card mb-3">
                       <div class="card-header text-center">
                            <span class="h4">
                                @foreach($services as $service)
                                    @if($booking->id_service == $service->id)
                                        {{ $service->name }}
                                    @endif
                                @endforeach
                            </span>

                            <!-- Etiqueta con el estado de la cita -->
                            @foreach($bookingStatus as $status) 
                                @if($booking->id_status == $status->id)
                                   <span class="badge float-right @if($booking->id_status == 1) badge-success @else badge-danger @endif">{{ $status->status }}</span>
                                @endif
                            @endforeach
                                               
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
                            <div class="btn-group float-right">
                              <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Editar
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Reagendar</a>
                                <a class="dropdown-item" href="#">Cancelar</a>
                              </div>
                            </div>
                        </div>                
                    </div>
                @endif
            @endforeach
            
            <div class="card-body fixed-bottom text-right">
                @can('in-dashboard')
                <a href="{{ url('/dashboard') }}" class="btn btn-warning">Dashboard</a>
                @endcan
                <a href="{{ Route('categories') }}" class="btn btn-primary">Reservar</a>
            </div>  
                                 
        </div>
    </div>
</div>
@endsection
