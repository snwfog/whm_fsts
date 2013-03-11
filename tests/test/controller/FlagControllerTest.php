<?php

namespace Test\Controller;

use Test\Controller\ControllerTestCase;

class FlagControllerTest extends ControllerTestCase
{
    
    function testNewFlagGet()
    {
        $crawler = $this->request('GET', '/flag');
        $this->assertEquals(0, $crawler->filter('html:contains("new")')->count());
    }
    function testFlagPost()
    {
        $formValues = array(
            "message" => "Missing Phone Number!",
            "household-i" => "1",
            "member-id" => "2",
            "flag-descriptor-id" => "2",
        );
        $crawler = $this->request('POST', '/flag', $formValues);
        $this->assertEquals(200, $this->client->getResponse()->getStatus());        
        $this->assertEquals(
                1, $crawler->filter('html:contains("Warning")')->count()
        );

    }
    function testDeleteFlag()
    {
        $this->request('DELETE', '/flag');
        $crawler = $this->request('GET', '/household/1/1');
        $this->assertEquals(0, $crawler->filter('html:contains("Warning")')->count());
    }
}
?>
