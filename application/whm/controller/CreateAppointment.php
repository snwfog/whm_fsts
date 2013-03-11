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
            $this->data["household"] = array("member_id" => $member_id);
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
            $this->redirect('household/' . $_POST['household-id']."/". $_POST['member-id']);
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
