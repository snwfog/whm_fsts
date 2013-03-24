<?php

namespace Test\Controller;

use WHM;
use DateTime;
use DateTimeZone;
use Test\Controller\ControllerTestCase;

class EventControllerTest extends ControllerTestCase
{
//    function testGet()
//    {
//        $crawler = $this->request('GET', '/event/1');
//        $this->assertEquals(1, $crawler->filter('html:contains("90")')->count());
//    }
    function testPost()
    {
        $_POST["event-id"]='1';
        $_POST["activate"]=NULL;
        $_POST["start-time"]='19:30:00';
        $_POST["start-date"]='03/27/2013';
        
        
    }
}
?>
