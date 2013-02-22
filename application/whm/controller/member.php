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
                        "first-name" => $member->getFirstName(),
                        "last-name"  => $member->getLastName(),
                        "language"  => $member->getLanguage(),
                        "work-status"  => $member->getWorkStatus(),
                        "welfare-number"  => $member->getWelfareNumber(),
                        "phone-number"  => $member->getPhoneNumber(),
                        "medicare-number"  => $member->getMcareNumber(),
                        "referral"  => $member->getReferral(),
                        "marital"  => $member->getMaritalStatus(),
                        "origin"   => $member->getOrigin(),
                        "street"    => $address->getStreet(),
                        "apt-number"      => $address->getAptNumber(),
                        "city"     => $address->getCity(),
                        "province" => $address->getProvince(),
                        "postal-code"   => $address->getPostalCode(),
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
