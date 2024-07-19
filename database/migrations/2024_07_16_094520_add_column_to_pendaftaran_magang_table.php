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
        Schema::table('pendaftaran_magang', function (Blueprint $table) {
            $table->foreign('id_lowongan')->references('id_lowongan')->on('lowongan_magang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_magang', function (Blueprint $table) {
            $table->dropForeign(['id_lowongan']);
        });
    }
};
