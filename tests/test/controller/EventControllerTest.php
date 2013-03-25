<?php

namespace Test\Controller;

use WHM;
use DateTime;
use DateTimeZone;
use Test\Controller\ControllerTestCase;
use WHM\IRedirectable;

class EventControllerTest extends ControllerTestCase implements IRedirectable
{
//    function testGet()
//    {
//        $crawler = $this->request('GET', '/event/1');
//        $this->assertEquals(1, $crawler->filter('html:contains("90")')->count());
//    }
    function testPost()
    {
        $formValues = array(
            "event-id" => '1', 
            "activate" => NULL,
            "start-time" => '19:30:00',
            "start-date" => '03/27/2013',
            "event-capacity" => '88',
            "event-name" => 'Hong Fan Tian Join',
            "description" => 'Celebrate iteration close',
            "slot-id" => array('1'),
            "slot-duration" => array('7200'),
            "slot-capacity" => array('180')
        );
       
        $crawler = $this->request('POST', '/event/1',$formValues);
        print_r($this->client->getResponse()->getContent());
        $this->assertEquals(200, $this->client->getResponse()->getStatus());            
        $this->assertEquals(1, $crawler->filter('html:contains("Hong")')->count());        
    }
}
?>
