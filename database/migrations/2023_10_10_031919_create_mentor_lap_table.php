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
        Schema::create('mentor_lap', function (Blueprint $table) {
            $table->uuid('idmentor')->primary();
            $table->string('namamentor', 50);
            $table->string('posisimentor', 50);
            $table->string('emailmentor', 50);
            $table->string('telpmentor', 15);
            $table->uuid('idmitra');
            $table->foreign('idmitra')->references('kdmitra')->on('mitra');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_lap');
    }
};
