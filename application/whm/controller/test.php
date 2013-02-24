<?php

namespace WHM\Controller;

use WHM\Controller;
use WHM\IRedirectable;
use WHM\Helper;

class Test extends Controller implements IRedirectable
{
    public function __construct(array $args = null)
    {
        parent::__construct();
        Helper::backtrace();
    }

    public function get()
    {
        $this->display("household_view_form.twig");
    }

    public function put()
    {

    }

    public function post()
    {
        $this->post_call($_POST["b"], $_POST["c"]);
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
