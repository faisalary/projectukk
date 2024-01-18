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
       if (Schema::hasColumn('lowongan_magang', 'fakultas')) {
        Schema::table('lowongan_magang', function (Blueprint $table) {
            $table->dropColumn('fakultas');
            $table->dropColumn('id_fakultas');
        });
       }else {
        Schema::table('lowongan_magang', function (Blueprint $table) {
            $table->string('fakultas', 255);
            $table->uuid('id_fakultas');
            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas');
            
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
