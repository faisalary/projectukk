<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\ThemeSetting;

class CreateThemeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('primary_color');
            $table->longText('admin_custom_css')->nullable();
            $table->longText('front_custom_css')->nullable();
            $table->string('home_background_image')->nullable()->default(null);
            $table->string('welcome_title')->nullable()->default(null);
            $table->text('welcome_sub_title')->nullable()->default(null);
            $table->timestamps();
        });

        $theme = new ThemeSetting();
        $theme->primary_color = '#1579d0';
        $theme->welcome_title = 'Welcome !';
        $theme->welcome_sub_title = 'Find your dream career here';
        $theme->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theme_settings');
    }
}
