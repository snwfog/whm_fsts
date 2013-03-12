<?php

namespace Test\Controller;

use Test\Controller\ControllerTestCase;

class CreateEventControllerTest extends ControllerTestCase
{
    function testGet()
    {
            $crawler = $this->request('Get', '/event');
            $this->assertEquals(
                1, $crawler->filter('html:contains("Action")')->count());
            
    }
   function testPost()
    {
            $formValues = array(
            "event-name" => "Sunny-D drinking party",
            "description" => "Celebrate phase reslease",
            "start-time" => "8:30",
            "end-time" => "14:30",
            "event-capacity" => "15",
            "is_template" => NULL,
            "group-id" => NULL,
            "occurrence-type" => "daily",
        );
        
            
        $crawler = $this->request('POST', '/event/new', $formValues);
        $this->assertEquals(200, $this->client->getResponse()->getStatus()); 
        $crawler = $this->request('GET', '/event/1');
        $this->assertEquals(
                1, $crawler->filter('html:contains("Celetrate")')->count()
        );
            
    }
}


?>
