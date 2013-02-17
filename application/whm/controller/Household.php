<?php

namespace WHM\Controller;

use WHM;

class Household extends WHM\Controller implements WHM\IRedirectable
{
    public function __construct(array $args = null)
    {
        parent::__construct();
        WHM\Helper::backtrace();

    }

    public function get()
    {
        $this->display("household_view_form.twig");
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

   }



}
