<?php

class Company extends Eloquent
{
	protected $table = 'companies';

	protected $softDelete = true;

	protected $fillable = array(
		'user_id',
		'name',
	);

	public function scopeForUser(Illuminate\Database\Eloquent\Builder $query, $userId)
	{
		return $query->join('users_companies', 'users_companies.company_id', '=', 'companies.id')
			->where('users_companies.user_id', '=', $userId);
	}

	public function users()
	{
		return $this->belongsToMany('User', 'users_companies', 'company_id', 'user_id');
	}
}