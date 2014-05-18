<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('deleteSHIT');
	}
	
	public function deleteSHIT() {
		
		DB::table('achievements')->delete();
		DB::table('achievements_users')->delete();
		DB::table('controls')->delete();
		DB::table('events')->delete();
		DB::table('game')->delete();
		DB::table('user_game')->delete();
		DB::table('users')->delete();
		
	}

}
