<?php

class Achievement extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'achievements';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $primaryKey = 'id';
	
	
	public function users()
    {
        return $this->belongsToMany('User', 'achievements_users');
    }
}
