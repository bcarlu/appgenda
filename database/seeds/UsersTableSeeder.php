<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\User::class,9)->create(); // Se crean 9 usuarios con las propiedades definidas en UserFactory con datos ficticios

        // Se crea un usuario con propiedades definidas para poder ingresar directamente a la app y para definirlo con el role Administrador
        DB::table('users')->insert([
            'name' => 'Brian',
            'email' => 'brian@correo.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'id_role' => 1,
            'phone' => '123',
        ]);

        DB::table('users')->insert([
            'name' => 'Diego',
            'email' => 'diego@correo.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'id_role' => 1,
            'phone' => '123',
        ]);
    }
}
