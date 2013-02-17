<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";
/* require_once "entities/Household.php";
require_once "entities/Flag.php"; */

$paths = array(dirname(__DIR__)."whm_fsts/application/whm/model");
$isDevMode = false;

$con = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'fsts',
);
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$em = EntityManager::create($con, $config);


//$tool = new \Doctrine\ORM\Tools\SchemaTool($em);
//$classes = $em->getMetadataFactory()->getAllMetadata();
//$tool->createSchema($classes);
//$tool->dropSchema($classes);

?>