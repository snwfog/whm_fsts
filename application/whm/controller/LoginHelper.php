<?php

namespace WHM\Controller;

class LoginHelper
{

    public static function beforeHandler($phpSessionStatus)
    {
        return function()
        {
            // Redirect user to homepage if not logged in.
            
            error_log($_SERVER['REQUEST_URI']. ', ' .  session_status());
            
            if($_SERVER['REQUEST_URI'] == '/' && isset($_POST))
            {  
            }
            else
            {               
                session_start();
                error_log($_SESSION['username']);
                if(!isset($_SESSION['username']))
                {
                    header('Location: ' . SITE_ROOT);                    
                }
            }
        };
    }

}

?>
