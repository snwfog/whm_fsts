<?php
namespace WHM\Model;
use WHM;
use WHM\Application;
use WHM\Model\Event;
use WHM\Model\HouseholdMember;

/**
 * ManageAppointment appointment
 **/
class ManageAppointment
{
    private $em;

    public function __construct()
    {
        $this->em = Application::em();
    }

    public function addAppointment($data)
    {
        // print_r($data);
        // $appointment = $this->createAppointment($data);
        // $this->em->persist($appointment);
        // $this->em->flush();
        // return $appointment;
        $householdmember = new HouseholdMember();
        $event = new Event();

        // $this->householdmember->addEvent($event)


    }

    //Private Methods
    private function createAppointment($data)
    {
        // $appointment = new Appointment();

        // $appointment->setHouseholdMemberId($data["member_id"]);
        // $appointment->setEventId($data["event_id"]);
    }

}
