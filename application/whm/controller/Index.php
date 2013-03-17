<?php

namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Helper;
use WHM\Model\Address;
use WHM\Application;
use WHM\Model\ManageOperator;
use WHM\Model\Session;

/*
 * INDEX CONTROLLER / ALSO AS TEMPLATE
 */

class Index extends Controller implements IRedirectable
{

    protected $data = array("errors" => array(), "form" => array());

    /**
     * @var ManageOperator
     */
    protected $manageOperator;

    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();

        $this->manageOperator = new ManageOperator();
    }

    public function get()
    {
        $this->display("index.twig");
    }

    public function post()
    {
        if (isset($_POST))
        {
            $user = $this->manageOperator->findOperator($_POST["username"], $_POST["inputPassword"]);

            if ($user)
            {
                Session::logIn($_POST["username"]);                
                $this->redirect('household/new');
            } 
            else
            {
                $this->display("Login.error.twig");
            }
        } else
        {
            $this->display("Login.error.twig");
        }
    }

}
