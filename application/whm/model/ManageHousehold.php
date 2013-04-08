<?php
namespace WHM\Model;
use WHM;
use WHM\Application;
use \DateTime;
use DateInterval;
use \WHM\Model\Household;

/**
 * Manage entity household
 **/
class ManageHousehold {

    public static function createHousehold($data)
    {
        $pmember = self::createMember($data); //Principal Member
        $address = self::createAddress($data);
        $household = new Household();

        $household->setHouseholdPrincipal($pmember);
        $household->setAddress($address);
        Application::em()->persist($household);
        Application::em()->flush();

        $pmember->setHousehold($household);
        Application::em()->persist($pmember);
        Application::em()->flush();

        return $household;
    }

    public static function updateHousehold($data)
    {
        $household = self::findHousehold($data["household-id"]);
        $address = $household->getAddress();
        self::createMember($data);
        self::updateAddress($address, $data);
    }


    //Delete
    public static function removeHousehold($id)
    {
//        The following code throws a fatal error during unit test
//        ManageHouseholdTest.php
//
//        $household = findHousehold($id);
//        $em->remove($household);
//        $em->flush();
    }

    /**
     * Returns the household with the passed id.
     *
     * @param int $id
     * @return Household
     */
    public static function findHousehold($id)
    {

        $household = Application::em()->find("WHM\model\household", (int) $id);
        return $household;
    }

    /*
     * @return HouseholdMember
     */
    public static function findMember($id)
    {
        $member = Application::em()->find("WHM\model\HouseholdMember", (int) $id);
        return $member;
    }

    /*
     * @return ArrayCollection of type HouseholdMember
     */
    public static function getHouseholdMembers($id)
    {
        $household = self::findHousehold($id);
        return $household->getMembers();
    }

    /*
     * @return HouseholdMember
     */
    public static function addMember($data)
    {
        $household = self::findHousehold($data["household-id"]);
        $member = self::createMember($data);
        $member->setHousehold($household);
        Application::em()->persist($member);
        Application::em()->flush();
        return $member;
    }



    //NEW or UPDATE Member
    private static function createMember($data)
    {
        $datetime = new DateTime();
        if(isset($data["member-id"])){
        //Update Member
            $household_member = self::findMember($data["member-id"]);
            $household_member->setFirstVisitDate($datetime->createFromFormat("d-m-Y", $data["first-visit-date"]));
        }else{
        //New Member
            $household_member = new HouseholdMember();
            $household_member->setFirstVisitDate($datetime);
        }

        if(isset($data["date-of-birth"]) && !empty($data["date-of-birth"])){
            $DOBObject = new DateTime();
            $now = new DateTime();
            $data["date-of-birth"] = $DOBObject->createFromFormat("m-d-y", $data["date-of-birth"]);

            //Bug fix: PHP year date from 0-69 are added 2000
            $DOBYear = $data["date-of-birth"]->format("y");
            $currentYear = $now->format("y");
            if($DOBYear < 70 && $DOBYear > $currentYear){
                $data["date-of-birth"] = $data["date-of-birth"]->sub(DateInterval::createFromDateString("100 years"));
            }
        }else{
            $data["date-of-birth"] = null;
        }
        $data = self::formatData($data);
        $household_member->setFirstName($data["first-name"]);
        $household_member->setLastName($data["last-name"]);
        $household_member->setPhoneNumber($data["phone-number"]);
        $household_member->setMcareNumber($data["mcare-number"]);
        $household_member->setWorkStatus($data["work_status"]);
        $household_member->setWelfareNumber($data["welfare-number"]);
        $household_member->setSchool($data["school"]);
        $household_member->setStudentId($data["student-id"]);
        $household_member->setGrade($data["grade"]);
        $household_member->setStudentBursary($data["student-bursary"]);
        $household_member->setReferral($data["referral"]);
        $household_member->setMotherTongue($data["mother-tongue"]);
        $household_member->setLanguage($data["language"]);
        $household_member->setMaritalStatus($data["marital-status"]);
        $household_member->setGender($data["gender"]);
        $household_member->setOrigin($data["origin"]);
        $household_member->setDateOfBirth($data["date-of-birth"]);
        $household_member->setIncome($data["income"]);


        Application::em()->persist($household_member);
        Application::em()->flush();
        return $household_member;
    }

    private static function createAddress($data)
    {
        $address = new Address();
        $address->setHouseNumber($data["house-number"]);
        $address->setStreet($data["street"]);
        $address->setAptNumber($data["apt-number"]);
        $address->setPostalCode($data["postal-code"]);
        $address->setDistrict($data["district"]);
        Application::em()->persist($address);
        Application::em()->flush();

        return $address;

    }

    private static function updateAddress($addressInstance, $data)
    {
        $addressInstance->setHouseNumber($data["house-number"]);
        $addressInstance->setStreet($data["street"]);
        $addressInstance->setAptNumber($data["apt-number"]);
        $addressInstance->setPostalCode($data["postal-code"]);
        $addressInstance->setDistrict($data["district"]);
        Application::em()->persist($addressInstance);
        Application::em()->flush();
    }


    private static function formatData($data)
    {
        foreach ($data as $key => $value)
        {

            is_string($value) ? $data[$key] = str_replace("-", "", $value) : '';
        }
        return $data;
    }

}
