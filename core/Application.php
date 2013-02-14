<?php

/**
 * Class Application_Core
 *
 * Main application.
 */
class Application_Core
{
    private $_registry;
    private $_default_libraries = [ 'router' ];
    /**
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
        $libraries = array();

        if (!empty($args))
        {
            $libraries = array_merge($this->_default_libraries, $args);
        }

        foreach ($libraries as $library)
        {
            $klass = ucfirst($library) . "_Core";
            $this->_registry->$library = new $klass;
        }
    }

    public function route($routes)
    {
        Router_Core::route($routes);
    }
}