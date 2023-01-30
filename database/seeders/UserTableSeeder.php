<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'           => 'Administrator',
            'email'          => 'test@a17128.ebworld.co',
            'password'       => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
    }
}
