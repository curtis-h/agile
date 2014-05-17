<?php 
class ThermometerControl extends BaseControl {
    
    public function create($user_id) {
        // make a random name
        $this->getName();
        $this->maxValue = 100;
        // save to db
    }
}
?>