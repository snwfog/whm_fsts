<?php

namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Helper;
use WHM\Model\Address;
use WHM\Application;

/*
 * INDEX CONTROLLER / ALSO AS TEMPLATE
 */
class Index extends Controller implements IRedirectable
{
    public function __construct(array $args = null)
    {
        parent::__construct();

        $this->data['index'] = true;
    }

    public function get()
    {
        $this->display("index.twig", $this->data);
    }
}
