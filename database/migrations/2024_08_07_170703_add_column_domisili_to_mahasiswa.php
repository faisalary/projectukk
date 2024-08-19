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
        Schema::table('mahasiswa', function (Blueprint $table) {
            if (!Schema::hasColumn('mahasiswa', 'kota_id')) {
                $table->integer('kota_id')->nullable()->after('alamatmhs');
                $table->string('kodepos')->nullable()->after('kota_id');
            }
            $table->foreign('kota_id')->references('id')->on('reg_regencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['kota_id']);
            $table->dropColumn('kota_id');
            $table->dropColumn('kodepos');
        });
    }
};
