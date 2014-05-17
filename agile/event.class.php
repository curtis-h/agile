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
    public function __construct($id=0,$user_id=0) {
        // set up randomness
    	if($id) {
    		return $this->getEvent($id);
    	}
    	else {
    		return $this->createEvent($user_id);
    	}
    }

    private function checkUser(){
    	if($this->publicAccess && Auth::check()) {
    		throw new Exception('Must be logged into login.');
    	}
    }

    public function createEvent($user_id=0){

    	$event = array(
    		'type' => $this->getEventType(),
    		'name' => $this->getName(),
    		'success' => $this->getSuccessValue(),
    		'user_id' => $user_id
    	);
        
        $a = DB::table("events")->insertGetId(
            $event
        );
        
    	//$a = $this->create($event);
        //var_dump($event); exit();
        return $a;
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
    	$faker = Faker\Factory::create();

    	return $faker->catchPhrase;
    }

    public function getSuccessValue(){
    	return rand(0,$this->successValueMax);
    }

    public function getEventType(){
    	return $this->eventType;
    }

    public function deleteEvent($id=0){
    	return $this->delete($id);
    }
}

?>