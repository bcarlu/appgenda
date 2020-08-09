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
            ServiceDurationSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            EmployeeStatusSeeder::class,
            EmployeesTableSeeder::class,
            BookingStatusTableSeeder::class,
            EmployeeCategoryTableSeeder::class,
            ServicesTableSeeder::class,
            BookingsTableSeeder::class,
        ]);
    }
}
