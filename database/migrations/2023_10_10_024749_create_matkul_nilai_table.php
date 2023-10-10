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
        Schema::create('matkul_nilai', function (Blueprint $table) {
            $table->uuid('kdmatnilai')->primary();
            $table->uuid('kdmatakuliah');
            $table->decimal('nilai', 4, 2);
            $table->uuid('nim');
            $table->foreign('nim')->references('nim')->on('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matkul_nilai');
    }
};
