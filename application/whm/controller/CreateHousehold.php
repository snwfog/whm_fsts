<?php

namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\ManageHousehold;
use WHM\Controller\Household;

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

    public function get($household_id = null)
    {
        $data = array(
                       "httpMethod" => "POST",
                       "formAction" => "household/new"
                     );
        //if household id exists then prepopulate field and send to household post function
        if(!is_null($household_id))
        {
            $data = $this->householdController->extractHouseholdInfo($household_id);
            $data["httpMethod"] = "POST";
            $data["formAction"] = 'household/update/' . $household_id;
        }
        $this->data["household"] = $data;
        $this->display("household.create.twig", $this->data);
    }

    public function post()
    {
        if (isset($_POST))
        {
            $this->data["form"] = $_POST;
            $household = $this->manageHouse->createHousehold($_POST);
            $this->redirect('household/' . $household->getId());
        }
        else
        {
            $this->display("household.create.twig");
        }
    }

    public function put()
    {
    }

}
