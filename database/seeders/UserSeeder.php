<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [   
                // 'department_id' => 1,
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'photo' => 'default.png',
                'employee_id' => '00000000',
            ]
        ];

        foreach ($data as $key => $value) {
            \App\Models\User::create($value);
        }

        $faker = \Faker\Factory::create();
        for($i= 0; $i<100; $i++){
            \App\Models\User::create([
                'department_id' => $faker->numberBetween(1, 10),
                'employee_id' => $faker->numberBetween(10000000, 99999999),
                'name' => $faker->name(),
                'username' => $faker->userName() . $i,
                'email' => $faker->email() . $i,
                'password' => bcrypt('password'),
                'photo' => 'default.png',
            ]);
        }
    }
}
