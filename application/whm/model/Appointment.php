<?php
namespace WHM\Model;
use WHM;
use WHM\Application;

class Appointment
{
    private $em;

    public function __construct()
    {
        $this->em = Application::em();
    }

    public function addAppointment($data)
    {
        // $household = $this->findHousehold($data["household-id"]);
        // $member = $this->createMember($data);
        // $member->setHousehold($household);
        // $this->em->persist($member);
        // $this->em->flush();
        // return $member;
    }

   




}
