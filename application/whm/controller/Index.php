<?php

namespace WHM\Controller;

use WHM;
/*
 * INDEX CONTROLLER / ALSO AS TEMPLATE
 */
class Index extends WHM\Controller implements WHM\IRedirectable
{
    public function __construct(array $args = null)
    {
        parent::__construct();

        WHM\Helper::backtrace();
    }

    public function get()
    {
//        $this->display("index.twig");
        echo "We are in get from index";
    }



}
