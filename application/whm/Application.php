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
use Twig_Environment;
use Twig_Loader_Filesystem;

class Application
{
    private static $_registry = array();
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

        if (!isset(self::$_registry['em'])) self::$_registry['em'] = $em;

        // Define Twig information...
        $twig_instance = new Twig_Environment
        (
            new Twig_Loader_Filesystem(TWIG_VIEW_PATH),
            $this->_default_config['twig_config']
        );

        if (!isset(self::$_registry['twig'])) self::$_registry['twig'] = $twig_instance;
    }

    public static function em() { return self::$_registry['em']; }
    public static function twig() { return self::$_registry['twig']; }
    public static function route($routes) { Router::route($routes); }
}