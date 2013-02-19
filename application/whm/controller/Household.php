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

    public function get()
    {
        $mHousehold = new ManageHousehold();
        $household = $mHousehold->findHousehold($_GET["household_id"]);
        $householdPrincipal = $household->getHouseholdPrincipal();
        $address = $household->getAddress();

        $data = array(
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
                        "postal"   => $address->getProvince(),
                     );
        $data = array("household" =>$data);       
        $this->display("household_view_form.twig", $data);
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
}

?>
