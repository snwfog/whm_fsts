<?php

namespace WHM\Controller;

use \WHM\Helper;
use \WHM\Controller;
use \WHM\IRedirectable;
use \WHM\Model\ManageHousehold;
use \WHM\Model\HouseholdMember;

class Household extends Controller implements IRedirectable
{
    public $data = array( "errors" => array(), "form" => array());
    private $manageHousehold;

    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //Helper::backtrace();
        $this->manageHousehold = new ManageHousehold();

    }

    public function get($household_id = null)
    {   
        if (isset($_GET["household_id"]))
        {
            $household_id = $_GET["household_id"];
        }

        if(!is_null($household_id)){
        $data = $this->extractHouseholdInfo($household_id);  
        $data = array( "household" => $data);
        $this->display("household_view_form.twig", $data);
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
        $this->redirect('household/'.$_POST["household-id"]);
    }

   public function setHousehold($household){
       $this->household = $household;
   }

   public function delete($household_id)
   {
    $manageHouse = new ManageHousehold();
    $household_id = $manageHouse->getId();
    $manageHouse->removeHousehold($household_id);
   }


   public function extractHouseholdInfo($household_id){
        $mHousehold = new ManageHousehold();
        $household = $mHousehold->findHousehold($household_id);
        $householdPrincipal = $household->getHouseholdPrincipal();
        $address = $household->getAddress();

        $date = $householdPrincipal->getFirstVisitDate();
        $date = $date->format("m-d-Y");

        $data = array(
                        "household_id" => $household_id,
                        //PrincipalMember
                        "first-name" => $householdPrincipal->getFirstName(),
                        "last-name"  => $householdPrincipal->getLastName(),
                        "phone-number"  => $householdPrincipal->getPhoneNumber(),
                        "sin-number"  => $householdPrincipal->getSinNumber(),
                        "medicare-number"  => $householdPrincipal->getMcareNumber(),
                        "work-status"  => $householdPrincipal->getWorkStatus(),
                        "welfare-number"  => $householdPrincipal->getWelfareNumber(),
                        "referral"  => $householdPrincipal->getReferral(),
                        "language"  => $householdPrincipal->getLanguage(),
                        "marital"  => $householdPrincipal->getMaritalStatus(),
                        "gender"  => $householdPrincipal->getGender(),
                        "origin"   => $householdPrincipal->getOrigin(),
                        "first-visit-date"  => $date,
                        "contact"   => $householdPrincipal->getContact(),
                        //Address
                        "house-number"    => $address->getHouseNumber(),
                        "street"    => $address->getStreet(),
                        "apt-number" => $address->getAptNumber(),
                        "city"     => $address->getCity(),
                        "province" => $address->getProvince(),
                        "postal-code"   => $address->getPostalCode(),
                     );
        return $data; 
   }
}

