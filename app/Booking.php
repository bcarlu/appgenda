<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'id_service', 'id_employee', 'id_user', 'id_bookings_state', 'date', 'start', 'end'
    ];
}
