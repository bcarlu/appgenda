<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Booking;
use App\BookingStatus;
use App\Employee;
use App\Service;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Se definen propiedades para almacenar las citas hechas por el usuario actual
        $id = Auth::user()->id;        
        $bookings = Booking::where('id_user', $id)
            ->orderBy('date', 'asc')
            ->orderBy('start', 'asc')
            ->get();
        $bookingStatus = BookingStatus::all();
        $employees = Employee::all();
        $services = Service::all();

        // Array data almacena en una sola variable los datos enviados a la vista
        $data = [
            'bookings'  => $bookings,
            'employees'   => $employees,
            'services' => $services,
            'bookingStatus' => $bookingStatus,
        ];

        // Se establece la zona horaria por defecto
        date_default_timezone_set('America/Bogota');

        // Establece el locale a español para enviar a la vista
        setlocale(LC_TIME, 'es_CO.utf8');

        return view('home', $data);      
    }
}
