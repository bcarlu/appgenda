<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('employee_category')->insert([
        	[
	        	'id_employee' => 1,
	        	'id_category' => 2,
        	],
        	[
	        	'id_employee' => 2,
	        	'id_category' => 1,
        	],
        	[
	        	'id_employee' => 3,
	        	'id_category' => 1,
        	],
        	[
	        	'id_employee' => 4,
	        	'id_category' => 2,
        	],
        	[
	        	'id_employee' => 5,
	        	'id_category' => 3,
        	],
        	[
	        	'id_employee' => 4,
	        	'id_category' => 1,
        	],
        	[
	        	'id_employee' => 1,
	        	'id_category' => 1,
        	],
        ]); 
    }
}
