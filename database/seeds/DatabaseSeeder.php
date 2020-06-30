<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	CategoriesSeeder::class,
        	EmployeesStateSeeder::class,
            ServicesDurationSeeder::class,
            UsersTableSeeder::class,
            EmployeesTableSeeder::class,
            BookingsStateTableSeeder::class,
            EmployeeCategoryTableSeeder::class,
            ServicesTableSeeder::class,
            BookingsTableSeeder::class,
        ]);
    }
}
