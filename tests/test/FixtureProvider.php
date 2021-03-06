<?php

namespace Test;

require_once(__DIR__ . '/../../vendor/autoload.php');

use \Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use \Doctrine\Common\DataFixtures\Purger\ORMPurger;
use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;
use \Doctrine\Common\DataFixtures\Loader;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;

/**
 * Helper class to load the fixtures located in the /tests/fixtures folder
 * to populate the database with sample data.
 */
class FixtureProvider
{

    public static function load()
    {
        ob_start();

        $loader = new Loader();
        $loader->loadFromDirectory(__DIR__ . '/../fixtures');

        $config = require(__DIR__ . '/../../local-config.php');
        $path = array(DOCTRINE_MODEL_PATH);
        $dev_mode = $config['dev_mode'];
        $dbconfig = $config['dbconfig'];
        $config = Setup::createAnnotationMetadataConfiguration($path, $dev_mode);
        $em = EntityManager::create($dbconfig, $config);

        // Droping then recreating the database
        $tool = new SchemaTool($em);
        $classes = $em->getMetadataFactory()->getAllMetadata();

        // Droping then Recreating the database schema.
        $tool->dropSchema($classes);
        $tool->createSchema($classes);

        // Loading the fixtures insice the database
        $purger = new ORMPurger();
        $executor = new ORMExecutor($em, $purger);
        $executor->execute($loader->getFixtures());

        ob_end_clean();
    }

}

