<?php

class UserCompany extends Eloquent
{
	protected $table = 'users_companies';

	public $timestamps = false;

	protected $fillable = array(
		'user_id',
		'company_id',
	);
}