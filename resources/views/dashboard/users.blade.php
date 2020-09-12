@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 mb-3">
			<span class="h2">Usuarios</span >
			<a href="{{ url('dashboard/user/new') }}" class="btn btn-success float-right">Nuevo</a>
		</div>		
	</div>
	
	<div class="row justify-content-center">
		<div class="col-md-8 mb-3">
			@if (session('success'))
	      <div class="alert alert-success alert-dismissible fade show" role="alert">
	        {{ session('success') }}
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
		  @endif
		</div>
	</div>
	

	<div class="row justify-content-center">
		<!-- Buscador -->
		<div class="col-md-8 mb-3">
			<form method="GET" action="{{ url('dashboard/users') }}">
				<!-- @csrf -->
				<div class="input-group mb-3">
				  <input type="search" name="name" class="form-control" placeholder="Busca por nombre, email o celular" aria-label="Recipient's username" aria-describedby="button-addon2">
				  <div class="input-group-append">
				    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
				  </div>
				</div>
			</form>
		<!-- Fin buscador -->
		</div>
		
		<div class="col-md-8 mb-3">
		<!-- Tarjeta de usuario -->
		@foreach($users as $user)
			<div class="card">
			  <div class="card-body">
			    <span class="h5">{{$user->name}}</span><br>
			    <a href="{{ url('/dashboard/users') .'/'. $user->id }}" class="btn btn-primary float-right">Ver</a>
			    <span class="card-text">{{$user->email}}</span><br>

			    <!-- Se agrega link al user phone 
			    	para redirigir directamente 
			    	al whatsapp del cliente 
			    -->
			    <a href="{{ 'https://wa.me/57' . $user->phone }}" target="blank">{{$user->phone}}</a>
			    
			  </div>
		  <!-- Fin tarjeta de usuario -->
			</div>
		@endforeach

		{{ $users->render() }}
		<!-- Fin col -->
		</div>

	<!-- Fin row -->
	</div>

	@include('layouts.footeradmin')
	
</div>
@endsection