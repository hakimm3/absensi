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
        // DB::statement('SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY",""))');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
