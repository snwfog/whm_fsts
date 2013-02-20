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
    private $household;

    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //Helper::backtrace();

    }

    public function get($household_id = null)
    {
        if(isset($_GET["household_id"])){
            $household_id = $_GET["household_id"];
        }

        if(!is_null($household_id)){
        $data = $this->extractHouseholdInfo($household_id);  
        $data = array( "household" => $data);
        $this->display("household_view_form.twig", $data);
        }else{
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

   public function post()
   {

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


   private function extractHouseholdInfo($household_id){
        $mHousehold = new ManageHousehold();
        $household = $mHousehold->findHousehold($household_id);
        $householdPrincipal = $household->getHouseholdPrincipal();
        $address = $household->getAddress();

        $data = array(
                        "household_id" => $household_id,
                        "firstName" => $householdPrincipal->getFirstName(),
                        "lastName"  => $householdPrincipal->getLastName(),
                        "language"  => $householdPrincipal->getLanguage(),
                        "workStatus"  => $householdPrincipal->getWorkStatus(),
                        "welfareNumber"  => $householdPrincipal->getWelfareNumber(),
                        "phoneNumber"  => $householdPrincipal->getPhoneNumber(),
                        "medicareNum"  => $householdPrincipal->getMcareNumber(),
                        "referral"  => $householdPrincipal->getReferral(),
                        "marital"  => $householdPrincipal->getMaritalStatus(),
                        "origin"   => $householdPrincipal->getOrigin(),
                        "street"    => $address->getStreet(),
                        "apt"      => $address->getAptNumber(),
                        "city"     => $address->getCity(),
                        "province" => $address->getProvince(),
                        "postal"   => $address->getPostalCode(),
                     );
        return $data; 
   }
}

