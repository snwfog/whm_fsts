<?php

namespace Test\Controller;

use Test\Controller\ControllerTestCase;
use DateTime;
use DateTimeZone;
use DateInterval;
use WHM;

class CreateEventControllerTest extends ControllerTestCase
{
    function testGet()
    {
            $crawler = $this->request('Get', '/event/new');
            $this->assertEquals(
                1, $crawler->filter('html:contains("Action")')->count());
            
    }
   function testPost()
    {
            $formValues = array(
            "event-name" => "Sunny-D drinking party",
            "description" => "Celebrate phase reslease",
            "start-time" => "18:30",
            //"end-time" => "14:30:00",
            "start-date" => "03/31/2013",
            "end-date" => "04/02/2013",                
            "event-capacity" => "15",
            "is_template" => NULL,
            "group-id" => NULL,
            "occurrence-type" => "daily",
        );
        
        $this->request('POST', '/event/new', $formValues);
        $crawler = $this->request('GET', '/event/11');
        $this->assertEquals(
                1, $crawler->filter('html:contains("Celebrate")')->count());            
    }
}


?>
