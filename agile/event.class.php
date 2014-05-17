<?php 
class BaseEvent extends Eloquent {

	private $event;
	private $successValue;

	protected $table = 'events';

    /*
     * C'tor
     */
    public function __construct($id) {
        // set up randomness

    }

    public function createEvent(){
        $this->event = new stdClass();
        $this->event->id      = 1;
        $this->event->name    = $this->getName();
        $this->event->success = $this->getSuccessValue();
        return $this->event;
    }

    public function getEvent($id=0){

    }

    public function checkEventSuccess($id,$success){

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

    }
}

?>