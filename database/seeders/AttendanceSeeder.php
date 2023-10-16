<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for($i= 0; $i<1000; $i++){
            \App\Models\Attendance::create([
                'user_id' => $faker->numberBetween(1, 100),
                'date' => $faker->dateTimeBetween('-1 years', 'now'),
                'time_in' => $faker->time(),
                'time_out' => $faker->time(),
                'max_time_in' => $faker->time(),
                'status' => $faker->randomElement(['present', 'late', 'overtime']),
            ]);
        }
    }
}
