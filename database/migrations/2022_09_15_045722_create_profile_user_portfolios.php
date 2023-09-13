<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileUserPortfolios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_user_portfolios', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('profile_user_id')->unsigned();
            $table->foreign('profile_user_id')->references('id')->on('profile_users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->text('name');
            $table->text('url');
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
        Schema::dropIfExists('profile_user_portfolios');
    }
}
