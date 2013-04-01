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

        $allEvents = $this->manageEvent->getAllEventsByGroup();
        $this->data["allEvents"] = $this->event->formatEvents($allEvents);

        if(!is_null($template_id)){
           $template = $this->manageEvent->findEvent($template_id);
           $timeslots = $this->getSlots($template);

           $template = $this->event->formatEvents(array( 0 => $template));
           $this->data["currentTemplate"] = $template[0];
           $this->data["timeslots"] = $timeslots;        
        }
        $this->display("event.create.twig", $this->data);   
    }

    //Create Event
    public function post()
    {
        //Format Date to be used as object type DateTime
        $start_date = new DateTime();
        $start_date->setTimezone(new DateTimeZone(LOCALTIME));
        $end_date = new DateTime();
        $end_date->setTimezone(new DateTimeZone(LOCALTIME));
        $start_time = new DateTime();
        $start_time->setTimezone(new DateTimeZone(LOCALTIME));


        $start_date->setDate("1111", "1", "1");//Default for Template

        //For both template and event, start-time must exist
        if( !empty($_POST["start-time"]) ){
            $form_start_time = explode(":", $_POST["start-time"]);
            $start_time->setTime($form_start_time[0], $form_start_time[1]);
        }else{
            return $this->redirect('event');
        }

        //If is not template then start-date and end-date must not be empty
        if(!isset($_POST["is_template"])){
            if(!empty($_POST["start-date"])){
                $form_start_date = explode("/", $_POST["start-date"]); // $_POST["start-date"] M/D/Y
                $start_date->setDate($form_start_date[2], $form_start_date[0], $form_start_date[1]); //ARG Y/M/D          
            }else{
                return $this->redirect('event');
            }
        }

        //The initial event, every other occurrence of events is based on this event id
        $_POST["start-date"] = $start_date;
        $_POST["start-time"] = $start_time;
        $event = $this->manageEvent->createEvent($_POST);
        $this->createTimeslots($event, $_POST);

        //If group-id exist then it is adding date to an existing event group
        if(isset($_POST["group-id"])){
            $groupId = $_POST["group-id"];
        }else{
            $groupId = $event->getId();
        }

        //If there is reoccurence, create event with same group id
        if(!isset($_POST["is_template"]) && !empty($_POST["end-date"]) && isset($_POST["occurrence-type"])){

            $form_end_date = explode("/", $_POST["end-date"]); // $_POST["start-date"] M/D/Y
            $end_date->setDate($form_end_date[2], $form_end_date[0], $form_end_date[1]); //ARG Y/M/D

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
                    $this->createTimeslots($event, $_POST);
                }
            }
        }

        $this->redirect(isset($groupId) ? 'event/'.$groupId : 'event/');
              

    }

    public function put()
    {
    }

    private function createTimeslots($event, $timeslots){
        if(isset($timeslots["slot-name"]) && isset($timeslots["slot-duration"]) && isset($timeslots["slot-capacity"])){
            $slot_name = $timeslots["slot-name"];
            $slot_duration = $timeslots["slot-duration"];
            $slot_capacity = $timeslots["slot-capacity"];

            if( count($slot_name) > 0 && count($slot_duration) > 0 && count($slot_capacity) > 0){
                if( count($slot_name) == count($slot_duration) && count($slot_duration) == count($slot_capacity)){
                    for ($i = 0; $i < count($slot_name); $i++){
                        $data = array(
                                        "slot-name" => $slot_name[$i],
                                        "slot-duration" => $slot_duration[$i],
                                        "slot-capacity" => $slot_capacity[$i],
                                );

                        if(empty($slot_name[$i])){
                            $eventslots = $event->getTimeslots();
                            $num = count($eventslots) + 1;
                            $data["slot-name"] = "Timeslot #".$num;
                        }


                        $this->manageEvent->createTimeslot($event, $data);
                    }
                }
            }
        }
    }



    public function getSlots($event)
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

            $timeslots[$count] = array
            (
                "id" => $t->getId(),
                "name" => $t->getName(),
                "duration" => $t->getDuration(),
                "capacity" => $t->getCapacity(),
                "start-time" => $slotStarttime,
                "end-time" => $endtime
            );
            $slotStarttime = $endtime;
            ++$count;
        }
        return $timeslots;
    }




}
