<?php 
class BaseControl extends Eloquent {
    
    protected $user_id;
    protected $name;
    protected $value;
    protected $maxValue;

    protected $table = "controls";
    
    public function __construct($user_id=false) {
        if($user_id) {
            $this->user_id = $user_id;
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