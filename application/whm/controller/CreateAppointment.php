<?php
/*
The CreateAppointment class will handle the addition of event(s) to a member
*/
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\Appointment;

class CreateAppointment extends WHM\Controller implements WHM\IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    private $appointment;

    public function __construct()//array $args = null
    {
        // $this->data = $args;
        parent::__construct();
      //  WHM\Helper::backtrace();
        $this->appointment = new Appointment();
    }

    public function get($member_id)
    {
        echo $member_id;
        $this->data["household"] = array("member_id" => $member_id);
        $this->display("appointment.modal.twig", $this->data);

    }

    public function post()
    {
        print_r( $_POST);
        if (isset($_POST))
        {
             // $member = $this->appointment->addMember($_POST);
        }
        else
        {
        
        }
    }

    public function put()
    {

    }

}
