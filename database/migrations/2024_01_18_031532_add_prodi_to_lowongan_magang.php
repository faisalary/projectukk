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
       if (Schema::hasColumn('lowongan_magang', 'prodi')) {
        Schema::table('lowongan_magang', function (Blueprint $table) {
            $table->dropColumn('prodi');
            $table->dropColumn('id_prodi');

        });
       }else {
        Schema::table('lowongan_magang', function (Blueprint $table) {
            $table->string('prodi', 255);
            $table->uuid('id_prodi');
            $table->foreign('id_prodi')->references('id_prodi')->on('program_studi');
        });
       }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lowongan_magang', function (Blueprint $table) {
            //
        });
    }
};
