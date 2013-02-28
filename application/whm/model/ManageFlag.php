<?php
namespace WHM\Model;
use WHM;
use WHM\Application;
use \WHM\Model\Flag;
use \WHM\Model\FlagDescriptor;
use \WHM\Model\ManageHousehold;

/**
 * Manage entity household
 **/
class ManageFlag 
{
    private $em;
    private $mflag;
    private $findm;

    public function __construct()
    {
        $this->em = Application::em();
        $this->mflag = new Flag();
        $this->findm = new ManageHousehold(); 
    }

     public function createFlag($data)
    {

        $flag = new Flag();

        $flag->setMessage($data["message"]); 
        $household_member = $this->findm->findMember($data["member-id"]); 
        $flag->$this->mflag->setHouseholdMember($household_member);    
        $this->em->persist($flag);
        $this->em->flush();

        return $flag;

    }



}