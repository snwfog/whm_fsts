<?php

class Household_Contoller extends Controller_Core implements IRedirectable_Core
{
    echo "bitch";
    public function __construct(array $args = null)
    {
        parent::__construct();
        echo "k";
        Helper_Core::backtrace();
    }

    public function get()
    {
        echo "I'm in";
        echo $this->data;

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