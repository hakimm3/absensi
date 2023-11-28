<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::drop('suggestion_systems');
        Schema::create('suggestion_systems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengaju_id');
            $table->foreign('pengaju_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('evaluator_id')->nullable();
            $table->foreign('evaluator_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('tanggal_pengajuan');
            $table->string('tema');
            $table->enum('kategori', ['standard', 'modifikasi', 'inovasi']);
            $table->string('text_masalah');
            $table->string('file_masalah')->nullable();
            $table->string('analisa')->nullable();
            $table->string('perbaikan')->nullable();
            $table->string('text_evaluasi')->nullable();
            $table->string('file_evaluasi')->nullable();
            $table->date('tanggal_evaluasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suggestion_systems');
    }
};
