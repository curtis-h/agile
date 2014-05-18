<?php

class XeeData extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'xeedata';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $primaryKey = 'id';
	
	protected $fillable = array('name', 'value');
	
}
