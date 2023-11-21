<?php

namespace Database\Seeders;

use App\Models\EmployeeMipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MipoEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for($i = 0; $i < 1000; $i++){
            EmployeeMipo::create([
                'user_id' => $faker->numberBetween(1, 60),
                'mipo_setting_id' => $faker->numberBetween(1, 20),
                'date' => $faker->dateTimeBetween('-1 years', 'now'),
            ]);
        }
    }
}