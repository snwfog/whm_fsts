<?php

namespace WHM\Controller;

use \WHM\Helper;
use \WHM\Controller;
use \WHM\IRedirectable;
use \WHM\Model\ManageHousehold;
use \WHM\Model\HouseholdMember;

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
        $houseMember = new HouseholdMember(); 
        $this->data["form"] = $houseMember->getFirst_name();        
        $this->display("household_view_form.twig", $this->data);
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

   public function delete($household_id)
   {
    $manageHouse = new ManageHousehold();
    $household_id = $manageHouse->getId();
    $manageHouse->removeHousehold($household_id);
   }
}
