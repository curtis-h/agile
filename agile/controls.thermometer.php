<?php 
class ThermometerControl extends BaseControl {
    
    public function createControl() {
        // make a random name
        $this->getName();
        $this->maxValue = 100;
        // save to db
    }
}
?>