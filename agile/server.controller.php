<?php
class ServerController extends BaseController {
    /**
     * events that we can send to the clients
     * Thermometer : ID 1
     * Button : ID 2
     * Slider : ID 3
     */
    protected $eventTypes = array(
        'Thermometer',
        'Button',
        'Slider',
    );
    
    protected $pusher;

    /**
     * run initial game setup
     */
    public function createGame() {
        $this->setupPusher();
        $this->createEvent();
    }

    /**
     * create a random event assigned to a user
     */
    public function createEvent() {
        // get random user
        User::all();
        
        $event = $this->getRandomEvent();
        // push to client
        // push to display
        
        $this->pusher->trigger(
            Config::get('app.pusher_channel_name'), 
            'event_create', 
            array('message' => 'hello world')
        );
    }
    
    /**
     * used to decide if updated value is correct for event
     */
    public function checkEvent() {
        $user_id    = Route::input('user_id');
        $control_id = Route::input('control_id');
        $value      = Route::input('value');
        
        
        error_log("USER: {$user_id}, CONTROL: {$control_id}, VALUE: {$value}");
        // run check for this user and this control
    }
    
    
    /**
     * call this when an event isn't completed
     * triggered from client side
     */
    public function failEvent() {
        $user_id    = Route::input('user_id');
        $control_id = Route::input('control_id');
        
        // this needs to update the event db
    }
    
    /**
     * create 3 random controls for the user
     */
    public function createUserControls() {
        $events  = array();
        // I dont think we get the user_id this way
        $user_id = Route::input('user_id');
        
        for($i=0; $i<3; $i++) {
            if($event = $this->getRandomControls()) {
                $events[] = $event;
            }
        }
        
        return $events;
    }
    
    /**
     * create the pusher connection
     */
    protected function setupPusher() {
        $this->pusher = new Pusher(
            Config::get('app.pusher_app_key'), 
            Config::get('app.pusher_app_secret'), 
            Config::get('app.pusher_app_id')
        );
        
    }
    
    /**
     * function to call when an event is completed
     */
    protected function completeEvent() {
        // mark an event as completed
    }
    
    /**
     * get a random event
     */
    protected function getEventType() {
        return $this->eventTypes[rand(0, count($this->eventTypes) -1)];
    }
    
    /**
     * create and return a random event assigned to a user
     */
    protected function getRandomEvent($user_id=false) {
        $event = false;
        
        if(!empty($user_id)) {
            $randomEvent    = $this->getEventType();
            $eventModelName = $randomEvent.'Event';
            $event = $eventModelName(false, $user_id);
        }
        
        return $event;
    }
    
    /*
     * get a random controller
     */
    protected function getRandomControls() {
        
    }
    
}