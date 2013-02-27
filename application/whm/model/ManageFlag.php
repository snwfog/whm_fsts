<?php
namespace WHM\Model;
use WHM;
use WHM\Application;
use \WHM\Model\Flag;
use \WHM\Model\FlagDescriptor;
/**
 * Manage entity household
 **/
class ManageFlag 
{
    private $em;

    public function __construct()
    {
        $this->em = Application::em();
    }

     public function createFlag($data)
    {

        $flag = new Flag();
        $flag->setMessage($data["message"]);
        

       
        $this->em->persist($flag);
        $this->em->flush();

        return $flag;

    }

}