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

        $content = "charles=yang&mike=pham";
        file_put_contents("php://output", $content);
        $var = null;
        echo "before marker";
        $unparsed = file_get_contents("php://input");
        echo $unparsed."unique<br>";

        echo $unparsed."secondtime<br>";
        parse_str($unparsed, $var);
        print_r($var);

    }

    public function post()
    {
        echo "This is a post";
    }
}
