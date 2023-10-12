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
        Schema::create('skill_dibutuhkan', function (Blueprint $table) {
            $table->uuid('id_skill_dibutuhkan')->primary();
            $table->string('nama_skill_dibutuhkan', 50);
            $table->uuid('kdmatakuliah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_dibutuhkan');
    }
};
