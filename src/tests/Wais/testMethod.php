<? php

require_once ("output.php");
use \PHPUnit_Framework_TestCase;

class TestMethod extends PHPUnit_Framework_TestCase{
var $b;

	function testOutput()
	{
		$this->expectOutputString('test');
	}
?>