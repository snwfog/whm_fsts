<?php

require_once('local-config.php');

use \Doctrine\ORM\Tools\Console\ConsoleRunner;
use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;

$path = array(DOCTRINE_MODEL_PATH);
$dev_mode = $config['dev_mode'];
$dbconfig = $config['dbconfig'];

$config = Setup::createAnnotationMetadataConfiguration($path, $dev_mode);
$em = EntityManager::create($dbconfig, $config);

$helperSet = new \Symfony\Component\Console\Helper\HelperSet
(
    array
    (
        'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
        'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
    )
);

ConsoleRunner::run($helperSet);

