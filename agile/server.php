<?php
class server_controller extends base_controller {
    
    /**
     * create a random event assigned to a user
     */
    public function create_event() {
        
    }
    
    /**
     * function to call when an event is completed
     */
    public function complete_event() {
        
    }
    
    /**
     * call this when an event isn't completed
     */
    public function fail_event() {
        
    }
    
    /**
     * handle user login
     * not sure with this one as might be using pusher
     */
    public function login() {
        
    }
    
    /**
     * run initial game setup
     */
    public function create_game() {
        
    }
    
    protected $pusher;
    
    /**
     * create the pusher connection
     */
    protected function setup_pusher() {
        $this->pusher = new Pusher(Config::get('pusher_app_key'), Config::get('pusher_app_secret'), Config::get('pusher_app_id')');
        
    }
    
}