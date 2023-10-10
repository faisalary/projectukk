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
        Schema::create('pembimbing_nilai', function (Blueprint $table) {
            $table->uuid('kdnilai')->primary();
            $table->uuid('kddosen');
            $table->decimal('nilaidosenpbb', 4, 2);
            $table->date('tglnilaipbb');
            $table->uuid('idmentor');
            $table->decimal('nilaimentor', 4, 2);
            $table->date('tglnilaimentor');
            $table->decimal('nilaiadjust', 4, 2);
            $table->date('tgladjust');
            $table->string('alasanadjust', 255);
            $table->foreign('kddosen')->references('kddosen')->on('dosen');
            $table->foreign('idmentor')->references('idmentor')->on('mentor_lap');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembimbing_nilai');
    }
};
