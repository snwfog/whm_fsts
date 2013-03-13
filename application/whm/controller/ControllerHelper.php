<?php

namespace WHM\Controller;

use \WHM\Helper;

class ControllerHelper
{

    public function formatMember($member_array){
        $count = 0;
        $data = null;
        foreach( $member_array as $member){
            $date = $member->getFirstVisitDate();
            $date = $date->format("m-d-Y");
            $household = $member->getHousehold();
            
            $data[$count++] = array(
                            "household_id" => $household->getId(),
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
                            "income"   => $member->getIncome(),
                    );
        }
        return $data;
    }

}

