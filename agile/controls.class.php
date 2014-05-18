<?php 
class BaseControl extends Eloquent {
    
    public $user_id;
    public $name;
    public $value;
    public $maxValue;
    public $controlType;

    protected $table = "controls";
    protected $fillable = array('user_id', 'game_id', 'type_id', 'name', 'value_range');

    public function __construct($user_id=false) {
        if($user_id) {
            $this->user_id = $user_id;
            $this->createControl();
            $this->saveControl();
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

    /**
     * to be inherited
     */
    public function createControl(){

    }

    public static function getRandomUserControl($user_id){
        $controlObject = DB::table("controls")
                            ->where('user_id',$user_id)
                            ->where('game_id',Game::getCurrentGame())
                            ->orderBy(DB::raw('RAND()'))
                            ->first();
        var_dump(Game::getCurrentGame());
        echo "<hr>";
        
        if($controlObject) {
            return (int)$controlObject->type_id;
        }
        return false; 
    }
    
    /**
     * needs to be run after createControl to save to db
     */
    protected function saveControl() {
        $control = array(
            'user_id'     => $this->user_id,
            'game_id'     => Game::getCurrentGame(),
            'type_id'     => $this->controlType,
            'name'        => $this->name,
            'value_range' => json_encode(array())
        );
        
        return DB::table("controls")->insertGetId($control);
    }
}
?>