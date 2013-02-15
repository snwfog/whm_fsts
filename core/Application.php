<?php

/*
 * Application
 *
 * @description: Main application.
 */
class Application_Core
{
    private $_registry;

    /*
     * CONSTRUCTOR
     *
     * Application constructor, will autoload all core singleton class.
     * Application also provide an adapter to all routing.
     *
     * @param array $libraries
     */
    public function __construct($args)
    {
        // Define the Application class registry
        $this->_registry = Registry_Core::get_instance();

    }

    public function route($routes)
    {
        Router_Core::route($routes);
    }
}