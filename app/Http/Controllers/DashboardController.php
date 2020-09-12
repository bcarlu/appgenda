<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Booking;
use App\BookingStatus;
use App\Employee;
use App\Service;
use App\Holiday;
use App\EmployeeCategory;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','can:in-dashboard']);
    }

    public function index()
    {
    	$totalUsers = User::where('id_role', 3)->count();
      $totalBookingsToday = Booking::where('date', date('Y-m-d'))->where('id_status', 1)->count();
      $totalEmployees = Employee::where('id_status', 1)->count();

      $data = [
        'totalUsers' => $totalUsers,
        'totalBookingsToday' => $totalBookingsToday,
        'totalEmployees' => $totalEmployees,
      ];

      return view('dashboard.index', $data);
    }

    public function showSchedule()
    {
      $user = Auth::user()->id_employee;
      $employees = Employee::all();
      $bookingStatus = BookingStatus::all();
      $bookings = Booking::orderBy('date', 'asc')->orderBy('start', 'asc')->get();
      $services = Service::all();
      $clients = User::all();
    
      
      $firstDay = 0; /*Se asigna variable para realizar for que recorra un numero de dias especificos*/

      /*Arreglo para recorrer los dias*/
      for ($i=$firstDay; $i <=5 ; $i++) { 
        $days[] = $i;
      }

      /*Se crea array dates cargando el array days para crear las fechas*/
        foreach ($days as $day) {
        $dates[] = ['fecha' => mktime(0, 0, 0, date("m")  , date("d")+$day, date("Y")), 'status' => 'laboral'];           
      }

      /*Arreglo para las horas del dia*/       
        for ($i=8; $i <=17 ; $i++) { 
          $hours[] = [ 'hora' =>$i, 'status' => 'disponible'];
        }

      /*Se crea array para establecer los dias no laborales y festivos*/
      $festivos = Holiday::all();


      // Se almacenan en array data todas la variables que se envian a la vista
      $data = [
        'bookings' => $bookings,
        'employees' => $employees,
        'bookingStatus' => $bookingStatus,
        'user' => $user,
        'services' => $services,
        'dates' => $dates,
        'festivos' => $festivos,
        'clients' => $clients,
        'hours' => $hours
      ];

      // Se establece la zona horaria por defecto
      date_default_timezone_set('America/Bogota');

      // Establece el locale a español para enviar a la vista
      setlocale(LC_TIME, 'es_CO.utf8');

      return view('dashboard.schedule', $data);
    }

    public function showServices()
    {
      $services = Service::all();

      $data = [
        'services' => $services,
      ];

      return view('dashboard.services', $data);
    }

    public function showAvailability(Request $request)
    {
      $service = Service::where('id',$request->id)->first();
      $employeesCategories = EmployeeCategory::where('id_category', $service->id_category)->get();
      $employees = Employee::where('id_status', 1)->get();
      $bookings = Booking::where('id_status', 1)->get();
      $holidays = Holiday::all();
      
      $days = new Booking();
      $dates = $days->setDays(4,$service->id_duration);
      $hours = $days->setHoursByDay(8, 17);

      setlocale(LC_TIME, 'es_CO.utf8');

      $data = [
        'employeesCategories' => $employeesCategories,
        'employees' => $employees,
        'service' => $service,
        'dates' => $dates,
        'holidays' => $holidays,
        'hours' => $hours,
        'bookings' => $bookings,
      ];
      
      return view('dashboard.newbooking', $data);
    }

}
