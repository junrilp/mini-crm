<?php

namespace Database\Seeders;

use App\Models\Employee;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total = 30;

        for ($x = 0; $x < $total; $x++) {
            $faker = Factory::create();

            Employee::create([
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'company_id' => $faker->numberBetween($min = 1, $max = 30),
                'email'      => $faker->safeEmail,
                'phone'      => $faker->phoneNumber
            ]);
        }
    }
}
