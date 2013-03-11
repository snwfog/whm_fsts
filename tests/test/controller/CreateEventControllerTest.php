<?php

namespace Test\Controller;

use Test\Controller\ControllerTestCase;

class CreateEventControllerTest extends ControllerTestCase
{
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
        
            
        $crawler = $this->request('POST', '/event', $formValues);
        $this->assertEquals(200, $this->client->getResponse()->getStatus());        
        $this->assertEquals(
                1, $crawler->filter('html:contains("Dates")')->count()
        );
            
    }
}


?>
