<?
include_once("chainer.php");

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
