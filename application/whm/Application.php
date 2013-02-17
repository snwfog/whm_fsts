<?php

namespace WHM;

/*
 * Application
 *
 * @description: Main application.
 */

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;

class Application
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

        $doctrine_config = Setup::createAnnotationMetadataConfiguration
            (array(DOCTRINE_MODEL_PATH), $this->_default_config['dev_mode']);

        $em = EntityManager::create($this->_default_config['dbconfig'],
            $doctrine_config);
    }

    public function route($routes)
    {
        Router::route($routes);
    }
}