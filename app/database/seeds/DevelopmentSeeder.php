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
		$this->call('CompanySeeder');
		$this->call('CheckSeeder');
	}
}