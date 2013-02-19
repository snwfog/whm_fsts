<?php

namespace WHM\Controller;

use \WHM\Helper;
use \WHM\Controller;
use \WHM\IRedirectable;
use \WHM\Model\ManageHousehold;
use \WHM\Model\HouseholdMember;

class Member extends Controller implements IRedirectable
{
    public $data = array();
    private $manageHousehold;
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
      //  Helper_Core::backtrace();
        $this->manageHousehold = new manageHousehold();

    }

    public function get($memberId)
    {  
        $member = $this->manageHousehold->findMember($memberId);
        $household = $member->getHousehold();
        $address = $household->getAddress();
        $data = array(
                        "firstName" => $member->getFirstName(),
                        "lastName"  => $member->getLastName(),
                        "language"  => $member->getLanguage(),
                        "workStatus"  => $member->getWorkStatus(),
                        "welfareNumber"  => $member->getWelfareNumber(),
                        "phoneNumber"  => $member->getPhoneNumber(),
                        "medicareNum"  => $member->getMcareNumber(),
                        "referral"  => $member->getReferral(),
                        "marital"  => $member->getMaritalStatus(),
                        "origin"   => $member->getOrigin(),
                        "street"    => $address->getStreet(),
                        "apt"      => $address->getAptNumber(),
                        "city"     => $address->getCity(),
                        "province" => $address->getProvince(),
                        "postal"   => $address->getPostalCode(),
                     );
        $this->data["household"] = $data;
        $this->display("member_view_form.twig", $this->data);
     //  $this->display("member_create_form.twig");
    }

    public function post()
    {


    }

    public function put()
    {


    }

    public function delete()
    {

    }




}
