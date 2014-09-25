<?php

class UsersTableSeeder extends Seeder
{
	
	public function run()
	{
		DB::table('users')->truncate();

		User::create([

			'email' => 'john@doe.com',
			'password' => '1234'

		]);
	}

}