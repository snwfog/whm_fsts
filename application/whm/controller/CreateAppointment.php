<?php
/*
The CreateAppointment class will handle the addition of event(s) to a member
*/
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\ManageAppointment;

class CreateAppointment extends WHM\Controller implements WHM\IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    private $manageappointment;

    public function __construct()//array $args = null
    {
        // $this->data = $args;
        parent::__construct();
      //  WHM\Helper::backtrace();
        $this->manageappointment = new ManageAppointment();
    }

    public function get($member_id = null)//url
    {
        if (in_array("create", $_GET)) {
            $events = $this->manageappointment->getEvents();
            $this->data["household"] = array("member_id" => $member_id);
            // $this->data["events"] = $events;
            // print_r($this->data);
            $this->display("appointment.twig", $this->data);
        }
        if (in_array("remove", $_GET)) {
            $this->data["household"] = array("member_id" => $member_id);
            $this->display("removeAppointment.twig", $this->data);
        }
        if (in_array("delete", $_GET)) {
            $this->delete($_GET);
        }
    }

    public function post()
    {
        if (isset($_POST))
        {
            $member = $this->manageappointment->addAppointment($_POST['member-id'], $_POST['event-id']);
            echo "Appointment " . $_POST['event-id'] . " added to member " .  $_POST['member-id'];
        }
        else
        {
        
        }
    }

    public function put()
    {

    }

    public function delete($_GET)
    {
        $member = $this->manageappointment->deleteAppointment($_GET['member-id'], $_GET['event-id']);
        echo "Appointment " . $_GET['event-id'] . " sucessfully removed from member " .  $_GET['member-id'];
    }

}
