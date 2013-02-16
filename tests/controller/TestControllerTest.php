<?php

/**
 * @backupGlobals enabled
 */
 /**
 * @backupStaticAttributes enabled
 */
class Test_Controller_Test extends PHPUnit_Framework_TestCase 
{
    private $test_controller;
    public static function setUpBeforeClass()
    {
        Define(SYSPATH, "core");
        $this->test_controller = new Test_Controller();
    }



    public function testPost()
    {
        $_POST = array( "b"=>"batman", "c" => "catworman" );
        $observer = $this->getMock('Test_Controller', array('post_call'));
        $observer -> expects($this->once())
                  -> method('post_call')
                  -> with($this->equalTo("batman"), $this->equalTo("catwoman"));
        $this->test_controller->post();
    }
 
    public static function tearDownAfterClass()
    {
    }


}

?>
