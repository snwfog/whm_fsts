<?php

namespace WHM\Model;

use WHM\Application;

class ManageOperator
{

    private $em;

    public function __construct()
    {
        $this->em = Application::em();
    }

    public function findOperator($username, $password)
    {
        $query = $this->em->createQuery('SELECT u FROM WHM\Model\Operator u 
                                         WHERE u.username= :name AND u.password= :pass');
        $query->setParameter('name', $username);
        $query->setParameter('pass', hash('sha256', $password . '|' .$username));
        return $query->getResult();
    }

}

?>
