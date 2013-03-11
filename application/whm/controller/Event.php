<?php
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\ManageEvent;

class Event extends Controller implements IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    private $manageEvent;
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //WHM\Helper::backtrace();
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
            $relatedEvents = $this->manageEvent->getRelatedEvents($event->getGroupId(), $event->getId());

            $relatedEvents = $this->formatEvents($relatedEvents);
            $event = $this->formatEvents(array( 0 => $event));
            
            $this->data["event"] = $event[0];
            $this->data["relatedEvents"] = $relatedEvents;
            $this->display("event.create.twig", $this->data);      
        }else
        {    //Get templates if new event
            $createEvent = new WHM\Controller\CreateEvent;
            $createEvent->get();
        } 
                   
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
                    "start-time" => $event->getStartTime(),
                    "end-time" => $event->getEndTime(),
                    "date" => $event->getStartDate()->format("d/m/Y"),
                    "group-id" => $event->getGroupId(),
                );
        }
        return $data;      
    }

    public function getIndexedEvents($events)
    {
        $data = array();
        $tracker = array(); 

        for ($j = 1; $j <= 10; $j++)  // 5 rows for now...
        {
            $date = date_create('now');
            for ($i = 1; $i <= 14; $i++)
            {   
                date_modify($date, '+1 day');
                $d = date_format($date, 'd/m/Y');
                foreach( $events as $event)
                {
                    $eventdate = $event->getStartDate()->format("d/m/Y");
                    if($d == $eventdate && !in_array($event->getId() , $tracker) && empty($data[$j][$i]))
                    {
                        $tracker[] = $event->getId();
                        $data[$j][$i] = array
                        (
                            "event-id" => $event->getId(),
                            "name" => $event->getName(),
                            "capacity" => $event->getCapacity(),
                            "description" => $event->getDescription(),
                            "start-time" => $event->getStartTime(),
                            "end-time" => $event->getEndTime(),
                            "date" => $event->getStartDate()->format("d/m/Y"),
                            "group-id" => $event->getGroupId()
                        );
                    }
                }; 
            } 
        }
        return $data;
    }

}
