@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 mb-3">
			<span class="h3">Agenda disponible para {{ $service['name'] }} </span>
		</div>			
	</div>
	<div class="row justify-content-center">
		<div class="col-md-8 mb-3">		
		@foreach ($dates as $date)			
			@foreach ($holidays as $holiday) 
				@if ($date['fecha'] == strtotime($holiday->date)) 
					@php $date['status'] = 'holiday' @endphp
				@endif
			@endforeach
			@if($date['status'] == 'workingDay')
				<div class="col-md-8 mb-3">
					<hr>
					<span class="h2">{{ strftime('%A %d %b',$date['fecha']) }}</span>
				</div>
				@foreach ($employeesCategories as $employeeCategory)
					@foreach ($employees as $employee) 
						@if ($employee->id == $employeeCategory->id_employee)
						{{ $employee->name }} <br>
						@endif
					@endforeach
				@endforeach
			@endif
		@endforeach
		</div>
	</div>
	
	@include('layouts.footeradmin')
</div>
@endsection