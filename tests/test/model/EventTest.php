<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\Event;

class EventTest extends PHPUnit_Framework_TestCase
{
    public function testgetId()
    {
        $event = new Event();
        $event->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            $event->getId()
                            );
    }

    public function testsetId()
    {
        $event = new Event();
        $event->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($event, "id")
                            );
    }

    public function testgettemplates()
    {
        $event = new Event();
        $event->setTemplates("template1");
        $this->assertEquals(
                            "template1", 
                            $event->getTemplates()
                            );
    }

    public function testsettemplates()
    {
        $event = new Event();
        $event->setTemplates("Fake Street");
        $this->assertEquals(
                            "Fake Street", 
                            PHPUnit_Framework_TestCase::readAttribute($event, "templates")
                            );
    }

    public function testgetMembers()
    {
        $event = new Event();
        $event->setMembers("John Smith");
        $this->assertEquals(
                            "John Smith", 
                            $event->getMembers()
                            );
    }

    public function testsetStart_time()
    {
        $event = new Event();
        $event->setStart_time(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($event, "start_time")
                            );
    }

    public function testgetStart_time()
    {
        $event = new Event();
        $event->setStart_time("Ontario");
        $this->assertEquals(
                            "Ontario", 
                            $event->getStart_time()
                            );
    }

   public function testsetEnd_time()
    {
        $event = new Event();
        $event->setEnd_time(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($event, "end_time")
                            );
    }

    public function testgetEnd_time()
    {
        $event = new Event();
        $event->setEnd_time("Ontario");
        $this->assertEquals(
                            "Ontario", 
                            $event->getEnd_time()
                            );
    }

   public function testsetDate()
    {
        $event = new Event();
        $event->setDate("Tomorrow o'clock");
        $this->assertEquals(
                            "Tomorrow o'clock", 
                            PHPUnit_Framework_TestCase::readAttribute($event, "date")
                            );
    }

    public function testgetDate()
    {
        $event = new Event();
        $event->setDate("Tomorrow o'clock");
        $this->assertEquals(
                            "Tomorrow o'clock", 
                            $event->getDate()
                            );
    }

   public function testsetMax_attendees()
    {
        $event = new Event();
        $event->setMax_Attendees("Tomorrow o'clock");
        $this->assertEquals(
                            "Tomorrow o'clock", 
                            PHPUnit_Framework_TestCase::readAttribute($event, "max_attendees")
                            );
    }

    public function testgetMax_attendees()
    {
        $event = new Event();
        $event->setMax_attendees("Tomorrow o'clock");
        $this->assertEquals(
                            "Tomorrow o'clock", 
                            $event->getMax_attendees()
                            );
    }

   public function testsetRecurrrence()
    {
        $event = new Event();
        $event->setRecurrence("Errday");
        $this->assertEquals(
                            "Errday", 
                            PHPUnit_Framework_TestCase::readAttribute($event, "recurrence")
                            );
    }

    public function testgetRecurrence()
    {
        $event = new Event();
        $event->setRecurrence("Errday");
        $this->assertEquals(
                            "Errday", 
                            $event->getRecurrence()
                            );
    }

}
