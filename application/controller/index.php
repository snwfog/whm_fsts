<?php

/*
 * INDEX CONTROLLER / ALSO AS TEMPLATE
 */
class Index_Controller extends Controller_Core
{
    public function __construct(array $args = null)
    {
        Helper_Core::backtrace();
    }

    public function get()
    {
        echo "In get";
    }



}
