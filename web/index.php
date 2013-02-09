<?php

require_once '../App.php';
require_once '../toro.php';

use \Toro;

Toro::serve(array(
    "/" => "Handlers\HelloHandler",
));

?>
