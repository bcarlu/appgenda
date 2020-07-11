<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('booking_status')->insert([
      	['status' => 'pendiente'],
      	['status' => 'reagendada'],
      	['status' => 'cancelada'],
      	['status' => 'finalizada'],
      ]);
    }
}
