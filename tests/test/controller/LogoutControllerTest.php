<?php

namespace Test\Controller;

use Test\Controller\ControllerTestCase;
use WHM\IRedirectable;

class LogoutControllerTest extends ControllerTestCase implements IRedirectable
{
    function testGet()
    {
        $this->request('GET', '/logout');
        $this->assertTrue(!isset($_SESSION['username']));
    }
}
?>
