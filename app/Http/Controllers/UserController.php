<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Booking;
use App\BookingStatus;
use App\Employee;
use App\Service;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth','can:in-dashboard']);
    }

    
    public function index(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;

        $users = User::orderBy('id', 'DESC')
            ->name($name)
            ->email($email)
            ->phone($phone)
            ->paginate(10);

        $data = [
            'users' => $users,
        ];

        return view('dashboard.users', $data);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        $bookings = Booking::where('id_user', $id)
            ->orderBy('date', 'asc')
            ->orderBy('start', 'asc')
            ->get();
        $users = User::where('id', $id)->first();
        $bookingStatus = BookingStatus::all();
        $employees = Employee::all();
        $services = Service::all();

        $data = [
            'bookings' => $bookings,
            'users' => $users,
            'bookingStatus' => $bookingStatus,
            'employees'   => $employees,
            'services' => $services,
        ];

        // Se establece la zona horaria por defecto
        date_default_timezone_set('America/Bogota');

        // Establece el locale a español para enviar a la vista
        setlocale(LC_TIME, 'es_CO.utf8');

        return view('dashboard.userschedule', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
