<?php

require_once ("CLASSA.php");
use \PHPUnit_Framework_TestCase;

class CLASSABTEST extends PHPUnit_Framework_TestCase
{
var $b;


	function testSquare(){
	 $class = new CLASSA();

		$b = $class->square(6);

		$this->assertEquals($b, "6");


	}








}


?>
