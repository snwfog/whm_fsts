<?php

class Member_Controller extends Controller_Core implements IRedirectable_Core
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
