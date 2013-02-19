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
        $this->display("household.create.twig");
    }

    public function post()
    {
        if (isset($_POST))
        {
            $this->data["form"] = $_POST;
            $household = $this->manageHouse->createHousehold($_POST);
            //$this->householdController->setHousehold($household);
            $this->redirect((string)$household->getId());
        }else{
            $this->display("household.create.twig");
        }
    }

}
