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
        Schema::create('lowongan_mag', function (Blueprint $table) {
            $table->uuid('kdlowongan')->primary();
            $table->uuid('kdmitra');
            $table->date('tanggalinput');
            $table->uuid('iduser');
            $table->time('waktu_input');
            $table->foreign('kdmitra')->references('kdmitra')->on('mitra');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_mag');
    }
};
