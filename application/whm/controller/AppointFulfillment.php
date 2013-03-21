<?php
/*
The CreateAppointment class will handle the addition of event(s) to a member
*/
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
// use WHM\Model\ManageAppointment;

class AppointFulfillment extends WHM\Controller implements WHM\IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    // private $manageappointment;

    public function __construct()//array $args = null
    {
        // $this->data = $args;
        parent::__construct();
      //  WHM\Helper::backtrace();
        // $this->manageappointment = new ManageAppointment();
    }

    public function get()
    {
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
