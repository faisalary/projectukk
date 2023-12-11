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
            $table->date('tanggaldaftar')->nullable();
            $table->timestamp('approvetime')->nullable();
            $table->string('approved_by', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_magang', function (Blueprint $table) {
            Schema::dropIfExists('pendaftaran_magang', 'tanggaldaftar');
            Schema::dropIfExists('pendaftaran_magang', 'approvetime');
            Schema::dropIfExists('pendaftaran_magang', 'approved_by');
        });
    }
};
