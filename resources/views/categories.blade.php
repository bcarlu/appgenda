@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 mb-3">
				<span class="h3">Escoge una categoria</span>
		</div>
				
		<div class="col-md-8 text-center">
			<div class="card-deck">
				@foreach($categories as $category)				
			  <div class="card">
			  	@if ($category->id == 1)
			    <img src="{{ asset('img/cat-unas.jpg') }}" class="card-img-top" alt="...">
			    @endif
			    @if ($category->id == 2)
			    <img src="{{ asset('img/cat-cera.jpg') }}" class="card-img-top" alt="...">
			    @endif
			    @if ($category->id == 3)
			    <img src="{{ asset('img/cat-spa.jpg') }}" class="card-img-top" alt="...">
			    @endif

			    <div class="card-body">
			      <h3 class="card-title">{{ $category->name }}</h3>			      
			      <p class="card-text">Aqui va la descripción del servicio.</p>
			      <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
			      @if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif
						<a href="{{ url('/home/categories') . '/' . $category->id . '/services' }}" class="btn btn-primary" style="background: #6c5ce7">Escoger</a>
			    </div>
			  </div>
			  @endforeach
		  </div>				
    </div>      
		
	</div> <!-- Fin row -->
</div> <!-- Fin container -->
@endsection