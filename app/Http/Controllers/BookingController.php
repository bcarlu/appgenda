<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Service;
use App\Employee;
use App\EmployeeCategory;
use App\Mail\ReservaRegistrada;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // Se definen las variables         
        $user = $request->user()->id;
        $nameuser = $request->user()->name;
        $emailuser = $request->user();            
        $service = $request->service;
        $employee = $request->employee;
        $date = date('Y-m-d', $request->date);
        $start = $request->start;           
        $duration = $request->duration;
        $end = $start + $duration;
        $idcategory = Service::where('id', $service)->get('id_category');
        
        foreach ($idcategory as $category) {
            $category = $category->id_category;
        }

        // Antes de registrar la cita se valida si la reserva ya fue hecha o no 
        $bookings = Booking::where('date', $date)->where('start', $start . ':00')->where('id_employee', $employee)->get();
        
        if (count($bookings) > 0) { // Si ya existen registros que coincidan con la fecha, hora y empleado se redirecciona a la pagina de schedule y se emite mensaje de error.
            return redirect('/home/categories' . '/' . $category . '/services' . '/' . $service )->with('error', 'Ups, alguien acaba de tomar el cupo, por favor escoge otra hora');
        }
        
        else { // Si no hay citas registradas

            // Se asocian datos recibidos a los campos del modelo booking
            $booking = new Booking();            
            $booking->id_service = $service;
            $booking->id_employee = $employee;
            $booking->id_user = $user;
            $booking->id_status = 1;
            $booking->date = $date;
            $booking->start = $start . ':00';
            $booking->end = $end . ':00';

            $booking->save(); // Y se guardan los registros en la base de datos.

            // Se genera array data para enviar informacion al modelo mailable y este a su vez a la vista emails.reserva-registrada
            $servicename = Service::where('id', $service)->get('name');
            foreach ($servicename as $service) {
                $service = $service->name;
            }

            $employeename = Employee::where('id', $employee)->get('name');
            foreach ($employeename as $employee) {
                $employee = $employee->name;
            }

            $data = [
                'service' => $service,
                'employee' => $employee,
                'date' => $date,
                'start' => $start,
                'duration' => $duration,
                'end' => $end,
                'nameuser' => $nameuser,
            ];

            // Se envia notificacion con los datos de la cita.
            Mail::to($emailuser)->send(new ReservaRegistrada($data));

            // Y se redirecciona al home con mensaje de exito.
            return redirect('/home')->with('success', 'Su reserva se ha registrado con exito! Nos vemos pronto ;)');
        }
    }
}
