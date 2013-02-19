<?php

namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\ManageHousehold;

class CreateHousehold extends Controller implements IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    private $manageHouse;
    private $householdController;
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
      //  WHM\Helper::backtrace();
        $this->manageHouse = new ManageHousehold();
        $this->householdController = new Household();
    }

    public function get()
    {
        $this->display("household_create_form.twig");
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
        if (isset($_POST))
        {
            $this->data["form"] = $_POST;
            $household = $this->manageHouse->createHousehold($_POST);
            $this->householdController->setHousehold($household);
            $this->householdController->get();
        }else{
            $this->display("household_create_form.twig");
        }
    }

}
