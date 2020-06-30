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
				<div class="card mb-2 mr-2" style="width: 18rem;">
				  <img src="{{ asset('img/Uñas.jpg') }}" class="card-img" alt="...">
				  <div class="card-img-overlay">
				    <h5 class="card-title">
				    
							{{ $service->name }}
				    
				  	</h5>
				    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
				    <a href="{{ url('/home/categories') . '/' . $service->id_category . ('/services') . '/' . $service->id  }}" class="btn btn-primary">Escoger</a>
				  </div>
				</div>
				@endforeach
			

		</div>		
	</div>
@endsection