<?php 
class BaseEvent extends Eloquent {

	private $event;
	private $successValue = 1;

	protected $table = 'events';
	protected $eventType = 'base';

    /*
     * C'tor
     */
    public function __construct($id=0) {
        // set up randomness
    	if($id) {
    		return $this->getEvent($id);
    	}
    	else {
    		return $this->createEvent();
    	}
    }

    public function createEvent(){

        $event = array(
        		'type' => $this->getEventType(),
        		'name' => $this->getName(),
        		'success' => $this->getSuccessValue()
        	);

        return $this::create($event);
    }

    public function getEvent($id=0){
    	return $this:findOrFail($id);
    }

    public function checkEventSuccess($id,$success){
    	$event = $this:find($id);

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
    	return rand(0,$this->successValue);
    }

    public function getEventType(){
    	return $this->eventType;
    }
}

?>