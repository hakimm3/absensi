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
        // $faker = \Faker\Factory::create();
        // for($i= 0; $i<10000; $i++){
        //     \App\Models\Attendance::create([
        //         'user_id' => $faker->numberBetween(1, 60),
        //         'date' => $faker->dateTimeBetween('-1 years', 'now'),
        //         'time_in' => $faker->time(),
        //         'time_out' => $faker->time(),
        //         'max_time_in' => $faker->time(),
        //         'status' => $faker->randomElement(['present', 'late', 'absent', 'skd', 'cuti tahunan', 'cuti istimewa', 'rawat inap']),
        //     ]);
        // }

        //remove attendace date from september 2023 to november 2023
        \App\Models\Attendance::whereBetween('date', ['2023-09-01', '2023-11-30'])->delete();
    }
}
