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

    public function put()
    {
        echo " i'm in put";

    }

    public function post()
    {
        print_r($_POST);
    }

    public function delete()
    {

    }
} 



?>