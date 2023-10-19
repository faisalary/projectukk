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
        Schema::create('dosen', function (Blueprint $table) {
            $table->integer('nip')->primary();
            $table->uuid('id_dosen');
            $table->uuid('id_prodi');
            $table->uuid('id_univ');
            $table->string('namadosen', 255);
            $table->string('nohpdosen', 15);
            $table->string('emaildosen', 255);
            $table->string('statusdosen', 255);
            $table->foreign('id_prodi')->references('id_prodi')->on('program_studi');
            $table->foreign('id_univ')->references('id_univ')->on('universitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
