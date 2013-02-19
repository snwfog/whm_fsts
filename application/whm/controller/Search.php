<?php

class Household extends Controller implements IRedirectable
{
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //Helper::backtrace();

    }

    public function get()
    {        
        $this->display("household_view_form.twig", $this->data);
    }



    public function put()
    {

    }

   public function post()
   {

   }

}

?>