<?php 
class BaseControl extends Eloquent {
    
    public $user_id;
    public $name;
    public $value;
    public $maxValue;
    public $controlType;

    protected $table = "controls";

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
    

    public function getControl($id=0){
        return $this::find($id);
    }

    public function createControl(){
        $control = array(
                'user_id'     => $this->user_id,
                'game_id'     => Game::getCurrentGame(),
                'type_id'     => $this->controlType,
                'name'        => $this->name,
                'value_range' => json_encode(array())
            );
        return $this::create($control);

    }

    public statis function getRandomUserControl($user_id){
        return 1;
    }
}
?>