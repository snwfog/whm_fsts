<?php
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\ManageEvent;
use DateTime;
use DateInterval;

class CreateEvent extends Controller implements IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    private $manageEvent;
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //WHM\Helper::backtrace();
        $this->manageEvent= new ManageEvent();
    }

    public function get()
    {
        $this->display("event.create.twig");
    }

    //Create Event
    public function post()
    {
        //Format Date to be used as object type DateTime
        $form_start_date = explode("/", $_POST["start-date"]); // $_POST["start-date"] M/D/Y
        $form_end_date = explode("/", $_POST["end-date"]); // $_POST["start-date"] M/D/Y
        $start_date = new DateTime();
        $end_date = new DateTime();
        $start_date->setDate($form_start_date[2], $form_start_date[0], $form_start_date[1]); //ARG Y/M/D
        $end_date->setDate($form_end_date[2], $form_end_date[0], $form_end_date[1]); //ARG Y/M/D

        $_POST["start-date"] = $start_date;
        $event = $this->manageEvent->createEvent($_POST);

        //If there is reoccurence, create event with same group id
        if(isset($_POST["occurrence-type"]) && !isset($_POST["is_template"])){
            $groupId = $event->getId();
            $repeat = array(    "daily" => "1 day", 
                                "weekly" => "1 week", 
                                "biweekly" => "2 week", 
                                "monthly" => "1 month", 
                                "bimonthly" => "2 month",
                                "yearly" => "1 year",
            );
            $incrementer = DateInterval::createFromDateString($repeat[$_POST["occurrence-type"]]);
            while($start_date <= $end_date){
                $start_date = $start_date->add($incrementer);
                if($start_date <= $end_date){
                    $_POST["start-date"] = $start_date;
                    $_POST["group-id"] = $groupId;
                    $event = $this->manageEvent->createEvent($_POST);
                }
            }
        }

    }

    public function put()
    {
    }

}
