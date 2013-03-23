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
use WHM\Controller\Event;
// use WHM\Model\ManageAppointment;

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


        foreach($todayEvents as $td)
        {
            foreach($td->getTimeslots() as $timeslot)
            {

                foreach ($timeslot->getParticipantsToday() as $participants) 
                {       
                    
                     print_r($participants->getHouseholdMember()->getLastName()." ".
                        $participants->getHouseholdMember()->getFirstName());
                                
                }
            }

        }

        //$eventsT=$this->event->formatTodaysEventsDetail($todayEvents);

       // print_r($eventsT);
        
        

            $this->data['todayEvents'] = $todayEvents;
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
