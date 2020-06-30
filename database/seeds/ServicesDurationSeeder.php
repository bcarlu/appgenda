<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesDurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services_duration')->insert([
        	['quantity' => 1],
        	['quantity' => 2],
        	['quantity' => 3],
        	['quantity' => 4],
        ]);
    }
}
