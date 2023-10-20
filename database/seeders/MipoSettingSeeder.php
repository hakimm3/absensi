<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MipoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =
            [
                'SKD' => -1,
                'Sakit Kecelakaan Kerja' => 0,
                'Sakit Rawa Inap' => 0,
                'Ijin di Luar Tanggungan' => -2,
                'Ijin Keluarga Sakit' => -1,
                'Ijin Keluar Kantor < 3x' => 0,
                'Ijin Keluar Kantor 3x' => -2,
                'Ijin Keluar Kantor 4x' => -3,
                'Ijin Keluar Kantor +1' => -1,
                'Ijin Bencana Alama' => 0,
                'Terlambat 1 - 10 Menit' => -0.2,
                'Terlambat 11 = 20 Menit' => -0.4,
                'Terlambat 20 - 30 Menit' => -0.6,
                'Terlambat 30 - 60 Menit' => 1,
                'Terlambat > 60 Menit' => 1.5,
                'Ijin Pulang Cepat < 3 Jam' => 0.25,
                'Ijin Pulang Cepat > 3 Jam' => 0.5,
                'Tidak Finger In/Out' => -2,
                'Alpha' => 10,
                'SP Lisan Tertulis' => -10,
                'SP Pertama' => -30,
                'SP Kedua' => -60,
                'SP Ketiga' => -90,
            ];

        foreach ($data as $key => $value) {
            \App\Models\MipoSetting::create([
                'name' => $key,
                'value' => $value,
            ]);
        }
    }
}
