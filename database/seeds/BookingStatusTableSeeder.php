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
      	['status' => 'Pendiente'],
        ['status' => 'En proceso'],
      	['status' => 'Reagendada'],
      	['status' => 'Cancelada'],
      	['status' => 'Realizada'],
        ['status' => 'Incumplida'],
        ['status' => 'Finalizado sistema'],
      ]);
    }
}
