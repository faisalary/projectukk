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
        Schema::table('mhs_magang', function (Blueprint $table) {
            $table->uuid('jenis_magang')->nullable()->change();
            $table->foreign('jenis_magang')->references('id_jenismagang')->on('jenis_magang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mhs_magang', function (Blueprint $table) {
            $table->dropForeign('mhs_magang_jenis_magang_foreign');
            $table->dropIndex('mhs_magang_jenis_magang_foreign');
        });

        Schema::table('mhs_magang', function (Blueprint $table) {
            $table->integer('jenis_magang')->nullable()->change();
        });
    }
};
