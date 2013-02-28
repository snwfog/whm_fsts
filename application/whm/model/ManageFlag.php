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
    private $mhousehold;

    public function __construct()
    {
        $this->em = Application::em();
        $this->mhousehold = new ManageHousehold(); 
    }

     public function createFlag($data)
    {
        $flag = new Flag();
        $flag->setMessage($data["message"]); 
        $household_member = $this->mhousehold->findMember($data["member-id"]); 
        $flag->setHouseholdMember($household_member);    
        $this->em->persist($flag);
        $this->em->flush();

        return $flag;

    }

    public function getFlagDescriptors(){
        $query = $this->em->createQuery('SELECT u FROM WHM\Model\FlagDescriptor u');
        $flagDescriptors = $query->getResult();
        return $flagDescriptors;
    }
    
    public function updateFlag($data)
    {
        $data = $this->formatData($data);
        $data->setMeaning($data["color"]);
    }


    private function formatData($data)
    {
        foreach ($data as $key => $value)
        {
            $data[$key] = str_replace("-", "", $value);
        }
        return $data;
    }



}