<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'id_service', 'id_employee', 'id_user', 'id_status', 'date', 'start', 'end'
    ];
}
