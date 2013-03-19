<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use WHM\Model\Timeslot;
use WHM\Model\Event;
use WHM\Model\HouseholdMember;

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
    
    public function testGetCapacity()
    {
        $timeSlot = new Timeslot;
        $timeSlot->setCapacity(100);
        $this->assertEquals(100, (int)$timeSlot->getCapacity());
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
    
    public function testAddParticipant()
    {
        $timeSlot = new Timeslot;
        
        $participant1 = new HouseholdMember;
        $participant1->setFirstName("John");
        $participant1->setLastName("Doe");
        $timeSlot->addParticipant($participant1);
        
        $participant2 = new HouseholdMember();
        $participant2->setFirstName("Jane");
        $participant2->setLastName("Doe");
        $timeSlot->addParticipant($participant2);
        
        $this->assertContains($participant1, $timeSlot->getParticipants());
        $this->assertContains($participant1, $timeSlot->getParticipants());
    }
    
    public function testgetParticipants()
    {
        $timeSlot = new Timeslot;
        
        $participant1 = new HouseholdMember;
        $participant1->setFirstName("John");
        $participant1->setLastName("Doe");
        $timeSlot->addParticipant($participant1);
        
        $participant2 = new HouseholdMember();
        $participant2->setFirstName("Jane");
        $participant2->setLastName("Doe");
        $timeSlot->addParticipant($participant2);
        
        $this->assertContains($participant1, $timeSlot->getParticipants());
        $this->assertContains($participant1, $timeSlot->getParticipants());
    }
    
    public function testRemoveParticipant()
    {
        $timeSlot = new Timeslot;
        
        $participant1 = new HouseholdMember;
        $participant1->setFirstName("John");
        $participant1->setLastName("Doe");
        $timeSlot->addParticipant($participant1);
                
        $this->assertContains($participant1, $timeSlot->getParticipants());
        $timeSlot->removeParticipant($participant1);
        $this->assertNotContains($participant1, $timeSlot->getParticipants());
    }
}

?>
