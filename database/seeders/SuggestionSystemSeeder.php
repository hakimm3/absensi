<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuggestionSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for($i = 0; $i<1000; $i++){
            \App\Models\SuggestionSystem::create([
                'user_id' => $faker->numberBetween(1, 60),
                'date' => $faker->dateTimeBetween('-1 years', 'now'),
                'suggestion' => $faker->text(100),
                'benefits' => $faker->text(100),
            ]);
        }
    }
}
