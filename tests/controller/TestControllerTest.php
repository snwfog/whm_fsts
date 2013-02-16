<?php

class Test_Controller_Test extends PHPUnit_Framework_TestCase 
{
    public function testPost()
    {
        $test_controller = new Test_Controller();
        $_POST = array( "b"=>"batman", "c" => "catwoman" );
        $observer = $this->getMock('Test_Controller', array('post_call', 'post'));
        $observer->expects($this->once())
                 ->method('post_call')
                 ->with($this->equalTo("batman"), $this->equalTo("catwoman"));
        $this->assertEquals("batman", $test_controller->post());


    }
 
    public static function tearDownAfterClass()
    {
    }


}

?>
