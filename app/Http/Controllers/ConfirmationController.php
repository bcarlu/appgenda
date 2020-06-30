<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Employee;

class ConfirmationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($service, $employee, $date, $start)
    {
    		$services = Service::where('id', $service)->get();
    		$employees = Employee::where('id', $employee)->get();
    		$date = $date;
    		$start = $start;

    		setlocale(LC_TIME, 'es_CO.utf8'); // Se establece locale en español

  			$data = [
  					'services' => $services,
  					'employees' => $employees,
						'date' => $date,
						'start' => $start,
  			];

    		return view('confirmation')->with($data);
    }
}
