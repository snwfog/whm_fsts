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
        if (in_array("delete", $_GET)) {
            $this->delete($_GET);
        }
    }

    public function post()
    {
        if (isset($_POST))
        {
            $member = $this->manageappointment->addAppointment($_POST['member-id'],$_POST['slot-id']);
            $this->redirect('household/' . $_POST['household-id']."/". $_POST['member-id']);
        }
        else
        {
        
        }
    }

    public function put()
    {

    }

    public function delete($data)
    {
        $member = $this->manageappointment->deleteAppointment($data['member-id'], $data['slot-id']);
        $this->redirect('household/' . $data['household-id']."/". $data['member-id']);
    }

}
