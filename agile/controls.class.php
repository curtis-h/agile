<?php 
class BaseControl extends Eloquent {
    
    public $user_id;
    public $name;
    public $value;
    public $maxValue;
    
    public function __construct($user_id=false) {
        if($user_id) {
            $this->user_id = $user_id;
            $this->createControl();
        }
    }
    
    
    /**
     * Use Faker to produce a name
     * @return string
     */
    public function getName(){
        $this->name = $this->getCatchPhrase();
    }
    
    public function getCatchPhrase() {
        $faker = Faker\Factory::create();
        return $faker->catchPhrase;
    }
    
}
?>