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


        $this->data['slotEvents'] = $slotEvent;
        $this->display("event.for.today.list.twig");


     
       
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
