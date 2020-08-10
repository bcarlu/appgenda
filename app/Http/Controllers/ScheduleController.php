<?php

namespace App\Http\Controllers;
use App\Booking;
use App\EmployeeCategory;
use App\Employee;
use App\Service;
use App\Holiday;


use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $employeesCategories = EmployeeCategory::where('id_category', $request->category)->get();
    	$employees = Employee::where('id_status', 1)->get();
    	$service = Service::where('id', $request->service)->first();
        $bookings = Booking::where('id_status', 1)->get();
        $user = $request->user()->id;
        $festivos = Holiday::all();

        // Si el usuario escoge un servicio que ya agendó y está pendiente
        foreach ($bookings as $booking) {
            if ($booking->id_user == $user && $booking->id_service == $service->id) {
                return redirect('/home')->with('cita-pendiente',"Ya agendaste $service->name Por favor escoge un nuevo servicio.");
            }
        }

        $firstDay = 0; /*Se asigna variable para realizar un for que recorra un numero de dias especificos*/

        /* Dependiendo de la duracion del servicio y la hora se define el $firstday en 1*/
        if ($service->id_duration == 1 
            && date('G') >= date('G', strtotime('15:00'))) {
            $firstDay = 1;
        }
        if ($service->id_duration == 2 
            && date('G') >= date('G', strtotime('14:00'))) {
            $firstDay = 1;
        }

        /*Se carga la cantidad de dias en $days*/
    	for ($i = $firstDay; $i <= 5 ; $i++) { 
    		$days[] = $i;
    	}        
    	
        /*Se crea fechas y se cargan en $dates*/
        foreach ($days as $day) {
            $dates[] = [
                'fecha' => 
                    mktime(0, 0, 0, 
                    date("m")  , 
                    date("d") + $day, 
                    date("Y")), 
                'status' => 'laboral'
            ];           
    	}

        /*Arreglo para las horas del dia*/       
        for ($i=8; $i <=17 ; $i++) { 
            $hours[] = [ 'hora' =>$i, 'status' => 'disponible'];
        }
        
        /*Se establece locale a español*/        
        setlocale(LC_TIME, 'es_CO.utf8');

    	$data = [
            'employeesCategories'  => $employeesCategories,
            'employees' => $employees,
            'service' => $service,
            'bookings' => $bookings,
            'dates' => $dates,
            'hours' => $hours,
            'festivos' => $festivos,
        ];

    	return view('schedule')->with($data);
    }
}
