<?php

class UsersTableSeeder extends Seeder
{
	
	public function run()
	{
		DB::table('users')->truncate();

		User::create([

			'email' => 'admin@dotlabel.co.uk',
			'password' => '1234'

		]);
	}

}