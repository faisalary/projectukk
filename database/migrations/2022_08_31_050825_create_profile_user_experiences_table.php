<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileUserExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_user_experiences', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('profile_user_id')->unsigned();
            $table->foreign('profile_user_id')->references('id')->on('profile_users')
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
        Schema::dropIfExists('profile_user_experiences');
    }
}
