<?php

namespace WHM\Controller;

use WHM\Model\Session;

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
                if(!Session::isLoggedIn())
                {
                    header('Location: ' . SITE_ROOT);                    
                }
            }
        };
    }

}

?>
