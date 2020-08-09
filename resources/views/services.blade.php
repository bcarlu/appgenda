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
				<a href="{{ url('/home/categories') . '/' . $service->id_category . '/services/' . $service->id . '/schedule' }}" class="btn shadow-lg p-3 mb-5 mr-1 bg-white">
					
				  <!-- <img src="{{ asset('img/catunas.jpg') }}" class="card-img" alt="..."> -->
				  <!-- <div class="card-img-overlay"> -->
				    <span class=" h2 ">				    
							<b>{{ $service->name }}</b>				    
				  	</span>
				  <!-- </div> -->
				
				</a>
				
				@endforeach
			

		</div>		
	</div>
@endsection