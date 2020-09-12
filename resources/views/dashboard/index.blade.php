@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 mb-3">
			
			<div class="card-deck text-center">
				<div class="card">
				  <div class="card-body">
				  	<div class="p-2">
				  		<svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-calendar-event-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
							</svg>
				  	</div>
				    <h5 class="card-title">HOY</h5>
				    <p class="card-text">{{ $totalBookingsToday }} citas pendientes para hoy</p>
				    <a href="{{ url('/dashboard/schedule') }}" class="btn btn-primary stretched-link">Ver agenda</a>
				  </div>
				</div>

				<div class="card">				  
				  <div class="card-body">
				  	<div class="p-2">
				  		<svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-people-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
							</svg>
				  	</div>
				    <h5 class="card-title">USUARIOS</h5>
				    
				    	<p class="card-text">{{ $totalUsers }} usuarios registrados</p>
				    
				    <a href="{{ url('/dashboard/users') }}" class="btn btn-primary stretched-link">Ver usuarios</a>
				  </div>
				</div>

				<div class="card">
				  <div class="card-body">
				  	<div class="p-2">
				  		<svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-person-badge-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z"/>
							</svg>
				  	</div>
				    <h5 class="card-title">EMPLEADOS</h5>
				    <p class="card-text">{{ $totalEmployees }} empleados activos</p>
				    <a href="#" class="btn btn-primary stretched-link">Ver empleados</a>
				  </div>
				</div>
			</div>
		</div>
	</div>

	@include('layouts.footeradmin')

</div>
@endsection