<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Booking;
use App\BookingStatus;
use App\Employee;
use App\Service;
use App\Holiday;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','can:in-dashboard']);
    }

    public function index()
    {
    	$user = Auth::user()->id_employee;
    	$employees = Employee::all();
    	$bookingStatus = BookingStatus::all();
    	$bookings = Booking::orderBy('date', 'asc')->orderBy('start', 'asc')->get();
    	$services = Service::all();
      $clients = User::all();
		
  		
    	$d = 0; /*Se asigna variable para realizar for que recorra un numero de dias especificos*/

    	/*Arreglo para recorrer los dias*/
    	for ($i=$d; $i <=5 ; $i++) { 
    		$days[] = $i;
    	}

    	/*Se crea array dates cargando el array days para crear las fechas*/
        foreach ($days as $day) {
    		$dates[] = ['fecha' => mktime(0, 0, 0, date("m")  , date("d")+$day, date("Y")), 'status' => 'laboral'];           
    	}

    	/*Se crea array para establecer los dias no laborales y festivos*/
      $festivos = Holiday::all();


  		// Se almacenan en array data todas la variables que se envian a la vista
      $data = [
        'bookings' => $bookings,
        'employees'	=> $employees,
        'bookingStatus' => $bookingStatus,
        'user' => $user,
        'services' => $services,
        'dates' => $dates,
        'festivos' => $festivos,
        'clients' => $clients
      ];

      // Se establece la zona horaria por defecto
      date_default_timezone_set('America/Bogota');

      // Establece el locale a español para enviar a la vista
      setlocale(LC_TIME, 'es_CO.utf8');

      return view('dashboard.index')->with($data);
    }
}
