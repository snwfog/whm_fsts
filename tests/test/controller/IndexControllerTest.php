<?php

namespace Test\Controller;


class IndexControllerTest extends ControllerTestCase
{
    public function testGet()
    {        
        $this->request('GET', '/');
        $this->assertRegExp("/Mission Bon Accueil/", $this->client->getResponse()->getContent());
    }
}
