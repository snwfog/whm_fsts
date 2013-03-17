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

    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
    }

    public function get()
    {
        $this->display("index.twig");
    }

}
