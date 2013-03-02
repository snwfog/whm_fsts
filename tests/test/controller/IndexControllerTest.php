<?php

namespace Test\Controller;


class IndexControllerTest extends ControllerTestCase
{
    public function testGet()
    {        
        $this->request('GET', '/');
        $this->assertRegExp("/Welcome Hall Mission/", $this->client->getResponse()->getContent());
    }
}
