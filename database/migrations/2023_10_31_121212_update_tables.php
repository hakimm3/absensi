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
        // drop foreign key constraint from attendance table to users table
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign('attendances_user_id_foreign');
            $table->time('time_out')->nullable()->change();
            $table->time('max_time_in')->nullable()->change();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
