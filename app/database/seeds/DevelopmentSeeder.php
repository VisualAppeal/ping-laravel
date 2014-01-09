<?php

class DevelopmentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserSeeder');

		Sentry::register(array(
			'email' => 'test@example.org',
			'password' => 123456,
		), true);

		$this->call('CompanySeeder');
		$this->call('CheckSeeder');
	}
}