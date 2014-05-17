<?php

class UserGame extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_game';


	public static function getGameUsers($game_id) {
		$userGameObject = $this::where('game_id',$game_id);
		if($userGameObject) {
			return $userGameObject;
		}
		return false;

	}

	public function setUserGame($user_id=0,$game_id=0){
		$user = array(
				'user_id' => $user_id,
				'game_id' => $game_id
			);
		return $this::create($user);
	}

}