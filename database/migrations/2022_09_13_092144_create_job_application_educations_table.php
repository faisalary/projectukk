<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_application_educations', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('job_application_id')->unsigned();
            $table->foreign('job_application_id')->references('id')->on('job_applications')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('university');
            $table->string('degree');
            $table->string('study');
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->string('gpa');
            $table->boolean('is_graduated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_application_educations');
    }
}
