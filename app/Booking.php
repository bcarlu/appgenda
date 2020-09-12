<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'id_service', 'id_employee', 'id_user', 'id_status', 'date', 'start', 'end'
    ];

    // Se establecen dias de la semana
    public function setDays($quantity, $durationService)
    {
        $firstDay = 0;

        if ($durationService == 1 
            && date('G') >= date('G', strtotime('15:00'))) {
            $firstDay = 1;
        }
        if ($durationService == 2 
            && date('G') >= date('G', strtotime('14:00'))) {
            $firstDay = 1;
        }

    	for ($i = $firstDay; $i <= $quantity ; $i++) { 
    		$days[] = $i;
    	}        
    	
        foreach ($days as $day) {
            $dates[] = [
                'fecha' => 
                    mktime(0, 0, 0, 
                    date("m")  , 
                    date("d") + $day, 
                    date("Y")), 
                'status' => 'workingDay'
            ];           
        }
        
        return $dates;
    }

    public function setHoursByDay($start, $end)
    {
        for ($i=$start; $i <=$end ; $i++) { 
            $hours[] = [ 'hora' =>$i, 'status' => 'disponible'];
        }

        return $hours;
    }
}
