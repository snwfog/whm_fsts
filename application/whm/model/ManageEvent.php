<?php
namespace WHM\Model;
use WHM;
use WHM\Application;
use \WHM\Model\Event;
use \WHM\Model\ManageHousehold;
use DateTime;
use DateTimeZone;
use DateInterval;
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
        if(isset($data["is_template"])){
            $event->setIsTemplate($data["is_template"]);
        }
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

    public function getUpComingEvents()
    {
        //CONSTRAINT: RETRIEVE EVENT ONLY 2 WEEK AHEAD.
        $dateTime2 = new DateTime();
        $dateTime2->setTimezone(new DateTimeZone(LOCALTIME));
        $dateNow = $dateTime2;

        $dateTime = new DateTime();
        $dateTime->setTimezone(new DateTimeZone(LOCALTIME));
        $incrementer = DateInterval::createFromDateString("2 weeks");
        $dateTime = $dateTime->add($incrementer);
        $dateFuture = $dateTime;

        $query = $this->em->createQueryBuilder()
                          ->select("event")
                          ->from("WHM\model\Event", "event")
                          ->where("event.start_date <= :dateFuture")
                          ->andWhere("event.start_date >= :dateNow")
                          ->groupBy("event.group_id")
                          ->orderBy("event.group_id")
                          ->setParameter('dateFuture', $dateFuture)
                          ->setParameter('dateNow', $dateNow);                         

        $upcomingEvents = $query->getQuery()->execute();
        return $upcomingEvents;
    }


    public function getRelatedEvents($group_id, $event_id)
    {
        $query = $this->em->createQueryBuilder()
                          ->select("event")
                          ->from("WHM\model\Event", "event")
                          ->where("event.group_id = :group_id")
                          ->andWhere("event.id <> :event_id")
                          ->setParameter('group_id', $group_id)
                          ->setParameter('event_id', $event_id);                 

        $relatedEvents = $query->getQuery()->execute();
        return $relatedEvents;
    }

}