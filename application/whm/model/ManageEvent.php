<?php
namespace WHM\Model;
use WHM;
use WHM\Application;
use \WHM\Model\Event;
use \WHM\Model\Timeslot;
use \WHM\Model\ManageHousehold;
use \WHM\Model\ParticipantsTimeslots;
use \WHM\Model\ManageAppointment;
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
        $this->mappointment = new ManageAppointment();
    }

    public function createEvent($data)
    {
        $event = new Event();
        $event->setName($data["event-name"]);
        $event->setDescription($data["description"]);
        $event->setStartTime($data["start-time"]); 
        $event->setStartDate($data["start-date"]); 
        $event->setCapacity($data["event-capacity"]);
        if(isset($data["is_template"])){
            $event->setIsTemplate($data["is_template"]);
        }
        if(isset($data["group-id"]) && !is_null($data["group-id"])){
            $event->setGroupId($data["group-id"]);
        }else{
            /*
            **The event is saved before setting groupId just in 
            **because the group-if might be its' own ID.
            */
            $this->em->persist($event);
            $this->em->flush();
            $event->setGroupId($event->getId());
        }
        $this->em->persist($event);
        $this->em->flush();

        return $event;

    }


    public function createTimeslot($event, $data)
    {
        if(isset($data["slot-name"]) && isset($data["slot-duration"]) && isset($data["slot-capacity"])){
            $timeslot = new Timeslot();
            $timeslot->setName($data["slot-name"]);
            $timeslot->setDuration($data["slot-duration"]);
            $timeslot->setCapacity($data["slot-capacity"]);
            $timeslot->setEvent($event);
            $event->addTimeslot($timeslot);
            $this->em->persist($event);
            $this->em->persist($timeslot);
            $this->em->flush();
        }
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
        $eventInstance = $this->em->find("WHM\model\Event", (int) $id);
        return $eventInstance;
    }

    public function deleteTimeslot($id){
        $timeslot = $this->findTimeslot($id["timeslot-id"]);
        $this->em->remove($timeslot);
        $this->em->flush();
        return $timeslot;
    }

     public function findTimeslot($id)
    {
        $timeslot = $this->em->find("WHM\model\Timeslot", (int) $id);
        return $timeslot;
    }

    public function getParticipants()
    {
        $query = $this->em->createQuery('SELECT u FROM WHM\Model\Event u');
        $participants = $query->getResult();
        return $participants;
    }

    public function updateEvent($eventInstance, $data)
    {
        $eventInstance->setName($data["event-name"]);
        $eventInstance->setDescription($data["description"]);
        $eventInstance->setStartTime($data["start-time"]);
        $eventInstance->setStartDate($data["start-date"]); 
        $eventInstance->setCapacity($data["event-capacity"]);

        if(isset($data["slot-id"]) && isset($data["slot-id"]) && isset($data["slot-duration"]) && isset($data["slot-capacity"])){
          $slot_ids = $data["slot-id"];
          $slot_names = $data["slot-name"];
          $slot_durations = $data["slot-duration"];
          $slot_capacities = $data["slot-capacity"];

          if( count($slot_names) > 0 && count($slot_durations) > 0 && count($slot_capacities) > 0){
              if( count($slot_names) == count($slot_durations) && count($slot_durations) == count($slot_capacities)){
                  for ($i = 0; $i < count($slot_names); $i++){
                      if(!empty($slot_ids[$i])){
                          $timeslot = $this->findTimeslot($slot_ids[$i]);
                          $timeslot->setName($slot_names[$i]);
                          $timeslot->setDuration($slot_durations[$i]);
                          $timeslot->setCapacity($slot_capacities[$i]);
                      }else{
                          $newTimeslot = array("slot-name" => $slot_names[$i],
                                            "slot-duration" => $slot_durations[$i], 
                                            "slot-capacity" => $slot_capacities[$i]
                                      );
                          $this->createTimeslot($eventInstance, $newTimeslot);
                      }
                  }
              }
          }
      }

        $this->em->persist($eventInstance);
        $this->em->flush();
    }

    public function getUpComingEvents()
    {
        //CONSTRAINT: RETRIEVE EVENT ONLY 2 WEEKS AHEAD.
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
                          ->andWhere("event.is_template <> 1")
                          ->andWhere("event.is_activated = 1")
                          ->groupBy("event.group_id")
                          ->orderBy("event.group_id")
                          ->setParameter('dateFuture', $dateFuture)
                          ->setParameter('dateNow', $dateNow);                         

        $upcomingEvents = $query->getQuery()->execute();

        //return Array of Objects
        return $upcomingEvents;
    }

    public function getAllUpComingEvents()
    {
        //CONSTRAINT: RETRIEVE EVENT ONLY 4 WEEKS AHEAD.
        $dateTime2 = new DateTime();
        $dateTime2->setTimezone(new DateTimeZone(LOCALTIME));
        $dateNow = $dateTime2;

        $dateTime = new DateTime();
        $dateTime->setTimezone(new DateTimeZone(LOCALTIME));
        $incrementer = DateInterval::createFromDateString("4 weeks");
        $dateTime = $dateTime->add($incrementer);
        $dateFuture = $dateTime;

        $query = $this->em->createQueryBuilder()
                          ->select("event")
                          ->from("WHM\model\Event", "event")
                          ->where("event.start_date <= :dateFuture")
                          ->andWhere("event.start_date >= :dateNow")
                          ->andWhere("event.is_template <> 1")
                          ->andWhere("event.is_activated = 1")
                          ->setParameter('dateFuture', $dateFuture)
                          ->setParameter('dateNow', $dateNow);                         

        $upcomingEvents = $query->getQuery()->execute();
        return $upcomingEvents;
    }

    public function getEventsbyMonth($month)
    {
        $currentDate = new DateTime();
        $currentDate->setTimezone(new DateTimeZone(LOCALTIME));
        $currentYear = date('Y');
        $currentMonth = date('m');
        $currentDate->setDate($currentYear,$currentMonth,"01");

        $stringMonthtoAdd = "+". $month . " month";

        $startDate = $currentDate;
        date_Modify($startDate,$stringMonthtoAdd);

        $endDate = $startDate;
        date_Modify($endDate, "+1 month");
        date_Modify($endDate,"-1 day");

        $query = $this->em->createQueryBuilder()
                          ->select("event")
                          ->from("WHM\model\Event", "event")
                          ->where("event.start_date <= :dateFuture")
                          ->andWhere("event.start_date >= :dateNow")
                          ->andWhere("event.is_template <> 1")
                          ->andWhere("event.is_activated = 1")
                          ->setParameter('dateFuture', $endDate)
                          ->setParameter('dateNow', $startDate);                         

        $upcomingEvents = $query->getQuery()->execute();
        return $upcomingEvents;
    }

    public function getTodaysEvents()
    {
        $dateNow = date("Y-m-d", strtotime("NOW"));    
        $query = $this->em->createQueryBuilder()
                          ->select("event")
                          ->from("WHM\model\Event", "event")
                          ->where("event.start_date = :dateNow")    
                          ->setParameter('dateNow', $dateNow);                         

        $upcomingEvents = $query->getQuery()->execute();
        return $upcomingEvents;
    }   

      public function getAllEventsByGroup()
    {
        $query = $this->em->createQueryBuilder()
                          ->select("event")
                          ->from("WHM\model\Event", "event")
    
                          ->groupBy("event.group_id")
                          ->orderBy("event.group_id");                     

        $allEvents = $query->getQuery()->execute();
        return $allEvents;
    }

    public function getAllEvents()
    {
        $query = $this->em->createQueryBuilder()
                          ->select("event")
                          ->from("WHM\model\Event", "event");                     

        $allEvents = $query->getQuery()->execute();
        return $allEvents;
    }



    public function getRelatedEvents($group_id)
    {
        $query = $this->em->createQueryBuilder()
                          ->select("event")
                          ->from("WHM\Model\Event", "event")
                          ->where("event.group_id = :group_id")
                          ->andWhere("event.is_template <> 1")
                          ->setParameter('group_id', $group_id)
                          ->orderBy("event.start_date", "ASC");                 

        $relatedEvents = $query->getQuery()->execute();
        return $relatedEvents;
    }

    public function getTemplates()
    {
        $query = $this->em->createQueryBuilder()
                          ->select("event")
                          ->from("WHM\model\Event", "event")
                          ->where("event.is_template = 1");                

        $templates = $query->getQuery()->execute();
        return $templates;
    }
    public function setIsActivated($event, $activate)
    {
        $event->setIsActivated($activate);
        $this->em->persist($event);
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

    public function updateAttendance($timeslot_id, $householdM_id, $attendance)
    {
        $data = $this->mappointment->getParticipantTimeSlot($householdM_id, $timeslot_id);
        $attend = $data->getAttend();
        if ($attend != $attendance){
            $data->setAttend($attendance);

            $this->em->persist($data);
            $this->em->flush();  
        }
        

    }

    public function eventStatistic($model, $field, $event_group_id, $start_date, $end_date){

        /* The doctrine code should be similar to this mysql
          SELECT *, COUNT(hm.id)
          FROM `household_members` HM
          Right Join participants_timeslots PT ON HM.id = PT.household_member_id
          Inner Join timeslots T ON PT.timeslot_id = T.id
          Inner Join events E ON T.event_id = E.id
          group by HM.mother_tongue
        */
        $prefix = array( "Address" => "A",
                         "HouseholdMember" => "HM",
                         "ParticipantsTimeslots" => "PT",
                         "Timeslot" => "T",
                         "Event" => "E",
                         "Household" => "H",
                       );

        $model = $prefix[$model];

        $query = $this->em->createQueryBuilder()
                          ->select($model.".".$field." ,COUNT(HM.id)")
                          ->from("WHM\Model\HouseholdMember", "HM")
                          ->InnerJoin("WHM\Model\ParticipantsTimeslots", "PT", "WITH", "HM = PT.household_member")
                          ->InnerJoin('WHM\Model\timeslot', "T", "WITH", "PT.timeslot = T")
                          ->InnerJoin("WHM\Model\Event", "E", "WITH", "T.event = E")
                          ->InnerJoin("WHM\Model\Household", "H", "WITH", "HM.household = H")
                          ->InnerJoin("WHM\Model\Address", "A", "WITH", "H.address = A")
                          ->Where("E.group_id = :group_id")
                          ->andWhere("E.start_date >= :start_date")
                          ->andWhere("E.start_date <= :end_date")
                          ->groupBy($model.".".$field)
                          ->setParameter('group_id', $event_group_id)
                          ->setParameter('start_date', $start_date)
                          ->setParameter('end_date', $end_date);  

        $result = $query->getQuery()->execute();
        $formatResult = array();
        foreach ($result as $value) {
            $formatResult[$value[$field]] = $value[1];
        }
        return $formatResult;
    }

}