<?php

namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Helper;
use WHM\Model\Address;
use WHM\Application;
use WHM\Model\LogIn;
/*
 * INDEX CONTROLLER / ALSO AS TEMPLATE
 */
class Index extends Controller implements IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    protected $logIn;
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        $this->logIn = new LogIn();
    }

    public function get()
    {
        $this->display("index.twig");
    }
    public function post()
    {
        if (isset($_POST))
        {
            $user=$this->logIn->findOperator($_POST["username"], $_POST["inputPassword"]);
            if($user)          
                $this->redirect('household/new');
            else
                $this->display("Login.error.twig");
        }
        else
        {
            $this->display("Login.error.twig");
        }
    }
}
