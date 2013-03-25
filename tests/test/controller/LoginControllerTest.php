<?php

namespace Test\Controller;

use Test\Controller\ControllerTestCase;
use WHM\IRedirectable;

class LoginControllerTest extends ControllerTestCase implements IRedirectable
{
    function testPost()
    {
        $formValues = array(
                "username" => 'Admin',
                "inputPassword" =>'Admin'            
        );
        $crawler = $this->request('POST', '/login', $formValues);
        $this->assertEquals(1, $crawler->filter('html:contains("Dependents")')->count());
    }
}
?>
