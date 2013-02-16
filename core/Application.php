<?php

/*
 * Application
 *
 * @description: Main application.
 */
class Application_Core
{
    private $_registry;
    private $_default_config = array();

    /*
     * CONSTRUCTOR
     *
     * Application constructor, will autoload all core singleton class.
     * Application also provide an adapter to all routing.
     *
     * @param array $libraries
     */
    public function __construct($config)
    {
        $this->_default_config = array_merge($this->_default_config, $config);

        // Define Doctrine information...


    }

    public function route($routes)
    {
        Router_Core::route($routes);
    }
}