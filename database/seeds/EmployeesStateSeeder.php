<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees_state')->insert([
        	['state' => 'activo'],
        	['state' => 'inactivo'],
        ]);
    }
}
