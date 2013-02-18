<?php

namespace WHM\Controller;

use \WHM\Helper;
use \WHM\Controller;
use \WHM\IRedirectable;

class Household extends Controller implements IRedirectable
{
    public $data = array( "errors" => array(), "form" => array());
    private $household;

    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //Helper::backtrace();

    }

    public function get()
    {
        $newhousehold = $this->household;
        $this->display("household_view_form.twig");
       // $this->display("household_create_form.twig");
    }

    public function put()
    {

        $content = "charles=yang&mike=pham";
        file_put_contents("php://output", $content);
        $var = null;
        echo "before marker";
        $unparsed = file_get_contents("php://input");
        echo $unparsed."unique<br>";

        echo $unparsed."secondtime<br>";
        parse_str($unparsed, $var);
        print_r($var);

    }

   public function post()
   {

   }


   public function setHousehold($household){
       $this->household = $household;
   }



}
