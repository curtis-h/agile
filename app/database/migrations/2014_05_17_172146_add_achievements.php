<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAchievements extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('achievements', function($table) {
			$table->increments('id');
			$table->string('name', 256);
			$table->string('img', 256);
		});
		Schema::create('achievements_users', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('achievement_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
