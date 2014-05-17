<?php 
class SliderControl extends BaseControl {
    
    public function createControl() {
        // make a random name
        $this->getName();
        $this->maxValue = 5;
        // save to db
    }
}
?>