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
        Schema::create('grup_riset_lab', function (Blueprint $table) {
            $table->uuid('kdmitra')->primary();
            $table->string('namamitra', 50);
            $table->string('namaPIC', 50);
            $table->string('nohpPIC', 15);
            $table->string('emailPIC', 50);
            $table->string('kdruang_alamat', 100);
            $table->string('ketuaGrup', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grup_riset_lab');
    }
};
