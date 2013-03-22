<?php

namespace Test\Model;
use WHM;
use WHM\Application;
use \PHPUnit_Framework_TestCase;
use WHM\Model\ManageAppointment;

class ManageAppointmentTest extends PHPUnit_Framework_TestCase
{
    public function testAddAppointment()
    {
        $manageAppointment = new ManageAppointment;
        $member = $manageAppointment->addAppointment(1, 1);
        $this->assertEquals("VIERA",$member->getFirstName());
    }
    public function testDeleteAppointment()
    {
        $manageAppointment = new ManageAppointment;
        $manageAppointment->deleteAppointment(1, 1);
        $em = Application::em();
        $participantTimeslot = $em->createQuery('SELECT p FROM WHM\Model\ParticipantsTimeslots p 
                                         WHERE p.household_member= 1 AND p.timeslot= 1')->getResult();
    
        $this->assertEquals(0,  sizeof($participantTimeslot));
    }
}

?>