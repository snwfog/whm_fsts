<?php
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\ManageEvent;
use DateTime;
use DateTimeZone;

class Reports extends Controller implements IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //WHM\Helper::backtrace();
    }

    public function get($event_id = null)
    {     
            $this->display("report.stat.twig", $this->data);               
    }

    // Update Event
    public function post()
	{
     

    }

}