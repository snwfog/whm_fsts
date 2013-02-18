<?php

namespace Test\Controller;

use \PHPUnit_Framework_TestCase;
use \WHM\Controller\Test;

class TestControllerTest extends PHPUnit_Framework_TestCase
{
    public function testPost()
    {
        $_POST = array( "b"=>"batman", "c" => "catwoman" );

        $controller = new Test();

        $observer = $this->getMock("WHM\Controller\Test", array('post_call'));
        $observer->expects($this->once())
                 ->method('post_call')
                 ->with($this->equalTo("bso"), $this->equalTo("coman"));
        $observer->post();
    }

    public static function tearDownAfterClass()
    {
    }
}
