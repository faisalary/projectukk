<?php

use App\FooterSetting;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

class CreateFooterSettingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('footer_settings', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('slug');
			$table->longText('description')->nullable()->default(null);
			$table->enum('status', ['active', 'inactive'])->nullable()->default('active');
			$table->timestamps();
		});

		$customMenu = new FooterSetting();
		$customMenu->name = 'About Us';
		$customMenu->slug = Str::slug('About Us');
		$customMenu->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
		$customMenu->save();

		$customMenu = new FooterSetting();
		$customMenu->name = 'About PROXSIS Group';
		$customMenu->slug = Str::slug('About PROXSIS Group');
		$customMenu->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
		$customMenu->save();

		$customMenu = new FooterSetting();
		$customMenu->name = 'Community Guidelines';
		$customMenu->slug = Str::slug('Community Guidelines');
		$customMenu->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
		$customMenu->save();

		$customMenu = new FooterSetting();
		$customMenu->name = 'Privacy & Terms';
		$customMenu->slug = Str::slug('Privacy & Terms');
		$customMenu->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
		$customMenu->save();

		$customMenu = new FooterSetting();
		$customMenu->name = 'Techno Infinity';
		$customMenu->slug = Str::slug('Techno Infinity');
		$customMenu->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
		$customMenu->save();

		$customMenu = new FooterSetting();
		$customMenu->name = 'PROXSIS HR';
		$customMenu->slug = Str::slug('PROXSIS HR');
		$customMenu->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
		$customMenu->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('footer_settings');
	}
}
