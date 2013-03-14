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
        $eventUCs = $this->manageEvent->getUpComingEvents();
        $this->data["upcomingEvents"] = $this->formatEvents($eventUCs);

        if(!is_null($event_id)){
            //Get the specified event, upcoming events and related events
            $this->data["formAction"] = "event";

            $event = $this->manageEvent->findEvent($event_id);
            $relatedEvents = $this->manageEvent->getRelatedEvents($event->getGroupId());
            //$participants = $event->getParticipants();
            
            //$participants = $this->helper->formatMember($participants);
            $relatedEvents = $this->formatEvents($relatedEvents);
            $event = $this->formatEvents(array( 0 => $event));
            
            $this->data["event"] = $event[0];
            $this->data["relatedEvents"] = $relatedEvents;
            //$this->data["participants"] = $participants;
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

        //Convert start-date to datetime object
        $start_date = new DateTime();
        $start_date->setTimezone(new DateTimeZone(LOCALTIME));
        $form_start_date = explode("/", $_POST["start-date"]); // input m/d/Y
        $start_date->setDate($form_start_date[2], $form_start_date[0], $form_start_date[1]);// input y/m/d

        $_POST["start-date"] = $start_date;

        $this->manageEvent->updateEvent($event, $_POST);

        $this->redirect("event/".$event->getId());

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
                );
        }
        return $data;      
    }

    public function getIndexedEvents($events)
    {
        $data = array();
        $tracker = array(); 

        for ($j = 1; $j <= 10; $j++)  // 10 rows for now...
        {
            $date = date_create('now');$date->setTimezone(new DateTimeZone(LOCALTIME));
            for ($i = 1; $i <= 14; $i++)
            {   
                date_modify($date, '+1 day');
                $d = date_format($date, 'm/d/Y');
                foreach( $events as $event)
                {
                    $eventdate = $event->getStartDate()->format("m/d/Y");
                    if($d == $eventdate && !in_array($event->getId() , $tracker) && empty($data[$j][$i]))
                    {
                        $event = $this->manageEvent->findEvent($event->getId());
                        $participants = $event->getParticipants();
                        $participants = $this->helper->formatMember($participants);

                        $tracker[] = $event->getId();
                        $data[$j][$i] = array
                        (
                            "event-id" => $event->getId(),
                            "name" => $event->getName(),
                            "capacity" => $event->getCapacity(),
                            "description" => $event->getDescription(),
                            "start-time" => $event->getStartTime()->format("H:i"),
                            "end-time" => $event->getEndTime(),
                            "date" => $event->getStartDate()->format("m/d/Y"),
                            "group-id" => $event->getGroupId(),
                            "participants" => $participants
                        );
                    }
                }; 
            } 
        }
        return $data;
    }

}
