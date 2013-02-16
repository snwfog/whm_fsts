<?php

class Household_Controller extends Controller_Core implements IRedirectable_Core
{
    public $data = "ok";    
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        Helper_Core::backtrace();
    }

    public function get()
    {
        $this->display("household_create_form.twig");
    }

    public function post()
    {
    
        print_r($_POST);
        echo $_POST["first_name"];

     //   $house_model = new HouseholdMember();
       // $house_model->create()
    }

    public function put()
    {


    }

    public function delete()
    {

    }

}

