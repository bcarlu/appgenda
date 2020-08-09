<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
			['id_category' => 1,
			'id_duration' => 1,
			'name' => 'Manicure tradicional', 
			'price' => 10000, 
        	],
			['id_category' => 1,
        	'id_duration' => 1, 
        	'name' => 'Pedicure tradicional', 
        	'price' => 10000, 
        	],
			['id_category' => 1,
        	'id_duration' => 2, 
        	'name' => 'Uñas acrilicas', 
			'price' => 30000,
			],
			['id_category' => 2,
        	'id_duration' => 2, 
        	'name' => 'Depilación cejas', 
			'price' => 15000,
			],
			['id_category' => 2,
        	'id_duration' => 1, 
        	'name' => 'Depilación piernas', 
			'price' => 20000,
			],
			['id_category' => 3,
        	'id_duration' => 1, 
        	'name' => 'Masaje relajante', 
			'price' => 40000,
			],
			['id_category' => 3,
        	'id_duration' => 2, 
        	'name' => 'Masaje reductor', 
        	'price' => 50000,],
        ]);
    }
}
