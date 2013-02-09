<?php

require_once('App.php');

use \App;

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$em = App::get('em');

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));

ConsoleRunner::run($helperSet);


?>
