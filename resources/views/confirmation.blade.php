@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 mb-3">
			<div class="card">
				<div class="card-header text-center h4">Resumen</div>
				<div class="card-body">
					@foreach($services as $service)@endforeach
					@foreach($employees as $employee)@endforeach
					<div class="h5 text-center text-success">Antes de finalizar, por favor revisa bien que todos los datos sean correctos y confirma tu cita.</div> <br>
					
					<b>Servicio:</b> {{ $service->name }} <br>
					<b>Fecha:</b> {{ strftime('%A %d %b',$date) }} <br>
					<b>Hora:</b> {{ date('ga', strtotime($start . ':00')) }} <br>
					<b>Empleado:</b> {{ $employee->name }} <br><br>
					
					Duracion : {{ $service->id_duration }} @if($service->id_duration > 1) horas @else hora @endif <br>
					Precio: {{ $service->price }} <br>
					<a href="{{ url('/schedule/store') . '/' . $service->id . '/' . $employee->id . '/' . $date . '/' . $start . '/' . $service->id_duration }}" class="btn btn-success float-right">Confirmar</a>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection