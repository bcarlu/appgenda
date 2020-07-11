<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->insert([
        	['id_service' => 1,
        	 'id_employee' => 2, 
        	 'id_user' => 10, 
        	 'id_status' => 1,
        	 'date' => date('Y-m-d',strtotime('2020-06-22')),
        	 'start' => '08:00',
        	 'end' => '09:00', 
        	],

        	['id_service' => 2,
        	 'id_employee' => 3, 
        	 'id_user' => 10, 
        	 'id_status' => 1,
        	 'date' => date('Y-m-d',strtotime('2020-06-23')),
        	 'start' => '10:00',
        	 'end' => '11:00', 
        	],

            ['id_service' => 3,
             'id_employee' => 4, 
             'id_user' => 11, 
             'id_status' => 1,
             'date' => date('Y-m-d',strtotime('2020-06-24')),
             'start' => '09:00',
             'end' => '11:00', 
            ],
        ]);
    }
}
