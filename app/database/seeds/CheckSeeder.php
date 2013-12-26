<?php

class CheckSeeder extends Seeder
{
	/**
	 * Run the user seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('checks')->delete();

		$check = Check::create(array(
			'url' => 'http://www.example.com',
			'user_id' => 1,
			'company_id' => 1,
			'port' => 80,
			'interval' => 5,
		));

		$start = \Carbon\Carbon::now()->subDays(3);
		$now = \Carbon\Carbon::now();

		while ($start->diffInSeconds($now, false) > 0) {
			$success = (rand(0, 100) != 0);
			CheckResult::create(array(
				'check_id' => $check->id,
				'status_code' => $success ? 200 : 500,
				'rum' => $success ? rand(2000, 4000) : rand(10000, 60000),
				'success' => $success,
				'created_at' => $start,
			));
			$start->addMinutes(5);
		}

		$check = Check::create(array(
			'url' => 'http://www.example.org',
			'user_id' => 2,
			'company_id' => 2,
			'port' => 8080,
			'interval' => 15,
		));

		$start = \Carbon\Carbon::now()->subDays(1);
		$now = \Carbon\Carbon::now();

		while ($start->diffInSeconds($now, false) > 0) {
			$success = (rand(0, 100) != 0);
			CheckResult::create(array(
				'check_id' => $check->id,
				'status_code' => $success ? 200 : 500,
				'rum' => $success ? rand(2000, 4000) : rand(10000, 60000),
				'success' => $success,
				'created_at' => $start,
			));
			$start->addMinutes(15);
		}
	}
}