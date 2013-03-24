<?php
namespace WHM\Model;
use WHM;
use WHM\Application;
use \DateTime;
use \WHM\Model\Household;

/**
 * Manage entity household
 **/
class ManageHousehold {
    private $em;

    public function __construct()
    {
        $this->em = Application::em();
    }

    public function createHousehold($data)
    {
        $pmember = $this->createMember($data); //Principal Member
        $address = $this->createAddress($data);
        $household = new Household();

        $household->setHouseholdPrincipal($pmember);
        $household->setAddress($address);
        $this->em->persist($household);
        $this->em->flush();

        $pmember->setHousehold($household);
        $this->em->persist($pmember);
        $this->em->flush();

        return $household;
    }

    public function updateHousehold($data)
    {
        $household = $this->findHousehold($data["household-id"]);
        $address = $household->getAddress();
        $this->createMember($data);
        $this->updateAddress($address, $data);
    }


    //Delete
    public function removeHousehold($id)
    {
//        The following code throws a fatal error during unit test
//        ManageHouseholdTest.php
//                          
//        $household = findHousehold($id);
//        $em->remove($household);
//        $em->flush();
    }

    public  function findAllHouseholds()
    {
        // to do
    }
    
    /**
     * Returns the household with the passed id.
     * 
     * @param int $id 
     * @return Household
     */
    public function findHousehold($id)
    {

        $household = $this->em->find("WHM\model\household", (int) $id);
        return $household;
    }

    /*
     * @return HouseholdMember
     */
    public function findMember($id)
    {
        $member = $this->em->find("WHM\model\HouseholdMember", (int) $id);
        return $member;
    }

    /*
     * @return ArrayCollection of type HouseholdMember
     */
    public function getHouseholdMembers($id)
    {
        $household = $this->findHousehold($id);
        return $household->getMembers();
    }

    /*
     * @return HouseholdMember
     */
    public function addMember($data)
    {
        $household = $this->findHousehold($data["household-id"]);
        $member = $this->createMember($data);
        $member->setHousehold($household);
        $this->em->persist($member);
        $this->em->flush();
        return $member;
    }



    //NEW or UPDATE Member
    private function createMember($data)
    {
        $datetime = new DateTime();
        if(isset($data["member-id"])){
        //Update Member
            $household_member = $this->findMember($data["member-id"]);
            $household_member->setFirstVisitDate($datetime->createFromFormat("d-m-Y", $data["first-visit-date"]));
        }else{
        //New Member  
            $household_member = new HouseholdMember();          
            $household_member->setFirstVisitDate($datetime);
        }
        
        if(isset($data["date-of-birth"]) && !empty($data["date-of-birth"])){
            $DOBObject = new DateTime();
            $data["date-of-birth"] = $DOBObject->createFromFormat("m-d-y", $data["date-of-birth"]);
        }else{
            $data["date-of-birth"] = null;
        }
        $data = $this->formatData($data);
        $household_member->setFirstName($data["first-name"]);
        $household_member->setLastName($data["last-name"]);
        $household_member->setPhoneNumber($data["phone-number"]);
        $household_member->setMcareNumber($data["mcare-number"]);
        $household_member->setWorkStatus($data["work_status"]);
        $household_member->setWelfareNumber($data["welfare-number"]);
        $household_member->setReferral($data["referral"]);
        $household_member->setMotherTongue($data["mother-tongue"]);
        $household_member->setLanguage($data["language"]);
        $household_member->setMaritalStatus($data["marital-status"]);
        $household_member->setGender($data["gender"]);
        $household_member->setOrigin($data["origin"]);
        $household_member->setDateOfBirth($data["date-of-birth"]);
        $household_member->setIncome($data["income"]);


        $this->em->persist($household_member);
        $this->em->flush();
        return $household_member;
    }

    private function createAddress($data)
    {
        $address = new Address();
        $address->setHouseNumber($data["house-number"]);
        $address->setStreet($data["street"]);
        $address->setAptNumber($data["apt-number"]);
        $address->setPostalCode($data["postal-code"]);
        $address->setDistrict($data["district"]);
        $this->em->persist($address);
        $this->em->flush();

        return $address;

    }

    private function updateAddress($addressInstance, $data)
    {
        $addressInstance->setHouseNumber($data["house-number"]);
        $addressInstance->setStreet($data["street"]);
        $addressInstance->setAptNumber($data["apt-number"]);
        $addressInstance->setPostalCode($data["postal-code"]);
        $addressInstance->setDistrict($data["district"]);
        $this->em->persist($addressInstance);
        $this->em->flush();
    }


    private function formatData($data)
    {
        foreach ($data as $key => $value)
        {

            is_string($value) ? $data[$key] = str_replace("-", "", $value) : '';
        }
        return $data;
    }
}
