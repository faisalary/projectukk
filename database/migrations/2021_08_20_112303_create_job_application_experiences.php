<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationExperiences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_application_experiences', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('job_application_id')->unsigned();
            $table->foreign('job_application_id')->references('id')->on('job_applications')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('period');
            $table->string('company');
            $table->string('position');
            $table->text('description');
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
        Schema::dropIfExists('job_application_experiences');
    }
}
