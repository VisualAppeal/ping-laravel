<?php

if (Sentry::check())
	$user = Sentry::getUser();
else
	$user = null;

$guest = !Sentry::check();

View::composer('*', function($view) use($user, $guest) {
	$view->with('session', Session::all());
	$view->with('guest', $guest);
	$view->with('user', $user);
});

/**
 * Account
 */
Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@index',
));

Route::group(array((Config::get('app.forceSsl')) ? 'https' : 'http'), function() {
	Route::get('/login', array(
		'as' => 'user.login',
		'uses' => 'UserController@login',
	));

	Route::post('/login', array(
		'as' => 'user.do-login',
		'uses' => 'UserController@doLogin',
		'before' => 'csrf',
	));

	Route::get('/register', array(
		'as' => 'user.register',
		'uses' => 'UserController@register',
	));

	Route::post('/register', array(
		'as' => 'user.do-register',
		'uses' => 'UserController@doRegister',
		'before' => 'csrf',
	));

	Route::get('/activate/{code}', array(
		'as' => 'user.activate',
		'uses' => 'UserController@activate',
	))
		->where('code', '\w+');
});

Route::group(array('before' => 'auth', (Config::get('app.forceSsl')) ? 'https' : 'http'), function() {
	/**
	 * Users
	 */
	Route::get('/account', array(
		'as' => 'user.account',
		'uses' => 'UserController@account',
	));

	Route::post('/account', array(
		'as' => 'user.save',
		'uses' => 'UserController@save',
	));

	Route::get('/logout', array(
		'as' => 'user.logout',
		'uses' => 'UserController@logout',
	));

	/**
	 * Companies
	 */
	Route::get('/companies', array(
		'as' => 'company.index',
		'uses' => 'CompanyController@index',
	));

	Route::get('/companies/{id}/user/remove/{user}', array(
		'as' => 'company.user.remove',
		'uses' => 'CompanyController@removeUser',
	))
		->where('id', '\d+')
		->where('user', '\d+');

	Route::post('/companies/{id}/user/add', array(
		'as' => 'company.user.add',
		'uses' => 'CompanyController@addUser',
	))
		->where('id', '\d+');

	Route::get('/company/{id}', array(
		'as' => 'company.show',
		'uses' => 'CompanyController@show',
	))->where('id', '\d+');

	Route::get('/company/create', array(
		'as' => 'company.create',
		'uses' => 'CompanyController@create',
	));

	Route::post('/company/create', array(
		'as' => 'company.store',
		'uses' => 'CompanyController@store',
	));

	Route::get('/company/{id}/edit', array(
		'as' => 'company.edit',
		'uses' => 'CompanyController@edit',
	))->where('id', '\d+');

	Route::post('/company/{id}/update', array(
		'as' => 'company.update',
		'uses' => 'CompanyController@update',
	))->where('id', '\d+');

	Route::get('/company/{id}/delete', array(
		'as' => 'company.delete',
		'uses' => 'CompanyController@delete',
	))->where('id', '\d+');

	Route::get('/company/{id}/restore', array(
		'as' => 'company.restore',
		'uses' => 'CompanyController@restore',
	))->where('id', '\d+');

	/**
	 * Checks
	 */
	Route::get('/checks', array(
		'as' => 'check.index',
		'uses' => 'CheckController@index',
	));

	Route::get('/check/{id}', array(
		'as' => 'check.show',
		'uses' => 'CheckController@show',
	))->where('id', '\d+');

	Route::get('/check/create', array(
		'as' => 'check.create',
		'uses' => 'CheckController@create',
	));

	Route::post('/check/store', array(
		'as' => 'check.store',
		'uses' => 'CheckController@store',
	));

	Route::get('/check/{id}/edit', array(
		'as' => 'check.edit',
		'uses' => 'CheckController@edit',
	))->where('id', '\d+');

	Route::post('/check/{id}/update', array(
		'as' => 'check.update',
		'uses' => 'CheckController@update',
	))->where('id', '\d+');

	Route::get('/check/{id}/delete', array(
		'as' => 'check.delete',
		'uses' => 'CheckController@delete',
	))->where('id', '\d+');

	Route::get('/check/{id}/restore', array(
		'as' => 'check.restore',
		'uses' => 'CheckController@restore',
	))->where('id', '\d+');

	Route::get('/check/{id}/pause', array(
		'as' => 'check.pause',
		'uses' => 'CheckController@pause',
	))->where('id', '\d+');

	Route::get('/check/{id}/unpause', array(
		'as' => 'check.unpause',
		'uses' => 'CheckController@unpause',
	))->where('id', '\d+');

	/**
	 * API
	 */
	Route::get('/api/check/{id}/uptime', array(
		'as' => 'api.check.uptime',
		'uses' => 'ApiController@checkUptime',
	))->where('id', '\d+');

	Route::get('/api/check/{id}/log', array(
		'as' => 'api.check.log',
		'uses' => 'ApiController@checkLog',
	))->where('id', '\d+');

	Route::get('/api/check/{id}/latency', array(
		'as' => 'api.check.latency',
		'uses' => 'ApiController@checkLatency',
	))->where('id', '\d+');
});