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
        Schema::create('mitra', function (Blueprint $table) {
            $table->uuid('kdmitra')->primary();
            $table->string('namamitra', 50);
            $table->string('notelpon', 15);
            $table->string('alamat', 100);
            $table->string('namaPIC', 50);
            $table->string('nohpPIC', 15);
            $table->string('emailPIC', 50);
            $table->string('kategori', 10);
            $table->string('ketuagrup', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra');
    }
};
