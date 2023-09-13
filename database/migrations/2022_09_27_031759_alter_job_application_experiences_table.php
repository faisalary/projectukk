<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJobApplicationExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_application_experiences', function (Blueprint $table) {
            $table->dropColumn('period');
            $table->string('start_period');
            $table->string('end_period')->nullable();
            $table->integer('salary')->default(0);
            $table->integer('industry_id')->after('job_application_id')->unsigned();
            $table->foreign('industry_id')->references('id')->on('job_industries')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_application_experiences', function (Blueprint $table) {
            //
        });
    }
}
