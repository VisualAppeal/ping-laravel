<?php

use Illuminate\Database\Migrations\Migration;

class OauthLogin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_social_github', function($table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('access_token', 255);
			$table->string('refresh_token', 255)->nullable();
			$table->timestamp('end_of_life')->nullable();

			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users_social_github');
	}

}