<?php

namespace WHM\Controller;

use \WHM\Helper;
use \WHM\Controller;
use \WHM\IRedirectable;
use \WHM\Model\ManageHousehold;
use \WHM\Model\ManageFlag;
use \WHM\Model\Flag;

class Household extends Controller implements IRedirectable
{
    public $data = array( "errors" => array(), "form" => array());
    private $manageHousehold;
    private $manageFlag;
    private $flag;

    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //Helper::backtrace();
        $this->manageHousehold = new ManageHousehold();
        $this->manageFlag = new ManageFlag();
        $this->flag = new Flag();

    }

    public function get($household_id = null, $member_id = null)
    {
        if (isset($_GET["household_id"]))
        {
            $household_id = $_GET["household_id"];
        }

        if(!is_null($household_id)){
            $data = $this->extractHouseholdInfo($household_id, $member_id);
            $flagDescriptors = $this->manageFlag->getFlagDescriptors();
            $formattedDescriptor = $this->formatDescriptor($flagDescriptors);
            $flagm = $this->flag->getMessage();
            $flagm = $this->extractMessage();
            $data = array(
                            "household" => $data,
                            "flagDescriptors" => $formattedDescriptor,
                            "fMessage"=> $flagm,
                    );
            $this->display("household.create.twig", $data);
        }
        else
        {
            $this->redirect("search");
        }

    }



    public function put()
    {

        $content = "charles=yang&mike=pham";
        file_put_contents("php://output", $content);
        $var = null;
        echo "before marker";
        $unparsed = file_get_contents("php://input");
        echo $unparsed."unique<br>";

        echo $unparsed."secondtime<br>";
        parse_str($unparsed, $var);
        print_r($var);

    }

    /**
     * Update household
     *
     *
     */
    public function post()
    {
        $this->manageHousehold->updateHousehold($_POST);
        $this->redirect('household/'.$_POST["household-id"]."/".$_POST["member-id"] );
    }

    public function setHousehold($household)
    {
       $this->household = $household;
    }

    public function delete($household_id)
    {
    $manageHouse = new ManageHousehold();
    $household_id = $manageHouse->getId();
    $manageHouse->removeHousehold($household_id);
    }

    public function extractHouseholdInfo($household_id, $member_id)
    {
        $mHousehold = $this->manageHousehold;
        $household = $mHousehold->findHousehold($household_id);
        $principal = $household->getHouseholdPrincipal();

        if(is_null($member_id)){
            $member = $household->getHouseholdPrincipal();
        }else{
            $member = $mHousehold->findMember($member_id);
        }

        $address = $household->getAddress();
        $dependents = $household->getMembers();
         
        // NEED REFACTORING
        $count = 0;
        $members = null;
        foreach ($dependents as $dependent){
            $members[$count++] = array(
                                        "member-id"  => $dependent->getId(),
                                        "first-name" => $dependent->getFirstName(),
                                        "last-name"  => $dependent->getLastName(),
                                        "active"     => false,
                                        "principal"  => false,
                                 );
            if (($principal->getId() == $dependent->getId())){
                $members[$count-1]["principal"] = true;
            }
            if (($member->getId() == $dependent->getId())){
                $members[$count-1]["active"] = true;     
            }

            
        }

        $date = $member->getFirstVisitDate();
        $date = $date->format("m-d-Y");

        $data = array(
                        "household_id" => $household_id,
                        //PrincipalMember or Selected Member
                        "member-id" => $member->getId(),
                        "first-name" => $member->getFirstName(),
                        "last-name"  => $member->getLastName(),
                        "phone-number"  => $member->getPhoneNumber(),
                        "sin-number"  => $member->getSinNumber(),
                        "medicare-number"  => $member->getMcareNumber(),
                        "work-status"  => $member->getWorkStatus(),
                        "welfare-number"  => $member->getWelfareNumber(),
                        "referral"  => $member->getReferral(),
                        "language"  => $member->getLanguage(),
                        "marital"  => $member->getMaritalStatus(),
                        "gender"  => $member->getGender(),
                        "origin"   => $member->getOrigin(),
                        "first-visit-date"  => $date,
                        "contact"   => $member->getContact(),
                        //Address
                        "house-number"    => $address->getHouseNumber(),
                        "street"    => $address->getStreet(),
                        "apt-number" => $address->getAptNumber(),
                        "city"     => $address->getCity(),
                        "province" => $address->getProvince(),
                        "postal-code"   => $address->getPostalCode(),
                );
        $data["members"] = $members;
        return $data;
    }

    private function formatDescriptor($flagDescriptors)
    {
        $data = array();
        $count = 0;
        foreach( $flagDescriptors as $flagD){
            $data[$count++] = array(
                                  "flag-id" => $flagD->getId(),
                                  "flag-color" => $flagD->getColor(),
                                  "flag-meaning" => $flagD->getMeaning(),
                              );
        }

        return $data;
    }

    private function extractMessage()
    {
      /*  $flag = new Flag();
        if(!is_null($flag))
        {
        $flagm= array("message" => $this->flag->getMessage(),);
        }
        return $flagm;
*/

        $flag = new Flag();
        $flagm= array("message" => $this->flag->getMessage(),);
        
        return $flagm;

    }
}

