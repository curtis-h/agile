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
		return $this->get_index($_POST['id']);
	}

	public function delete_index($id) 
	{
		$currentUser = Auth::user();
		
		if($currentUser && $currentUser->id === 1 && $id !== 1){
			User::destroy($id);
			$json = new stdClass();
			$json->success = true;
		}else{
			$json = new stdClass();
			$json->success = false;
			$json->error = "Insufficient Privileges";
		}
		
		return json_encode($json, JSON_NUMERIC_CHECK);
	} 
     
}
 
?>
