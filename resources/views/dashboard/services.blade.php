@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 mb-3">
			@foreach ($services as $service)
			<a href="{{ url('/dashboard/service') . '/' . $service->id }}" type="button" class="btn btn-dark btn-block">{{ $service->name }}</a>
			@endforeach
		</div>
	</div>

@include('layouts.footeradmin')

</div>
@endsection