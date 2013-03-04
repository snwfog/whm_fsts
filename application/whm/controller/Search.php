<?php

namespace WHM\Controller;

use \WHM\Helper;
use \WHM\Controller;
use \WHM\IRedirectable;
use \WHM\Model\ManageHousehold;
use \WHM\Model\HouseholdMember;

class Search extends Controller implements IRedirectable
{
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //Helper::backtrace();

    }

    public function get()
    {        
        $this->display("search_view.twig");
    }

    public function put()
    {

    }

   public function post()
   { 
        if (isset($_POST))
        {
            $this->redirect("household/" . $_POST["household-id"]);
        }
        else
        {

        }
   }

}