<?php
/*
The CreateMember class will handle the addition of member to an existing household.
*/
namespace WHM\Controller;
use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use \WHM\Model\ManageHousehold;

class CreateMember extends WHM\Controller implements WHM\IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    private $manageHousehold;
    private $memberController;

    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //  WHM\Helper::backtrace();
        $this->manageHousehold = new ManageHousehold();
        $this->memberController = new Member();

    }

    public function get()
    {
        $this->data["household"] = array( "household_id" => $_GET["household_id"]);
        $this->display("member.create.twig", $this->data);
    }

    public function post()
    {
        if (isset($_POST))
        {
            $member = $this->manageHousehold->addMember($_POST);
            $this->redirect("household/". $_POST['household-id'] . "/" . $member->getId());
        }else{
            $this->display("member.create.form.twig");
        }

    }

}
