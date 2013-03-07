<?php

namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Controller\Household;
use WHM\Model\HouseholdMember;
use WHM\Model\ManageFlag;


class Flag extends Controller implements IRedirectable
{

     protected $data = array("errors" => array(), "form" => array());
     private $mflag;
 
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
      //  WHM\Helper::backtrace();
        $this->mflag = new ManageFlag();


         // Check delete comment
        if (isset($args['delete_flag']))
            $this->delete($args['delete_flag']);
   
    }

    public function get()
    {

        $this->display("addflag.modal.twig");
    }

    public function post()
    {
        if (isset($_POST))
        {
            $flag = $this->mflag->createFlag($_POST);         
            $this->redirect("/household/" . $_POST["household-id"] . "/" . $_POST["member-id"]);
        }
        else
        {
            $this->display("addflag.modal.twig");
        }
        
    }

    public function put()
    {
    }

    public function delete($id)
    {
        $this->mflag->deleteFlag($id);
        $this->redirect("/household/" . $_POST["household-id"] . "/" . $_POST["member-id"]);

    }


}