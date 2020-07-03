<?php

namespace App\Http\Controllers;
use App\Booking;
use App\EmployeeCategory;
use App\Employee;
use App\Service;


use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($category, $service)
    {
    	$employeesCategories = EmployeeCategory::where('id_category', $category)->get();
    	$employees = Employee::where('id_state', 1)->get();
    	$services = Service::where('id', $service)->get();
    	$bookings = Booking::where('id_bookings_state', 1)->get();

        /*Se almacena el objeto services en service*/
        foreach ($services as $service) {
            $service = $service;
        }

        $d = 0; /*Se asigna variable para realizar un for que recorra un numero de dias especificos*/

        /*Dependiendo de la duracion del servicio que el cliente este solicitando se asignara valor de 1 a la variable d para que el recorrido de los dias comience a partir del dia siguiente*/
    	if ($service->id_duration == 1 && date('G') >= date('G', strtotime('15:00'))) {
            $d = 1;
        }
        if ($service->id_duration == 2 && date('G') >= date('G', strtotime('14:00'))) {
            $d = 1;
        }

        /*Arreglo con el numero de dias*/	   
    	$days = array();
    	for ($i=$d; $i <=4 ; $i++) { 
    		$days[] = $i;
    	}

        /*Se establece locale a español y fechas recorriendo los dias definidos en la variable days para ser comparado con las fechas de bookings*/	     
    	setlocale(LC_TIME, 'es_CO.utf8');
    	$dates = array();
    	foreach ($days as $day) {
    		$dates[] = mktime(0, 0, 0, date("m")  , date("d")+$day, date("Y"));
    	}

        /*Arreglo para las horas del dia*/       
        $hours = array();
        for ($i=8; $i <=17 ; $i++) { 
            $hours[] = [ 'hora' =>$i, 'state' => 'disponible'];

        }
        
    	$data = [
            'employeesCategories'  => $employeesCategories,
            'employees' => $employees,
            'services' => $services,
            'bookings' => $bookings,
            'dates' => $dates,
            'hours' => $hours,
        ];

    	return view('schedule')->with($data);
    }
}
