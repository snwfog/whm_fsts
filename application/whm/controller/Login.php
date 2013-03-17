<?php

namespace WHM\Controller;

class Login
{

    public static function beforeHandler()
    {
        return function()
        {
            // Redirect user to homepage if not logged in.
            
            if($_SERVER['REQUEST_URI'] == FOLDER_URL && isset($_POST))
            {  
                // do nothing
            }
            else
            {               
                session_start();
                if(!isset($_SESSION['sessID']) || $_SESSION['sessID'] != session_id())
                {
                    header('Location: ' . SITE_ROOT);                    
                }
            }
        };
    }

}

?>
