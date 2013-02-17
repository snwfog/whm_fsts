<?php

class Test_Controller_Test extends PHPUnit_Framework_TestCase 
{
    public function testPost()
    {
        $_POST = array( "b"=>"batman", "c" => "catwoman" );

        $observer = $this->getMock('Test_Controller', array('post_call'));
        $observer->expects($this->once())
                 ->method('post_call')
                 ->with($this->equalTo("bso"), $this->equalTo("coman"));
        $observer->post();
    }
 
    public static function tearDownAfterClass()
    {
    }


}

?>
