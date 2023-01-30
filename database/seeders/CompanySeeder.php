<?php

namespace Database\Seeders;

use App\Models\Company;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
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

            Company::create([
                'name'       => $faker->company,
                'email'      => $faker->email,
                'website'    => 'https://'.$faker->domainName,
                'logo'       => time().$x . '.png'
            ]);
        }
    }
}
