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
        
    }
    
    public function getGame() {
        return 100;
    }

    /**
     * create a random event assigned to a user
     */
    public function createEvent() {
        $this->setupPusher();
        
        // get random user
        $user  = User::orderBy(DB::raw('RAND()'))->get();
        $event = $this->getRandomEvent($user->id);
        // push to client
        // push to display
        
        $this->pusher->trigger(
            Config::get('app.pusher_channel_name'), 
            'event_create', 
            $event
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
        // if success needs to tell main screen
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
    public function createUserControls($user_id) {
        $controls = array();
        
        for($i=0; $i<3; $i++) {
            if($control = $this->getRandomControls($user_id)) {
                $controls[] = $control;
            }
        }
        
        return $controls;
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
            // get random control based on user
            // create event with random value if applicable
            $control_type   = BaseEvent::getRandomUserControl($user_id);
            $eventModelName = $this->eventTypes[$control_type].'Event';
            $event = $eventModelName(false, $user_id);
        }
        
        return $event;
    }
    
    /*
     * get a random controller
     */
    protected function getRandomControls($user_id=false) {
        $control = false;
        
        if(!empty($user_id)) {
            $type        = $this->getEventType();
            $controlName = "{$type}Control";
            $control     = new $controlName($user_id);
        }
        
        return $control;
    }
}