<?php

require_once ("CLASSB.php");
	class CLASSA{

		var $foo = "helllooooooo";

		function square($num){
			return $num * $num;
		}


		function makeArray(){
			$a = array(
		    "foo" => "bar",
		    "bar" => "foo",
			);
		}

		function makeEmptyArray(){
			$a = array();
		}

		function getName(){
			$class = new CLASSB();
			$a = $class->getName();
			return $a;

		}


	}
?>
