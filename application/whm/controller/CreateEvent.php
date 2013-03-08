<?php
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\Event;

class CreateEvent extends Controller implements IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    private $eventModel;
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //WHM\Helper::backtrace();
        $this->eventModel = new Event();
    }

    public function get()
    {
        $this->display("event.create.twig");
    }

    //Create Event
    public function post()
    {
        print_r($_POST);

    }

    public function put()
    {
    }

}
