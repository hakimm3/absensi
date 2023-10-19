<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::table('attendance', function (Blueprint $table) {
        //     $table->enum('status', ['present', 'absent', 'late', 'halfday', 'undertime', 'overtime', 'skd', 'cuti tahunan', 'cuti istimewa', 'rawat inap'])->change();
        // });

        DB::statement("ALTER TABLE attendances MODIFY COLUMN status ENUM('present', 'absent', 'late', 'skd', 'cuti tahunan', 'cuti istimewa', 'rawat inap')");


        // change status column to enum type in attendance table 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            //
        });
    }
};
