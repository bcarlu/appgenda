<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Booking;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Reservas hechas por el usuario actual
        $id = Auth::user()->id;        
        $bookings = Booking::where('id_user', $id)
            ->orderBy('date', 'asc')
            ->orderBy('start', 'asc')
            ->get();
        $employees = Employee::all();
        $services = Service::all();


        $data = [
            'bookings'  => $bookings,
            'employees'   => $employees,
            'services' => $services,
        ];

        // Se establece la zona horaria por defecto
        date_default_timezone_set('America/Bogota');

        // Establece el locale a español para enviar a la vista
        setlocale(LC_TIME, 'es_CO.utf8');

        return view('home')->with($data);      
    }
}
