<?php

class Household_Contoller extends Controller_Core implements IRedirectable_Core
{
    public function __construct(array $args = null)
    {
        parent::__construct();
        
        Helper_Core::backtrace();
    }

    public function get()
    {
        echo "hi";

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