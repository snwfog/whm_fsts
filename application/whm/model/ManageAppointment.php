<?php
namespace WHM\Model;
use WHM;
use WHM\Application;
use WHM\Model\Event;
use WHM\Model\ManageHousehold;
use WHM\Model\ParticipantsTimeslots;
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
        $ParticicpantTimeslot = new ParticipantsTimeslots();

        $member = ManageHousehold::findMember($member_id);
        $timeslot = $this->em->find("WHM\model\Timeslot", (int) $timeslot_id);
        
        $ParticicpantTimeslot->setHouseholdMember($member);
        $ParticicpantTimeslot->setTimeslot($timeslot);
        
        $this->em->persist($ParticicpantTimeslot);
        $this->em->flush();
    }

    public function deleteAppointment($member_id, $timeslot_id)
    { 
        $ParticicpantTimeslot = $this->getParticipantTimeslot($member_id, $timeslot_id);
        
        $this->em->remove($ParticicpantTimeslot);
        $this->em->flush();
    }

    public function getParticipantTimeslot($member_id, $timeslot_id)
    {
       $member = ManageHousehold::findMember($member_id);

        $timeslot = $this->em->find("WHM\model\Timeslot", (int) $timeslot_id);
        $query = $this->em->createQueryBuilder()
                          ->select("participantTimeslot")
                          ->from("WHM\model\ParticipantsTimeslots", "participantTimeslot")
                          ->where("participantTimeslot.household_member = :member_id")
                          ->andWhere("participantTimeslot.timeslot = :timeslot_id")
                          ->setParameter('member_id', $member_id)
                          ->setParameter('timeslot_id', $timeslot_id);                         

        $data = $query->getQuery()->getSingleResult();
        return $data;
    }

}
