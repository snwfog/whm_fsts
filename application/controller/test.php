<?php

class Test_Controller extends Controller_Core implements IRedirectable_Core
{
    public function __construct(array $args = null)
    {
        parent::__construct();   
        Helper_Core::backtrace();
    }

    public function get()
    {
    }

    public function put()
    {

    }

    public function post()
    {
        $this->post_call($_POST["b"],$_POST["c"]);
    }

    public function delete()
    {

    }



    public function post_call($arg1, $arg2)
    {
        return "a";
    }
} 



?>