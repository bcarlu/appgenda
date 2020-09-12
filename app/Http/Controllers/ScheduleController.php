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
        foreach ($bookings as $booking) 
        {
            if ($booking->id_user == $user 
                && $booking->id_service == $service->id
                && $booking->date >= date('Y-m-d'))
            {
                return redirect('/home')
                    ->with('cita-pendiente',"Ya agendaste $service->name Por favor escoge un nuevo servicio.");
            }
        }

        $days = new Booking();
        $dates = $days->setDays(4, $service->id_duration);
        $hours = $days->setHoursByDay(8, 17);
        
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

    	return view('schedule', $data);
    }
}
