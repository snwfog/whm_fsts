<?php
/*
The CreateAppointment class will handle the addition of event(s) to a member
*/
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\model\ManageEvent;
use WHM\Controller\Report;
// use WHM\Model\ManageAppointment;

class AppointFulfillment extends WHM\Controller implements WHM\IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    private $manageEvent;
    private $report;

    public function __construct()//array $args = null
    {
        // $this->data = $args;
        parent::__construct();
      //  WHM\Helper::backtrace();
        // $this->manageappointment = new ManageAppointment();
        // $this->manageEvent = new ManageEvent();
        $this ->report = new report();
        $this ->manageEvent= new ManageEvent();

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
        
        $todayEvent = $this ->manageEvent ->getTodaysEvents();
        print_r($todayEvent);
         // $allParticipant = $this->report->getEventParticipants();
        // $allEvents = $this->manageEvent->getAllEventsByGroup();
        // $this->data["allEvents"] = $this->formatEvents($allEvents);



            $this->display("AttendanceAppointFull.twig");  //change

            // $this->display("registrationParticipants.twig");
       
    }

    public function post()
    {
        
    }

    public function put()
    {

    }

    public function delete($data)
    {
      
    }

}
