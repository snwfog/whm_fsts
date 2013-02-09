<?php

require_once 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class App
{
    /**
     * Singleton instance
     *
     * @var type
     */
    protected static $_instance = null;

    private $component ;

    private function __construct()
    {
        $this->components = array();

        /* Configuring Doctrine ORM */
        $paths = array("src/models");
        $isDevMode = false;
        $dbParams = require_once 'dbParams.php';
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $this->component['em'] = EntityManager::create($dbParams, $config);

        /* Configuring Twig */
        $loader = new Twig_Loader_Filesystem( __DIR__. '/src/views');
        $this->component['twig'] = new Twig_Environment($loader);
    }

    public static function get($key)
    {
        if(self::$_instance == null)
        {
            self::$_instance = new App();
        }

        return self::$_instance->component[$key];
    }
}

?>
