<?php 
class SliderControl extends BaseControl {
    
    public function create($user_id) {
        // make a random name
        $this->getName();
        $this->maxValue = 5;
        // save to db
    }
}
?>