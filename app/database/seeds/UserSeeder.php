<?php

class UserSeeder extends Seeder
{
	/**
	 * Run the user seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users_groups')->delete();
		DB::table('users')->delete();
		DB::table('groups')->delete();

		$defaultUser = Config::get('auth.default');

		if (is_array($defaultUser)) {
			$user = Sentry::register($defaultUser, true);
			echo "User {$defaultUser['email']} created with password {$defaultUser['password']}\n";

			$adminGroup = Sentry::createGroup(array(
				'name' => 'admin',
				'permissions' => array(
					'admin' => 1,
				),
			));

			$user->addGroup($adminGroup);
		}
	}
}