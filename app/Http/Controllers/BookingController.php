<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	//
    }

    public function store(Request $request)
    {
        $id = $request->user()->id;
        $service = $request->service;
        $employee = $request->employee;
        $date = date('Y-m-d', $request->date);
        $start = $request->start;
        $duration = $request->duration;
        $end = $start + $duration;

        $bookings = Booking::where('date', $date)->where('start', $start . ':00')->where('id_employee', $employee)->get();

        
            if (count($bookings) > 0) {
                return redirect('/home')->with('error', 'Ups, alguien acaba de tomar el cupo, por favor escoge otra hora');
            }
            else{
                return "Se va a guardar con exito";
            }

        

        
    }
}
