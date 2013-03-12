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
        $this->display("household.create.twig");
    }

    public function post()
    {
        if (isset($_POST))
        {
            $this->data["form"] = $_POST;
            $household = $this->manageHouse->createHousehold($_POST);
            $pMember = $household->getHouseholdPrincipal();

            $this->redirect('household/' . $household->getId()."/". $pMember->getId());

        }
        else
        {
            $this->display("household.create.twig");
        }
    }

    public function put()
    {
    }

     public function delete()
    {
        print_r($_DELETE);
        /*
        if(isset($_DELETE))
        {
            $dflag = $this->mflag->deleteFlag($_DELETE);
            $this->redirect("/household/" . $_POST["household-id"] . "/" . $_POST["member-id"]);
        }*/
    }


}
