<?php

require_once 'index.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use WHM\Application;

$em = Application::em();

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));

ConsoleRunner::run($helperSet);


?>
