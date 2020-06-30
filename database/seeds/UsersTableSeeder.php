<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,9)->create();

        App\User::create([
        	'name' => 'Brian',
        	'email' => 'brian@correo.com',
        	'password' => bcrypt('12345678'),
        	'phone' => '123',
        ]);

        App\User::create([
            'name' => 'Luisa',
            'email' => 'luisa@correo.com',
            'password' => bcrypt('12345678'),
            'phone' => '321',
        ]);
    }
}
