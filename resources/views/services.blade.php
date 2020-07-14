@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 mb-3">
					<span class="h3">Escoge un servicio</span>
			</div>
		</div>
		<div class="row justify-content-center">
			
			
				@foreach($services as $service)
				<div class="card mb-2 mr-2 text-white" style="width: 18rem;">
				  <img src="{{ asset('img/catunas.jpg') }}" class="card-img" alt="...">
				  <div class="card-img-overlay">
				    <h5 class="card-title">
				    
							<b>{{ $service->name }}</b>
				    
				  	</h5>
				    <p class="card-text">Descripción detallada del servicio.</p>
				    <a href="{{ url('/home/categories') . '/' . $service->id_category . '/services/' . $service->id . '/schedule' }}" class="btn btn-primary">Escoger</a>
				  </div>
				</div>
				@endforeach
			

		</div>		
	</div>
@endsection