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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->uuid('nim')->primary();
            $table->integer('angkatan');
            $table->uuid('kdprodi');
            $table->string('namamhs', 50);
            $table->string('alamatmhs', 100);
            $table->string('emailmhs', 50);
            $table->string('nohpmhs', 15);
            $table->uuid('kddosenwali');
            $table->string('kelas', 10);
            $table->foreign('kdprodi')->references('kdprodi')->on('program_studi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
