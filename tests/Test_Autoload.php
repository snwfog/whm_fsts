<?php

function __autoload_test($name)
{

    list($filename, $suffix, $test) = explode('_', strtolower($name));

    $filepath = "tests/{$suffix}/" . ucfirst($filename) . ucfirst($suffix) . "Test.php";

    if (file_exists($filepath))
    {
        include_once($filepath);
    }
    else
    {
        // header('Location: ' . Controller::REDIRECT_ERROR);
        exit("File '$filepath' containing class '$name' could not be located by the autoload function.");
    }
}

spl_autoload_register('__autoload_test');
