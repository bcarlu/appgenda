<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reserva registrada con exito</title>
</head>
<body>
	<p>Hola {{ $booking['nameuser'] }},</p>
	<p>Tu servicio <b>{{ $booking['service'] }}</b> se agendó con éxito. Recuerda</p>
	<span><b>Fecha: </b>{{ strftime('%A %e %B',strtotime($booking['date'])) }}</span> <br>
	<span><b>Hora: </b> {{ date('ga', strtotime($booking['start'] . ':00')) }} a {{ date('ga', strtotime($booking['end'] . ':00')) }}</span> <br>
	<span><b>Empleado: </b>{{ $booking['employee'] }}</span> <br>
</body>
</html>