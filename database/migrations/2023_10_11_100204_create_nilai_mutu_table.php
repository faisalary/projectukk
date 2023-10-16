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
        Schema::create('nilai_mutu', function (Blueprint $table) {
            $table->uuid('id_nilai')->primary();
            $table->integer('nilaistart');
            $table->integer('nilaiend');
            $table->integer('nilaimutu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_mutu');
    }
};
