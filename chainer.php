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
	
	public function fetch($name) {
		if (is_object(self::$register[$name])) {
			return self::$registery[$name];
		}
	}
	
	public function run($function) {
		$function();
		return new static;
	}
}
?>
