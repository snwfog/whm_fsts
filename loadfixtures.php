<?php

/**
 * Execute this script to empty the database and add sample Data.
 */
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/local-config.php');

use \Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use \Doctrine\Common\DataFixtures\Purger\ORMPurger;
use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;
use \Doctrine\Common\DataFixtures\Loader;

ob_start();

$loader = new Loader();
$loader->loadFromDirectory(__DIR__ . '/tests/fixtures');

$path = array(DOCTRINE_MODEL_PATH);
$dev_mode = $config['dev_mode'];
$dbconfig = $config['dbconfig'];
$config = Setup::createAnnotationMetadataConfiguration($path, $dev_mode);
$em = EntityManager::create($dbconfig, $config);

$purger = new ORMPurger();
$executor = new ORMExecutor($em, $purger);
$executor->execute($loader->getFixtures());

ob_end_clean();

echo "Fixtures loaded successfully! \n";

?>