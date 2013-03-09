<?php
namespace WHM\Model;
use WHM;
use WHM\Application;
use \WHM\Model\Event;
use \WHM\Model\ManageHousehold;

/**
 * Manage entity household
 **/
class ManageEvent
{
    private $em;
    private $mhousehold;

    public function __construct()
    {
        $this->em = Application::em();
        $this->mhousehold = new ManageHousehold();
        
    }

    public function createEvent($data)
    {
        $event = new Event();
        $event->setName($data["name"]);
        $event->setDescription($data["description"]);
        $event->setStartTime($data["start-time"]); 
        $event->setEndTime($data["end-time"]);
        $event->setStartDate($data["start-date"]); 
        $event->setEndDate($data["end-date"]);
        $event->setCapacity($data["capacity"]);
        $event_participants = $this->getParticipants($data["event-participants"]); 
        $event->addParticipant($event_participants);
        $this->em->persist($event);
        $this->em->flush();

        return $event;

    }

    public function deleteEvent($id)
    {
        $eventId = $this->findEvent($id["event-id"]);
        $this->em->remove($eventId);
        $this->em->flush();
        return $eventId;
    }

     public function findEvent($id)
    {
        $eventId = $this->em->find("WHM\model\Event", (int) $id);
        return $eventId;
    }

    public function getParticipants()
    {
        $query = $this->em->createQuery('SELECT u FROM WHM\Model\Event u');
        $flagParticipants = $query->getResult();
        return $flagParticipants;
    }

}