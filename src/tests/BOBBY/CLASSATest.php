<?php

require_once ("CLASSA.php");
use \PHPUnit_Framework_TestCase;

class CLASSATEST extends PHPUnit_Framework_TestCase
{
var $b;


	function testSquare(){
	 $class = new CLASSA();

		$b = $class->square(6);

		$this->assertEquals($b, "36");


	}


function testmakeArray(){
$class = new CLASSA();

	$make_array = $class->makeArray();

	$this->assertContains("bar", $make_array);


}








}


?>
