<?php

require_once ("CLASSA.php");
use \PHPUnit_Framework_TestCase;

class CLASSATEST extends PHPUnit_Framework_TestCase{
var $b;

	function testSquare(){
		$class = new CLASSA();
		$b = $class->square(6);
		$this->assertEquals($b, "36");

	}

// function testmakeArray(){
// $class = new CLASSA();
// 	$array = $class->makeArray();
// 	$this->assertContains("bar", $array);
// }

	public function testmakeEmptyArray()
	    {
	    	$class = new CLASSA();
	        $stack = $class->makeEmptyArray();
	        $this->assertEmpty($stack);
	    }

	public function testFailure()
	{
		$class = new CLASSA();
	    $this->assertObjectHasAttribute('foo', $class);
	}

	public function testgetName(){
		$class = new CLASSA();
		$name = $class->getName();
	    $this->assertEquals('hello', $name);

    
	}
}
?>
