<?php

use Illuminate\Database\Migrations\Migration;

class Init extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function($table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('name', 100);

			$table->timestamps();
			$table->softDeletes();

			$table->foreign('user_id')->references('id')->on('users');
		});

		Schema::create('users_companies', function($table) {
			$table->integer('user_id')->unsigned();
			$table->integer('company_id')->unsigned();

			$table->index('user_id');
			$table->index('company_id');
		});

		Schema::create('checks', function($table) {
			$table->increments('id');
			$table->integer('company_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('url', 255);
			$table->integer('port')->default(80);
			$table->string('username', 255)->nullable();
			$table->string('password', 255)->nullable();
			$table->string('check_for', 255)->nullable();
			$table->integer('interval')->unsigned()->default(5);
			$table->integer('notify_failed_checks')->unsigned()->default(1);
			$table->boolean('notify_back_online')->default(true);
			$table->integer('latency_satisfied')->unsigned()->default(4);
			$table->integer('latency_tolerating')->unsigned()->default(16);
			$table->boolean('paused')->default(false);

			$table->timestamps();
			$table->softDeletes();

			$table->index('company_id');
			$table->index('user_id');
		});

		Schema::create('checks_results', function($table) {
			$table->bigIncrements('id');
			$table->integer('check_id')->unsigned();
			$table->smallInteger('status_code')->unsigned();
			$table->smallInteger('latency');
			$table->text('content')->nullable();
			$table->text('headers')->nullable();
			$table->boolean('success');

			$table->timestamps();

			$table->index('check_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('checks_results');
		Schema::dropIfExists('checks');
		Schema::dropIfExists('users_companies');
		Schema::dropIfExists('companies');
	}
}
