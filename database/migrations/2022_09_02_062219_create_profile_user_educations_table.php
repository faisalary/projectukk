<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileUserEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_user_educations', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('profile_user_id')->unsigned();
            $table->foreign('profile_user_id')->references('id')->on('profile_users')
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
        Schema::dropIfExists('profile_user_educations');
    }
}
