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
    //    $this->display("member_create_form.twig");
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
