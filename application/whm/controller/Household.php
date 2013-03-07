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
            //Get household and as default, get household principal if specific member is not specified.
            $household = $this->manageHousehold->findHousehold($household_id);
            if(is_null($member_id)){
                $member = $household->getHouseholdPrincipal();
            }else{
                $member = $this->manageHousehold->findMember($member_id);
            }

            $data = $this->formatHouseholdInfo($household, $member);
            
            //Get flag descriptor for creating flags
            $flagDescriptors = $this->manageFlag->getFlagDescriptors();
            $formattedDescriptor = $this->formatDescriptor($flagDescriptors);

            //Get member flags
            $flags = $member->getFlags();
            $formattedFlags = $this->formatMessage($flags);
            

            $data = array(
                            "household" => $data,
                            "flagDescriptors" => $formattedDescriptor,
                            "flags"=> $formattedFlags,
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

  /*  public function delete($household_id)
    {
    $manageHouse = new ManageHousehold();
    $household_id = $manageHouse->getId();
    $manageHouse->removeHousehold($household_id);
    }
*/


    public function formatHouseholdInfo($household, $member)
    {
        
        $principal = $household->getHouseholdPrincipal();
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
                        "household_id" => $household->getId(),
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

    private function formatMessage($flagMessage)
    {

        $data = array();
        $count = 0;
        foreach( $flagMessage as $flag){
            $flagD = $flag->getDescriptor();
            $data[$count++] = array(
                                  "message" => $flag->getMessage(),
                                  "flag-color" => $flagD->getColor(),
                                  "flag-meaning" => $flagD->getMeaning(),
                              );
        }

        return $data;      
    }
}

