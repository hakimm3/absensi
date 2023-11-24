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
        // $faker = \Faker\Factory::create('id_ID');
        // for($i = 0; $i < 1000; $i++){
        //     EmployeeMipo::create([
        //         'user_id' => $faker->numberBetween(1, 60),
        //         'mipo_setting_id' => $faker->numberBetween(1, 20),
        //         'date' => $faker->dateTimeBetween('-1 years', 'now'),
        //     ]);
        // }\

        //remove attendace date from september 2023 to november 2023
        EmployeeMipo::where('date', '2023-03-20')->delete();
    }
}
