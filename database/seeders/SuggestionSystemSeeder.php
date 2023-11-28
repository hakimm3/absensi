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
        \App\Models\SuggestionSystem::truncate();
        $faker = \Faker\Factory::create('id_ID');
        for($i = 0; $i<1000; $i++){
            \App\Models\SuggestionSystem::create([
                'pengaju_id' => $faker->numberBetween(1, 60),
                'evaluator_id' => $faker->numberBetween(1, 60),
                'tanggal_pengajuan' => $faker->dateTimeBetween('-1 years', 'now'),
                'tema' => $faker->sentence(3),
                'kategori' => $faker->randomElement(['standard', 'modifikasi', 'inovasi']),
                'text_masalah' => $faker->paragraph(1),
                'analisa' => $faker->paragraph(1),
                'perbaikan' => $faker->paragraph(1),
                'text_evaluasi' => $faker->paragraph(1),
                'tanggal_evaluasi' => $faker->dateTimeBetween('-1 years', 'now'),
            ]);
        }
    }
}
