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


class AppointFulfillment extends WHM\Controller implements WHM\IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    private $manageEvent;
    private $report;
    private $event;

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

    }

    public function get($event_id = null)
    {
        // if (isset($_GET["event_id"]))
        // {
        //     $event_id = $_GET["event_id"];
            
        // }

        // if(!is_null($event_id))
        // {
            




        // }
        

        $todayEvents = $this ->manageEvent ->getTodaysEvents();        


        // foreach($todayEvents as $td)
        // {

        //     foreach($td->getTimeslots() as $timeslot)
        //     {

        //         foreach ($timeslot->getParticipantsToday() as $participants) 
        //         {

                   
        //              echo($participants->getHouseholdMember()->getLastName()." ".
        //                 $participants->getHouseholdMember()->getFirstName());
                                
        //         }
        //     }

        // }

        $eventsT=$this->event->formatEvents($todayEvents);        
        

            $this->data['todayEvents'] = $todayEvents;
            
            $this->display("AttendanceAppointFull.twig");  

        //$data = array(

          //      "events"        =>  $eventsT

            //);

        //$this->display("AttendanceAppointFull.twig", $data);

     
       
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
