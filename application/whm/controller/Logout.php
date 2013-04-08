<?php

namespace WHM\Controller;

use WHM\Controller;
use \WHM\IRedirectable;
use WHM\Model\Session;

class Logout extends Controller implements IRedirectable
{
    public function get()
    {        
        session_destroy();
        $this->redirect("/");
    }
}

?>
