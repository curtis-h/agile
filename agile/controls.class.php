<?php 
class BaseControl extends Eloquent {
    
    protected $name;
    protected $value;
    protected $maxValue;
    
    public function __construct($user_id=false) {
        if($user_id) {
            $this->create();
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