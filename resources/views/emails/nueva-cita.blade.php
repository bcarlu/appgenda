<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva cita agendada</title>
</head>
<body>
    <p>El cliente <b>{{ $booking['nameuser'] }}</b> acaba de agendar <b>{{ $booking['service'] }}</b> con <b>{{ $booking['employee'] }}</b> para el <b>{{ strftime('%A %e %B',strtotime($booking['date'])) }}</b> de <b>{{ date('ga', strtotime($booking['start'] . ':00')) }}</b> a <b>{{ date('ga', strtotime($booking['end'] . ':00')) }}</b></p>
</body>
</html>