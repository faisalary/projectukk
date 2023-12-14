<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jenis_magang', function (Blueprint $table) {
            $table->dropColumn('durasimagang');
            // $table->enum('durasimagang', array('1 Semester', '2 Semester'));
            $table->string('durasimagang')->change();
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
