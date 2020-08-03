@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 mb-3">
			<h2>Usuarios</h2>
		</div>
	</div>
	<div class="row justify-content-center">
		<!-- Buscador -->
		<div class="col-md-8 mb-3">
			<form method="GET" action="{{ url('dashboard/users') }}">
				<!-- @csrf -->
				<div class="input-group">
				  <input type="search" name="name" class="form-control" placeholder="Ingrese el nombre a buscar" aria-label="Recipient's username" aria-describedby="basic-addon2">
				  <div class="input-group-append">
				    <input type="submit" class="input-group-text" id="basic-addon2" value="?">
				  </div>
				</div>
			</form>
		</div>

		<!-- Tabla usuarios -->
		<div class="col-md-8 mb-3">
			<table class="table table-hover table-dark table-responsive-sm">
		    <thead>
		      <th>Nombre</th>
		      <th>Email</th>
		      <th>Celular</th>
		    </thead>
		    <tbody>
		        @foreach($users as $user)
		        <tr>
		          <td>{{$user->name}}</td>
		          <td>{{$user->email}}</td>
		          <td>{{$user->phone}}</td>
		          <td><a class="btn btn-primary" href="{{ url('/dashboard/users') .'/'. $user->id }}">Ver</a></td>
		        </tr>
		        @endforeach
		    </tbody>
			</table>
			{{ $users->render() }}
		</div> <!-- Fin tabla usuarios -->
	</div>
</div>
@endsection