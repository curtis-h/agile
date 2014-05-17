<?php 
class ButtonControl extends BaseControl {
    
    public function create($user_id) {
        // make a random name
        $this->getName();
        // make a random value
        $this->randomValue();
        // save to db
    }
    
    public function randomValue() {
        $this->value = $this->getCatchPhrase();
    }
}
?>