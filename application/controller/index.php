<?php

/*
 * INDEX CONTROLLER / ALSO AS TEMPLATE
 */
class Index_Controller extends Controller_Core implements IRedirectable_Core
{
    public function __construct(array $args = null)
    {
        parent::__construct();

        Helper_Core::backtrace();
    }

    public function get()
    {
        $this->display("index.twig");
    }



}
