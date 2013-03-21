<?php
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\ManageEvent;
use DateTime;
use DateTimeZone;
use WHM\Controller\ControllerHelper;

class Event extends Controller implements IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    private $manageEvent;
    private $helper;
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //WHM\Helper::backtrace();
        $this->helper = new ControllerHelper();
        $this->manageEvent= new ManageEvent();
    }

    public function get($event_id = null)
    {   
        $allEvents = $this->manageEvent->getAllEventsByGroup();
        $this->data["allEvents"] = $this->formatEvents($allEvents);

        if(!is_null($event_id)){
            //Get the specified event, upcoming events and related events
            $this->data["formAction"] = "event";

            $event = $this->manageEvent->findEvent($event_id);
            $relatedEvents = $this->manageEvent->getRelatedEvents($event->getGroupId());
            $timeslots = $this->getSlots($event);
            $relatedEvents = $this->formatEvents($relatedEvents);
            $event = $this->formatEvents(array( 0 => $event));

            $this->data["event"] = $event[0];
            $this->data["relatedEvents"] = $relatedEvents;
            $this->data["timeslots"] = $timeslots;
            $this->display("event.create.twig", $this->data);
        }else
        {    //Get templates if new event
            $createEvent = new WHM\Controller\CreateEvent;
            $createEvent->get();
        }

    }

    // Update Event
    public function post(){
        $event = $this->manageEvent->findEvent($_POST["event-id"]);
        
        //Activate or Deactive event
        if(isset($_POST["activate"])){
            $this->manageEvent->setIsActivated($event, $_POST["activate"]);
            $this->redirect('event/'.$_POST["event-id"]);
            return;
        }

        //Convert start-date and start-time to datetime object
        $start_time = new DateTime();
        $start_time->setTimezone(new DateTimeZone(LOCALTIME));
        $start_date = new DateTime();
        $start_date->setTimezone(new DateTimeZone(LOCALTIME));

        if( !empty($_POST["start-time"]) && !empty($_POST["start-date"]) ){
            $form_start_time = explode(":", $_POST["start-time"]);
            $start_time->setTime($form_start_time[0], $form_start_time[1]);            
            $form_start_date = explode("/", $_POST["start-date"]); // input m/d/Y
            $start_date->setDate($form_start_date[2], $form_start_date[0], $form_start_date[1]);// input y/m/d
        }else{
            $this->redirect('event/'.$_POST["event-id"]);
            return;
        }

        $_POST["start-date"] = $start_date;
        $_POST["start-time"] = $start_time;
        $this->manageEvent->updateEvent($event, $_POST);
        $this->redirect("event/".$event->getId());
    }

    public function delete(){
        parse_str($this->getContent(), $this->requestContents);
        $dflag = $this->manageEvent->deleteTimeslot($this->requestContents);
    }

    public function formatEvents($events)
    {
        $data = array();
        $count = 0;
        foreach( $events as $event)
        {
            $data[$count++] = array
                (
                    "event-id" => $event->getId(),
                    "name" => $event->getName(),
                    "capacity" => $event->getCapacity(),
                    "description" => $event->getDescription(),
                    "start-time" => $event->getStartTime()->format("H:i"),
                    "date" => $event->getStartDate()->format("m/d/Y"),
                    "group-id" => $event->getGroupId(),
                    "is_activated" => $event->getIsActivated(),
                );
        }
        return $data;
    }

    public function getIndexedEvents($events, $household_id, $member_id)
    {
        $data = array();
        $tracker = array();

        for ($j = 1; $j <= 4; $j++)  // 4 rows
        {
            $date = date_create('now');
            $date->setTimezone(new DateTimeZone(LOCALTIME));
            for ($i = 1; $i <= 14; $i++)
            {
                date_modify($date, '+1 day');
                $d = date_format($date, 'm/d/Y');
                foreach( $events as $event)
                {
                    $eventdate = $event->getStartDate()->format("m/d/Y");
                    if($d == $eventdate && !in_array($event->getId() , $tracker) && empty($data[$j][$i]))
                    {
                        $timeslots= $this->getSlotsInfo($event, $household_id, $member_id);
                        $tracker[] = $event->getId();

                        $data[$j][$i] = array
                        (
                            "event-id" => $event->getId(),
                            "name" => $event->getName(),
                            "capacity" => $event->getCapacity(),
                            "description" => $event->getDescription(),
                            "start-time" => $event->getStartTime()->format("H:i"),
                            "date" => $event->getStartDate()->format("m/d/Y"),
                            "timeslots" => $timeslots,
                            "registered" => $this->registeredEvents($event, $household_id, $member_id)
                        );
                    }
                };
            }
        }
        return $data;
    }

    private function getSlots($event)
    {
        $count = 0;
        $timeslots = array();
        $timeslot = $event->getTimeslots();
        $slotStarttime = $event->getStartTime()->format("H:i");
        foreach( $timeslot as $t)
        {   
            $slotEndtime = new DateTime($slotStarttime);
            $duration = '+'.$t->getDuration(). ' mins';
            date_modify($slotEndtime, $duration);
            $endtime = $slotEndtime->format('H:i');

            $timeslots[$count++] = array
            (
                "id" => $t->getId(),
                "name" => $t->getName(),
                "duration" => $t->getDuration(),
                "capacity" => $t->getCapacity(),
                "start-time" => $slotStarttime,
                "end-time" => $endtime,
                "participants"=> $this->helper->formatMember($t->getParticipants()),
            );
            $slotStarttime = $endtime;
        }
        return $timeslots;
    }

    private function getSlotsInfo($event, $household_id, $member_id)
    {
        $count = 0;
        $timeslots = array();

        $timeslot = $event->getTimeslots();
        $slotStarttime = $event->getStartTime()->format("H:i");

        foreach( $timeslot as $t)
        {   
            $registration = $this->getRegistration($t, $household_id, $member_id);

            $slotEndtime = new DateTime($slotStarttime);
            $duration = '+'.$t->getDuration(). ' mins';
            date_modify($slotEndtime, $duration);
            $endtime = $slotEndtime->format('H:i');

            $timeslots[$count++] = array
            (
                "id" => $t->getId(),
                "name" => $t->getName(),
                "duration" => $t->getDuration(),
                "capacity" => $t->getCapacity(),
                "start-time" => $slotStarttime,
                "end-time" => $endtime,
                "status" => $registration["status"],
                "registered" => $registration["registered"]
            );
            $slotStarttime = $endtime;
        }
        return $timeslots;
    }

    private function getRegistration($timeslot, $household_id, $member_id)
    {
        $participants = $timeslot->getParticipants();
        $participants = $this->helper->formatMember($participants);
        $status = "Unregistered";

        if(!is_null($participants))
        {
            foreach( $participants as $p )
            {   
                if( $p["household_id"] == $household_id and $p["member-id"] == $member_id )
                    $status = "Registered";
            }
        }
        $data = array(
                    "status"  =>  $status,
                    "registered"   => count($participants)
                    );

        return $data;
    }

    // Checks if the ->HOUSEHOLD<- is registered for an event.
    private function registeredEvents($event, $household_id, $member_id)
    {
        $timeslot = $event->getTimeslots();

        foreach( $timeslot as $t)
        {
            $participants = $t->getParticipants();
            $participants = $this->helper->formatMember($participants);

            if(!is_null($participants))
            {
                foreach( $participants as $p )
                {   
                    if( $p["household_id"] == $household_id ) //and $p["member-id"] == $member_id 
                        return "Registered";
                }
            }
        }
        return "Unregistered";
    }

}
