<?php
namespace WHM\Model;
use WHM;
use WHM\Application;
use WHM\Model\Appointment;

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
        // $household = $this->findHousehold($data["household-id"]);
        $appointment = $this->createAppointment($data);
        // $member->setHousehold($household);
        $this->em->persist($appointment);
        $this->em->flush();
        return $appointment;
    }

    //Private Methods
    private function createAppointment($data)
    {
        $appointment = new Appointment();

        $appointment->setHouseholdMemberId($data["member_id"]);
        $appointment->setEventId($data["event_id"]);
    }

}
