<?php

class LoginHelper
{

    public static function beforeHandler()
    {
        header('Location: ' . SITE_ROOT . '/');    
    }

}

?>
