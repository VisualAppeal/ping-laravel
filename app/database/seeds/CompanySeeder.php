<?php

class CompanySeeder extends Seeder
{
	/**
	 * Run the user seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('companies')->delete();
		DB::table('users_companies')->delete();

		$visible = Company::create(array(
			'name' => 'Visible',
			'user_id' => 1,
		));

		$invisible = Company::create(array(
			'name' => 'Invisible',
			'user_id' => 1,
		));

		UserCompany::create(array(
			'company_id' => $visible->id,
			'user_id' => 1,
		));

		UserCompany::create(array(
			'company_id' => $invisible->id,
			'user_id' => 2,
		));
	}
}