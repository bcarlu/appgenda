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

    	/**
	     * Arreglo con el numero de dias a mostrar
	     */
    	$days = array();
    	for ($i=0; $i <=4 ; $i++) { 
    		$days[] = $i;
    	}

        /**
	     * Locale a español y Fechas en formato plano para ser comparado con las fechas de bookings
	     */
    	setlocale(LC_TIME, 'es_CO.utf8');
    	$dates = array();
    	foreach ($days as $day) {
    		$dates[] = mktime(0, 0, 0, date("m")  , date("d")+$day, date("Y"));
    	}

        /**
         * Arreglo para las horas del dia
         */
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
