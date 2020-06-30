<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingsStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('booking_state')->insert([
      	['state' => 'pendiente'],
      	['state' => 'reagendada'],
      	['state' => 'cancelada'],
      	['state' => 'finalizada'],
      ]);
    }
}
