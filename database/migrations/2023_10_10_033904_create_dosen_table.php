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
            $table->uuid('kddosen')->primary();
            $table->uuid('kdprodi');
            $table->string('namadosen', 50);
            $table->string('nohpdosen', 15);
            $table->string('emaildosen', 50);
            $table->string('alamatdosen', 100);
            $table->string('pembimbingakademik', 50);
            $table->uuid('NIP');
            $table->foreign('kdprodi')->references('kdprodi')->on('program_studi');
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
