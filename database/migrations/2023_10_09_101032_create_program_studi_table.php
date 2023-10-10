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
        Schema::create('program_studi', function (Blueprint $table) {
            $table->uuid('kdprodi')->primary();
            $table->uuid('kdfakultas');
            $table->string('namaprodi', 50);
            $table->uuid('kdkaprodi');
            $table->string('emailkaprodi', 50);
            $table->string('nohpkaprodi', 15);
            $table->string('kompetensiprodi', 1000);
            $table->foreign('kdfakultas')->references('kdfakultas')->on('fakultas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_studi');
    }
};
