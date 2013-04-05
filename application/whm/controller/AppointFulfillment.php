<?php
/*
The CreateAppointment class will handle the addition of event(s) to a member
*/
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\ManageEvent;
use WHM\Controller\Report;
use WHM\Controller\Event;
use WHM\Model\ManageAppointment;
use WHM\ParticipantsTimeslots;
use WHM\Controller\ControllerHelper;
use DateTime;

class AppointFulfillment extends WHM\Controller implements WHM\IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    private $manageEvent;
    private $report;
    private $event;
    private $manageAppointment;

    public function __construct()//array $args = null
    {
        // $this->data = $args;
        parent::__construct();
      //  WHM\Helper::backtrace();
        // $this->manageappointment = new ManageAppointment();
        // $this->manageEvent = new ManageEvent();
        $this ->report = new report();
        $this ->manageEvent= new ManageEvent();
        $this ->event= new Event();
        $this ->manageAppointment = new ManageAppointment();

    }

    public function get()
    {

        $todaysEvents = $this ->manageEvent ->getTodaysEvents();  

        $slotEvent = array();

       foreach($todaysEvents as $te)
       {
            $slotEvent[] = (array(
                'name' => $te->getName(),
                'id'   => $te->getId(),
             ));
       }

        //------------------------------------------------------------
        //$event_id = null, $timeslot_id = null
        // if(!is_null($event_id))
        // {
        //     $slot = array();
        //     $count = 0;
        //     $totalNumOfParticipants = 0;
        //     $totalEventCapacity = 0;
        //     $event = $this->manageEvent->findEvent($event_id);
        //     $slotStarttime = $event->getStartTime()->format("H:i");
            
        //     $timeslots = $event->getTimeSlots();
        //     foreach($timeslots as $timeslot)
        //     {

        //         $slotEndtime = new DateTime($slotStarttime);
        //         $duration = '+'.$timeslot->getDuration(). ' mins';
        //         date_modify($slotEndtime, $duration);
        //         $endtime = $slotEndtime->format('H:i');
        //         if($timeslot->getId() == $timeslot_id)
        //         {
        //             $slot = array
        //             (
        //                 "name"=> $timeslot->getName(),
        //                 "startTime"=> $slotStarttime,
        //                 "endTime"=> $endtime,
        //                 "duration" => $timeslot->getDuration(),
        //                 "participants" => ControllerHelper::formatMember($timeslot->getParticipants()),
        //                 "id" => $timeslot->getId(),
        //                 "capacity" => $timeslot->getCapacity()
        //             );
        //         }
        //             $slotStarttime = $endtime;
        //             $totalNumOfParticipants += count($slot["participants"]);
        //             $totalEventCapacity += $slot["capacity"];
        //             ++$count;
        //     }
        //     foreach ($slot["participants"] as $key=>$participant)
        //     {
        //         $pId = $participant["member-id"];
        //         $participantTimeslot = $this->manageAppointment->getParticipantTimeslot($pId, $slot['id']);
        //         $attendance = (int) $participantTimeslot->getAttend();
        //         $participant["attend"] = $attendance;
        //         $slot["participants"][$key] = $participant;
        //     }
        //     $event = $this->event->formatEvents(array( 0 => $event));
        //     $event[0]["totalCapacity"] = $totalEventCapacity;
        //     $event[0]["numOfParticipants"] = $totalNumOfParticipants;
        //     $this->data['slot'] = $slot;
        //     $this->data['event'] = $event[0];
        //    // $this->data['event'] = $event;
        //     $this->display("attendance.appoint.full.twig");
        // }   
        //--------------------------------------------------------------
        $this->data['slotEvents'] = $slotEvent;
        $this->display("event.for.today.list.twig");


     
       
    }

    public function post()
    {
        print_r($_POST);
        $this->manageEvent->updateAttendance($_POST["slot-id"], $_POST["member-id"], $_POST["attendance"]);
    }

    public function put()
    {

    }

    public function delete($data)
    {
      
    }
    

}
