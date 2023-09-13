<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileUserInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_user_informations', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('profile_user_id')->unsigned();
            $table->foreign('profile_user_id')->references('id')->on('profile_users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('expected_salary_type');
            $table->text('expected_salary_value');
            $table->string('preferred_city');
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
        Schema::dropIfExists('profile_user_informations');
    }
}
