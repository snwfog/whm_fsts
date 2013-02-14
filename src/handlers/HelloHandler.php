<?php

namespace Handlers;

use \App;

class HelloHandler {

    function get() {

        echo App::get('twig')->render('hello.html.twig', array('name' => 'world')) . "<br />";

        //$product = App::get('em')->find('Models\Product', 1);
        echo $product->name;
    }
}

