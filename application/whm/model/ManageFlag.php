<?php
namespace WHM\Model;
use WHM;
use WHM\Application;
use \WHM\Model\Flag;
use \WHM\Model\FlagDescriptor;
use \WHM\Model\ManageHousehold;
use \WHM\Model\HouseholdMember;
use \DateTime;


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
        $datetime = new DateTime("now");
        $flag = new Flag();
        $flag->setMessage($data["message"]);
        $flag->setFlagDate($datetime); 
        $household_member = $this->mhousehold->findMember($data["member-id"]);
        $flag_descriptors = $this->findDescriptors($data["flag-descriptor-id"]); 
        $flag->setHouseholdMember($household_member);
        $flag->setDescriptor($flag_descriptors);    
        $this->em->persist($flag);
        $this->em->flush();

        return $flag;

    }

    public function deleteFlag($id)
    {
        $flagId = $this->findFlag($id["flag-id"]);
        $this->em->remove($flagId);
        $this->em->flush();
        return $flagId;
    }

    public function findFlag($id)
    {
        $flagId = $this->em->find("WHM\model\Flag", (int) $id);
        return $flagId;
    }
    public function flagNumber()
    {
        $flag_descriptors = new FlagDescriptor();
        $flag_descriptors->getId();
        $household_member = new HouseholdMember();
        $household_member->getId();
        $query = $this->em->createQuery('   SELECT u,count(u) 
                                            FROM WHM\Model\Flag flag
                                            JOIN WHM\Model\FlagDescriptor descriptor
                                            JOIN WHM\Model\HouseholdMember member 
                                            WHERE flag_descriptor_id=$flag_descriptors and household_member_id=$household_members 
                                            GROUP BY flag_descriptor_id' );
        $flagNmber = $query->getResult();
        return $flagNmber;
    }

    public function findDescriptors($id)
    {
        $flag_descriptors = $this->em->find("WHM\Model\FlagDescriptor", (int) $id);
        return $flag_descriptors;
    }

    public function getFlagDescriptors()
    {
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