<?php

namespace WHM\Controller;
use WHM;
use \WHM\Model\ManageHousehold;

class CreateMember extends WHM\Controller implements WHM\IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
      //  WHM\Helper::backtrace();

    }

    public function get()
    {
        print_r($_GET);
        $this->data = $_GET;
        $this->display("member_create_form.twig",$this->data);
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

        if (isset($_POST))
        {
            $this->data["form"] = $_POST;
            $manageMember = new ManageHousehold();
            $manageMember->addMember($_POST);
            $this->redirect("member");
        }else{
            $this->display("member_create_form.twig");
        }

    }

}
