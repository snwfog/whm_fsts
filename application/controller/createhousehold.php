<?php

class CreateHousehold_Controller extends Controller_Core implements IRedirectable_Core
{
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        Helper_Core::backtrace();

    }

    public function get($args = null)
    {
        $this->display("household_create_form.twig");
    }
    

}
