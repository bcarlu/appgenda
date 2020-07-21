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
        	 'date' => date('Y-m-d',strtotime('+2 day')),
        	 'start' => '08:00',
        	 'end' => '09:00', 
        	],

        	['id_service' => 2,
        	 'id_employee' => 3, 
        	 'id_user' => 10, 
        	 'id_status' => 1,
        	 'date' => date('Y-m-d',strtotime('+1 day')),
        	 'start' => '10:00',
        	 'end' => '11:00', 
        	],
        ]);
    }
}
