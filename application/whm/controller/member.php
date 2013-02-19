<?php

namespace WHM\Controller;

use \WHM\Helper;
use \WHM\Controller;
use \WHM\IRedirectable;
use \WHM\Model\ManageHousehold;
use \WHM\Model\HouseholdMember;

class Member extends Controller implements IRedirectable
{
    public $data = "ok";
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
      //  Helper_Core::backtrace();
    }

    public function get()
    {
        $houseMember = new HouseholdMember(); 
        $this->data["form"] = $houseMember->getFirstName();        
        $this->display("member_view_form.twig", $this->data);
     //  $this->display("member_create_form.twig");
    }

    public function post()
    {


    }

    public function put()
    {


    }

    public function delete()
    {

    }

}
