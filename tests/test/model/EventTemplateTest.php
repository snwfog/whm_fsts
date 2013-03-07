<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\EventTemplate;

class EventTemplateTest extends PHPUnit_Framework_TestCase
{
    public function testgetId()
    {
        $eventtemplate = new EventTemplate();
        $eventtemplate->setId(123456789);
        $this->assertEquals(123456789, $eventtemplate->getId());
    }

    public function testsetId()
    {
        $eventtemplate = new EventTemplate();
        $eventtemplate->setId(123456789);
        $this->assertEquals(123456789, PHPUnit_Framework_TestCase::readAttribute($eventtemplate, "id"));
    }


    public function testsetStart_time()
    {
        $eventtemplate = new EventTemplate();
        $eventtemplate->setStart_time(123456789);
        $this->assertEquals(123456789, PHPUnit_Framework_TestCase::readAttribute($eventtemplate, "start_time"));
    }

    public function testgetStart_time()
    {
        $eventtemplate = new EventTemplate();
        $eventtemplate->setStart_time("now");
        $this->assertEquals("now", $eventtemplate->getStart_time());
    }

    public function testsetEnd_time()
    {
        $eventtemplate = new EventTemplate();
        $eventtemplate->setEnd_time(123456789);
        $this->assertEquals(123456789, PHPUnit_Framework_TestCase::readAttribute($eventtemplate, "end_time"));
    }

    public function testgetEnd_time()
    {
        $eventtemplate = new EventTemplate();
        $eventtemplate->setEnd_time("template1");
        $this->assertEquals("template1", $eventtemplate->getEnd_time());
    }

    public function testsetEvents()
    {
        $eventtemplate = new EventTemplate();
        $eventtemplate->setEvents("template123");
        $this->assertEquals("template123", PHPUnit_Framework_TestCase::readAttribute($eventtemplate, "events"));
    }

    public function testgetEvents()
    {
        $eventtemplate = new EventTemplate();
        $eventtemplate->setEvents("template1");
        $this->assertEquals("template1", $eventtemplate->getEvents());
    }


}
