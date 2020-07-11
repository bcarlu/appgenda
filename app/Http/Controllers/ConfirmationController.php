<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Employee;
use App\Booking;

class ConfirmationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    		$user = $request->user()->id;
        $services = Service::where('id',$request->service)->get();
        $employees = Employee::where('id',$request->employee)->get();
        $date = $request->date;
        $start = $request->start;
        $duration = $request->duration;
        $end = $start + $duration;
        $category = Service::where('id', $request->service)->first('id_category');

        // Antes de redireccionar a la vista de confirmacion se valida si el usuario ya tiene alguna cita que se cruce con esa misma fecha y hora que va a programar
        $bookingsOfUser = Booking::where('date', date('Y-m-d', $date))->where('id_user', $user)->where('id_status', 1)->get();  

          foreach ($bookingsOfUser as $bookinguser) {            

              // Se establecen variables para trabajar con las condiciones if
              $startSchedule = strftime("%H:%M:%S", strtotime($start . ':00:00'));
              $endSchedule = strftime("%H:%M:%S", strtotime($end . ':00:00'));
              $serviceSelected = Service::where('id',$request->service)->first('id');
              $nameScheduledService = Service::where('id',$bookinguser->id_service)->get();
              $redirect = redirect('/home/categories' . '/' . $category->id_category . '/services' . '/' . $serviceSelected->id )->with('error', 'Oh oh, ya tiene programada una cita en ese rango de horas. Puede escoger otra hora u otro dia.');

              if ($startSchedule == $bookinguser->start) {
                
                return $redirect;

              }

              if ($startSchedule > $bookinguser->start && $startSchedule < $bookinguser->end) {
                
                return $redirect;

              }

              if ($startSchedule < $bookinguser->start && $endSchedule > $bookinguser->start) {
                
                return $redirect;

              }

          }

        setlocale(LC_TIME, 'es_CO.utf8'); // Se establece locale en español

        $data = [
          'services' => $services,
          'employees' => $employees,
          'date' => $date,
          'start' => $start,
        ];

        return view('confirmation')->with($data);

    } //end function index

  } //end class  
    

