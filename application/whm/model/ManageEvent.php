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
        $event->setName($data["event-name"]);
        $event->setDescription($data["description"]);
        $event->setStartTime($data["start-time"]); 
        $event->setEndTime($data["end-time"]);
        $event->setStartDate($data["start-date"]); 
        $event->setCapacity($data["event-capacity"]);
        $event->setIsTemplate($data["is_template"]);
        if(isset($data["group-id"]) && !is_null($data["group-id"])){
            $event->setGroupId($data["group-id"]);
        }else{
            $this->em->persist($event);
            $this->em->flush();
            $event->setGroupId($event->getId());
        }
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

      private function updateEvent($eventInstance, $data)
    {
        $data = $this->formatData($data);
        $eventInstance->setName($data["event-name"]);
        $eventInstance->setDescription($data["description"]);
        $eventInstance->setStartTime($data["start-time"]); 
        $eventInstance->setEndTime($data["end-time"]);
        $eventInstance->setStartDate($data["start-date"]); 
        $eventInstance->setEndDate($data["end-date"]);
        $eventInstance->setCapacity($data["event-capacity"]);
        $this->em->persist($eventInstance);
        $this->em->flush();
    }

    private function formatData($data)
    {
        foreach ($data as $key => $value)
        {
            $data[$key] = str_replace("-", "", $value);
        }
        return $data;
    }

}