<?php

namespace WHM\Controller;

use \WHM\Helper;
use \WHM\Controller;
use \WHM\IRedirectable;

class Household extends Controller implements IRedirectable
{
    public $data = array( "errors" => array(), "form" => array());

    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //Helper::backtrace();

    }

    public function get()
    {
        $manageHouse = new ManageHousehold(); 

        $this->data["form"] = $manageHouse->getFirstName();        
        $this->display("household_view_form.twig", $data);
     
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


   public function delete($household_id)
   {


    $manageHouse = new ManageHousehold();
    //$household_id = $manageHouse->setHousehold();
    $manageHouse->removeHousehold($household_id);
   }


}
