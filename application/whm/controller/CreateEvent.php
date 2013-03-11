<?php
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\ManageEvent;
use DateTime;
use DateTimeZone;
use DateInterval;

class CreateEvent extends Controller implements IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    private $manageEvent, $event;
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //WHM\Helper::backtrace();
        $this->manageEvent= new ManageEvent();
        $this->event = new WHM\Controller\Event;
    }

    public function get($template_id = null){
        $this->data["formAction"] = "event/new";

        $templates = $this->manageEvent->getTemplates();
        $this->data["templates"] = $this->event->formatEvents($templates);

        $eventUCs = $this->manageEvent->getUpComingEvents();
        $this->data["upcomingEvents"] = $this->event->formatEvents($eventUCs);

        if(!is_null($template_id)){
           $template = $this->manageEvent->findEvent($template_id);
           $template = $this->event->formatEvents(array( 0 => $template));
           $this->data["template"] = $template[0];        
        }
        $this->display("event.create.twig", $this->data);   
    }

    //Create Event
    public function post()
    {
        //Format Date to be used as object type DateTime
        $start_date = new DateTime();
        $end_date = new DateTime();
        $start_date->setTimezone(new DateTimeZone(LOCALTIME));
        $end_date->setTimezone(new DateTimeZone(LOCALTIME));

        $start_date->setDate("1111", "1", "1");//Default for Template

        if(!isset($_POST["is_template"])){
            $form_start_date = explode("/", $_POST["start-date"]); // $_POST["start-date"] M/D/Y
            $form_end_date = explode("/", $_POST["end-date"]); // $_POST["start-date"] M/D/Y
            $start_date->setDate($form_start_date[2], $form_start_date[0], $form_start_date[1]); //ARG Y/M/D
            $end_date->setDate($form_end_date[2], $form_end_date[0], $form_end_date[1]); //ARG Y/M/D
        }

        //The initial event, every other occurrence of events is based on this event id
        $_POST["start-date"] = $start_date;
        $event = $this->manageEvent->createEvent($_POST);
        $groupId = $event->getId();

        //If there is reoccurence, create event with same group id
        if(isset($_POST["occurrence-type"]) && !isset($_POST["is_template"])){
            $repeat = array(    "daily" => "1 day", 
                                "weekly" => "1 week", 
                                "biweekly" => "2 week", 
                                "monthly" => "1 month", 
                                "bimonthly" => "2 month",
                                "yearly" => "1 year",
            );
            $incrementer = DateInterval::createFromDateString($repeat[$_POST["occurrence-type"]]);
            while($start_date <= $end_date){
                $start_date = $start_date->add($incrementer);
                if($start_date <= $end_date){
                    $_POST["start-date"] = $start_date;
                    $_POST["group-id"] = $groupId;
                    $event = $this->manageEvent->createEvent($_POST);
                }
            }
            $this->redirect('event/'.$groupId);
        }else
        {// Redirect back to creation page with template loaded
            $this->redirect('event/new'. $groupId);
        }       

    }

    public function put()
    {
    }




}
