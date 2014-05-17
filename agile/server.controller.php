<?php
class ServerController extends BaseController {
    
    protected $eventTypes = array(
        'Thermometer',
        'Slider',
        'Button',
    );
    

    /**
     * run initial game setup
     */
    public function createGame() {
        $this->createEvent();
    }

    /**
     * create a random event assigned to a user
     */
    public function createEvent() {
        // get random user
        // create event
        $randomEvent    = $this->getEventType();
        $eventModelName = $randomEvent.'Event';
        $eventModel     = new $eventModelName();
        // push to client
        // push to display
        
    }
    
    /**
     * used to decide if updated value is correct for event
     */
    public function checkEvent() {
        $user_id    = Route::input('user_id');
        $control_id = Route::input('control_id');
        $value      = Route::input('value');
        
        // run check for this user and this control
    }
    
    
    /**
     * call this when an event isn't completed
     * triggered from client side
     */
    public function failEvent() {
        $user_id    = Route::input('user_id');
        $control_id = Route::input('control_id');
        
    }
    
    
    /**
     * handle user login
     * not sure with this one as might be using pusher
     */
    public function login() {
        
    }
    
    protected $pusher;
    
    /**
     * create the pusher connection
     */
    protected function setupPusher() {
        //$this->pusher = new Pusher(Config::get('pusher_app_key'), Config::get('pusher_app_secret'), Config::get('pusher_app_id')');
        
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
    
}