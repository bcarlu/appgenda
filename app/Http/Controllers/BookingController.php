<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\EmployeeCategory;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $user = $request->user()->id;
        $service = $request->service;
        $employee = $request->employee;
        $date = date('Y-m-d', $request->date);
        $start = $request->start;
        $duration = $request->duration;
        $end = $start + $duration;
        $idcategory = EmployeeCategory::where('id_employee', $employee)->get('id_category');
        foreach ($idcategory as $category) {
            $category = $category->id_category;
        }

        // Antes de registrar la cita se valida si la reserva ya fue hecha o no 
        $bookings = Booking::where('date', $date)->where('start', $start . ':00')->where('id_employee', $employee)->get();
        // Si ya existen registros que coincidan con la fecha, hora y empleado
        if (count($bookings) > 0) {
            return redirect('/home/categories' . '/' . $category . '/services' . '/' . $service )->with('error', 'Ups, alguien acaba de tomar el cupo, por favor escoge otra hora');
        }
        // Si no hay registros se procede a registrar la cita, se redirecciona al home y se informa al usuario.  
        else{

            $booking = new Booking();
            $booking->id_service = $service;
            $booking->id_employee = $employee;
            $booking->id_user = $user;
            $booking->id_bookings_state = 1;
            $booking->date = $date;
            $booking->start = $start . ':00';
            $booking->end = $end . ':00';

            $booking->save();

            return redirect('/home')->with('success', 'Su reserva se ha registrado con exito! Nos vemos pronto ;)');
        }
    }
}
