<?php 
class BaseEvent extends Eloquent {

	private $publicAccess = true;

	private $event;
	private $successValueMax = 1;

	protected $table = 'events';
	protected $eventType = 'base';
	protected $fillable = array('type', 'name', 'success', 'user_id');
	

    /*
     * C'tor
     */
    public function __construct($id=0,$user_id=0, $control_type=0, $name="", $success=1, $control_id = 0) {
        // set up randomness
    	if($id) {
    		return $this->getEvent($id);
    	}
    	else {
    		return $this->createEvent($user_id, $control_type, $name, $success, $control_id);
    	}
    }

    private function checkUser(){
    	if($this->publicAccess && Auth::check()) {
    		throw new Exception('Must be logged into login.');
    	}
    }

    public function createEvent($user_id=0, $control_type=0, $name="", $success=1, $control_id){
        $this->user_id   = $user_id;
        $this->eventType = $control_type;
        $this->name      = $name;
        $this->success   = $success;
        $this->control_id = $control_id;
        
    	$event = array(
    		'type' => $this->getEventType(),
    		'name' => $this->getName(),
    		'success' => $this->getSuccessValue(),
    		'user_id' => $this->getUserId(),
    		'control_id' => $this->control_id
    	);
        
        $this->id = DB::table("events")->insertGetId($event);
    }

    public function getEvent($id=0){
    	return $this->findOrFail($id);
    }

    public function checkEventSuccess($id,$success){
    	$event = $this->find($id);

    	return ($event->success==$success)?true:false;
    }

    /**
     * Use Faker to produce a name
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    public function getSuccessValue(){
        return $this->success;
    }

    public function getEventType(){
    	return $this->eventType;
    }
    
    public function getUserId(){
    	return $this->user_id;
    }

    public function getText() {
        
    }
    
    public function deleteEvent($id=0){
    	return $this->delete($id);
    }
    
    /**
     * check to see if an event has been completed
     * @param unknown_type $user_id
     * @param unknown_type $control_id
     * @param unknown_type $value
     */
    public static function checkEvent($cid, $control_id, $value) {
        return DB::table("events")
            ->select("id")
            ->where("control_id", $cid)
            ->where("type", $control_id)
            ->where("success", $value)
            ->first()
            ->id;
            
    }
}

?>