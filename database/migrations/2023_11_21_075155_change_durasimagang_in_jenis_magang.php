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
        Schema::table('jenis_magang', function (Blueprint $table) {
            $table->string('durasimagang', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jenis_magang', function (Blueprint $table) {
            Schema::dropIfExists('jenis_magang', 'durasimagang');
        });
    }
};
