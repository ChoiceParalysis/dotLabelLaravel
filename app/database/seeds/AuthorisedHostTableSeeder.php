<?php

use Faker\Factory;

class AuthorisedHostTableSeeder extends Seeder
{
	
	public function run()
	{
		DB::table('authorised_host')->truncate();

		$faker = Factory::create();

		foreach(range(1, 10) as $host)
		{
			Host::create([
				'ipaddress' => $faker->ipv4,
				'subnet' => rand(1, 32),
				'description' => $faker->paragraph(4),
				'enabled' => rand(0, 1)
			]);

		}

	}

}