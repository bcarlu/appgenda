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
    

