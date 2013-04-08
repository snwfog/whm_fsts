<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use WHM\Model\Timeslot;
use WHM\Model\Event;
use WHM\Model\HouseholdMember;
use WHM\Model\ParticipantsTimeslots;

class TimeSlotTest extends PHPUnit_Framework_TestCase
{
    public function testGetDuration()
    {
        $timeSlot = new Timeslot;
        $timeSlot->setDuration(1800);
        $this->assertEquals(1800, (int)$timeSlot->getDuration());
    }

    public function testSetDuration()
    {
        $timeSlot = new Timeslot;
        $timeSlot->setDuration(3600);
        $this->assertEquals(3600, PHPUnit_Framework_TestCase::readAttribute($timeSlot, "duration"));
    }
    
    public function testGetName()
    {
        $timeSlot = new Timeslot;
        $timeSlot->setName("Slot25");
        $this->assertEquals("Slot25", $timeSlot->getName());
    }

    public function testSetName()
    {
        $timeSlot = new Timeslot;
        $timeSlot->setName("Slot72");
        $this->assertEquals("Slot72", PHPUnit_Framework_TestCase::readAttribute($timeSlot, "name"));
    }

    public function testSetCapacity()
    {
        $timeSlot = new Timeslot;
        $timeSlot->setCapacity(200);
        $this->assertEquals(200, PHPUnit_Framework_TestCase::readAttribute($timeSlot, "capacity"));
    }
    
    public function testGetSetEvent()
    {
        $timeSlot = new Timeslot;
        
        $observer = $this->getMock('WHM\Model\Event');        
        
        $timeSlot->setEvent($observer);
        $this->assertEquals($timeSlot->getEvent(),$observer);
    }
    
    public function testgetParticipantsToday()
    {
        $timeslot = new Timeslot;
        $timeslot->_construct();

        $arr=$timeslot->getParticipantsToday();
        
        $this->assertEquals(0, sizeof($arr));
    }
    public function testGetParticipants()
    {
        $timeslot = new Timeslot;
        $timeslot->_construct();
        $arr=$timeslot->getParticipants();        
        $this->assertEquals(0, sizeof($arr));
    }

}

?>
