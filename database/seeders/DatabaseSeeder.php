<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Attendance;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // DepartmentSeeder::class,
            UserSeeder::class,
            // PermissionSeeder::class,
            MipoSettingSeeder::class,
            AttendanceSeeder::class,
            SuggestionSystemSeeder::class,
            MipoEmployeeSeeder::class,
        ]);
    }
}
