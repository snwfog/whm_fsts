<?php
namespace WHM\Model;
use WHM;
use WHM\Application;
use WHM\Model\Event;
use WHM\Model\ManageHousehold;

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

    public function addAppointment($member_id, $timeslot_id)
    {
        $managehousehold = new ManageHousehold();
        $member = $managehousehold->findMember($member_id);
        $timeslot = $this->em->find("WHM\model\Timeslot", (int) $timeslot_id);
        $member->attendTimeslot($timeslot);
        
        $this->em->persist($member);
        $this->em->flush();
        return $appointment;
    }

    public function deleteAppointment($member_id, $event_id)
    {  
        $managehousehold = new ManageHousehold();
        $member = $managehousehold->findMember($member_id);
        $event = $this->em->find("WHM\model\Event", (int) $event_id);
        $member->removeEvent($event);

        $this->em->persist($member);
        $this->em->persist($event);
        $this->em->flush();
        return $appointment;
    }

}
