<?php

class UserGitHub extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users_social_github';

	protected $fillable = array(
		'user_id',
		'access_token',
		'refresh_token',
		'end_of_life',
	);
}