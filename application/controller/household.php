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
        echo "string"; 
        print_r($this->data);
        

    }

    public function put()
    {

    }

    public function post()
    {

    }

    public function delete()
    {

    }
} 



?>