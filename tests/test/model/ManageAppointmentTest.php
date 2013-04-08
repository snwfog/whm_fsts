<?php

namespace Test\Model;
use WHM;
use WHM\Application;
use \PHPUnit_Framework_TestCase;
use WHM\Model\ManageAppointment;

class ManageAppointmentTest extends PHPUnit_Framework_TestCase
{
    private $em;
    private $manageAppointment;
    
    protected function setUp()
    {
        parent::setUp();
        $this->em = Application::em();
        $this->manageAppointment = new ManageAppointment();
    }
    public function testAddAppointment()
    {
        $member = $this->manageAppointment->addAppointment(1, 2);
        $participantTimeslot = $this->em->createQuery('SELECT p FROM WHM\Model\ParticipantsTimeslots p 
                                         WHERE p.household_member= 1 AND p.timeslot= 2')->getResult();
    
        $this->assertNotNull($participantTimeslot);
    }
    public function testGetAppointment()
    {
        $pt = $this->manageAppointment->getParticipantTimeslot(1,2);
        $this->assertNotNull($pt);
    }


    public function testDeleteAppointment()
    {
        $this->manageAppointment->deleteAppointment(1, 2);
        //$this->assertFalse($this->manageAppointment->getParticipantTimeslot(1,2));
//        $pt = $em->createQuery('SELECT COUNT(p.id) FROM WHM\Model\ParticipantsTimeslots p')->getResult();
//    
//        $this->assertEquals(0,  $pt);
    }
    
}

?>