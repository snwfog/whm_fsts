<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use WHM\Model\ParticipantsTimeslots;
use WHM\Model\Timeslot;
use WHM\Model\HouseholdMember;

class ParticipantsTimeslotsTest extends PHPUnit_Framework_TestCase
{
    public function testGetSetHouseholdMember()
    {
        $participantsTimeslot = new ParticipantsTimeslots;
        $householdMember = new HouseholdMember;
        $householdMember->setFirstName("John");
        $householdMember->setLastName("Doe");
        $participantsTimeslot->setHouseholdMember($householdMember);
        $this->assertEquals("John", $participantsTimeslot->getHouseholdMember()->getFirstName());
        $this->assertEquals("Doe", $participantsTimeslot->getHouseholdMember()->getLastName());

    }
    public function testGetSetTimeslot()
    {
        $participantsTimeslot = new ParticipantsTimeslots;
        $timeslot = new Timeslot;
        $timeslot->setName("Back to school");
        $timeslot->setCapacity(200);
        $participantsTimeslot->setTimeslot($timeslot);
        $this->assertEquals("Back to school", $participantsTimeslot->getTimeslot()->getName());
        $this->assertEquals(200, $participantsTimeslot->getTimeslot()->getCapacity());
    }
    public function testGetSetAttend()
    {
        $participantsTimeslot = new ParticipantsTimeslots;
        $participantsTimeslot->setAttend(TRUE);
        $this->assertEquals(TRUE, $participantsTimeslot->getAttend());
    }
}

?>
