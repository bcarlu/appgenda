@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 mb-3">
				<span class="h3">Escoge una categoria</span>
		</div>
				
		<div class="col-md-8">
				@foreach($categories as $category)            
				<div class="card mb-3">
					 <div class="card-header text-center">
							<span class="h4">								
									{{ $category->name }}								
							</span>                    
						</div>

						<div class="card-body">
								@if (session('status'))
										<div class="alert alert-success" role="alert">
												{{ session('status') }}
										</div>
								@endif						
								
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae inventore atque hic earum repellat, necessitatibus eius similique qui maiores eaque laudantium cupiditate ea mollitia tempora! Minus, consectetur architecto cum praesentium!</p>
								<a href="{{ url('/home/categories') . '/' . $category->id . '/services' }}" class="btn btn-warning float-right">Escoger</a>
						</div>
				</div>
				@endforeach           
		</div>
	</div>
</div>
@endsection