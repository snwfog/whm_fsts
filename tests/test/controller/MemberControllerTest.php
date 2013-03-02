<?php

namespace Test\Controller;

class Member_Controller_Test extends ControllerTestCase{
    
    //Failed--member_view_form.twig doesn't exist.
    function testGet()
    {
        $crawler = $this->request('GET', '/member/3');
        $this->assertEquals(200, $this->client->getResponse()->getStatus());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("LUEVANO")')->count());
    }
}

?>
