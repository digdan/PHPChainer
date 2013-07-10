<?
class C {
	static $registry=array();
	static $pointer;

	static function chain() {
		return new static;
	}

	public static function register($obj,$name) {
		self::$registry[$name] = $obj;	
		self::$pointer = $name;
		return new static;
	}

	public function __call($name, $arguments) {
		$target = array(self::$registry[self::$pointer],$name);
		if (is_object(self::$registry[self::$pointer])) {
			if (is_callable( $target , true )) {
				call_user_func_array ( $target , $arguments );
			}
		}
		return new static;
	}

	public function point($name) {
		$target = array(self::$registry[self::$pointer],$name);
		if (is_object(self::$registry[self::$pointer])) {
			self::$pointer = $name;
		}
		return new static;
	}
}


class fruit {
	var $type = "fruit";
	var $color = "";

	function description() {
		echo "Its a fruit";
		echo "<BR>";
	}
	
	function eat() {
		echo "Tastes fruity!";
		echo "<BR>";
	}
}

class apple extends fruit {
	function __construct() {
		$this->type = "apple";
		$this->color();
	}

	function color() {
		$colors = array(
			"red","green","yellow","rotten"
		);
		shuffle($colors);
		$this->color = $colors[0];
	}

	function description() {
		echo "its an apple";
		echo "<BR>";
	}
}

class grannysmith extends apple {
	function __construct() {
		parent::__construct();
		$this->color = "green";
	}
	
	function eat() {
		echo "Great!";
		echo "<BR>";
	}
}

$f = new fruit();
$a = new apple();
$gs = new grannysmith();

C::chain()->
	register($f,"fruit")->
	description()->
	register($a,"apple")->
	description()->
	register($gs,"granny")->
	point("apple")->
	eat();

?>
