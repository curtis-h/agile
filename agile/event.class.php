<?php 
class event {
    
    /*
     * C'tor
     */
    public function __construct() {
        // set up randomness
    }
    
    /**
     * 
     * @param object $job
     * @param array $data
     */
    public function fire($job, $data) {
        // instantiate event from data and mark as failed
        
        $job->delete();
    }
    
}

?>