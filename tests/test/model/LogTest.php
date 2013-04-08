<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use WHM\Model\Logger;

class LogTest extends PHPUnit_Framework_TestCase
{
    public function testGetSetAgent()
    {
        $log = new Logger();
        $log->setAgent("IE Explorer");
        $this->assertEquals("IE Explorer", $log->getAgent());
    }
     public function testGetSetDate()
    {
        $log = new Logger();
        $log->setDate("2012-01-03");
        $this->assertEquals("2012-01-03", $log->getDate());
    }
     public function testGetSetDevice()
    {
        $log = new Logger();
        $log->setDevice("Mac");
        $this->assertEquals("Mac", $log->getDevice());
    }
     public function testGetSetEvent()
    {
        $log = new Logger();
        $log->setEvent("Popup");
        $this->assertEquals("Popup", $log->getEvent());
    }
     public function testGetSetIp()
    {
        $log = new Logger();
        $log->setIp("180.000.000");
        $this->assertEquals("180.000.000", $log->getIp());
    }
     public function testGetSetOs()
    {
        $log = new Logger();
        $log->setOs("Windows");
        $this->assertEquals("Windows", $log->getOs());
    }
     public function testGetSetPage()
    {
        $log = new Logger();
        $log->setPage("IE Explorer");
        $this->assertEquals("IE Explorer", $log->getPage());
    }
    public function testGetSetSchema()
    {
        $log = new Logger();
        $log->setSchema(20);
        $this->assertEquals(20, $log->getSchema());
    }
    public function testGetSetUser()
    {
        $log = new Logger();
        $log->setUser("p345");
        $this->assertEquals("p345", $log->getUser());
    }
    public function testGetSetValue()
    {
        $log = new Logger();
        $log->setValue("333");
        $this->assertEquals("333", $log->getValue());
    }
}


?>
