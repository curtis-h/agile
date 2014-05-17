<?php
 
class ApiUsersController extends BaseController {
 
public $restful = true;

	private function user_json($user){
		$json = new stdClass();
		$json->firstname = $user->firstname;	
		$json->lastname = $user->lastname;	
		$json->picture = 'comingsoon';
		$json->achievements = array();
		
		foreach($user->achievements as $ach){
			$achivement = new stdClass();
			
			$achivement->name = $ach->name;
			$achivement->date = 'soon';
			$json->achievements[] = $achivement;
		}
		
		return $json;
	}
	
	public function get_index($id = null) 
	{
		if($id){
			$users = array(User::find($id));
		}else{
			$users = User::all();
		}
		$json = array();
		
		foreach($users as $user){
			$json[] = $this->user_json($user);
		}
		
		return json_encode($json, JSON_NUMERIC_CHECK);
	}

	public function post_index() 
	{

	}

	public function put_index() 
	{

	}

	public function delete_index($id = null) 
	{

	} 
     
}
 
?>
