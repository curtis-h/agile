<?php

class Game extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'game';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $primaryKey = 'id';

	public function getHealth($id=0){
		$health = $this->find($id);
		return $health->health;
	}

	public function removeHealth($id=0,$health=0){
		$currentHealthObject = $this->find($id);
		$newHealth = $currentHealthObject->health - $health;
		if($newHealth<0) {
			$currentHealthObject->health = 0;
			$currentHealthObject->save();
			return false;
		} else {
			$currentHealthObject->health = $newHealth;
			$currentHealthObject->save();
			return $newHealth;
		}
	}

	public function createGame(){
		return $this::create(array());
	}

	public function stopGame($id=0){
		$gameObject = $this::find($id);
		$gameObject->active = 0;
		return $gameObject->save();
	}

	public static function getCurrentGame(){
		$gameObject = $this::where('active':1)
			->orderBy('id','desc');
		if($gameObject) {
			return $gameObject->id;
		}

		return false;
	}
}
