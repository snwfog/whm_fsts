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
        $this->data["formAction"] = "event/new";
        $eventUCs = $this->manageEvent->getUpComingEvents();
        $this->data["upcoming-events"] = $this->formatEvents($eventUCs);

        if(!is_null($event_id)){
            $this->data["formAction"] = "event";
            $event = $this->manageEvent->findEvent($event_id);
            $event = array( 0 => $event);
            $event = $this->formatEvents($event);
            $this->data["event"] = $event[0];
        } 
        $this->display("event.create.twig", $this->data);                  
    }





    private function formatEvents($events)
    {
        $data = array();
        $count = 0;
        foreach( $events as $event){
            $data[$count++] = array
            (
                "event-id" => $event->getId(),
                "name" => $event->getName(),
                "capacity" => $event->getCapacity(),
                "description" => $event->getDescription(),
                "start-time" => $event->getStartTime(),
                "end-time" => $event->getEndTime(),
                "date" => $event->getStartDate()->format("d/m/Y"),
            );
        }
        return $data;      
    }

}
