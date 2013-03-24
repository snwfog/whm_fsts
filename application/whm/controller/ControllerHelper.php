<?php

namespace WHM\Controller;

use \WHM\Helper;
use DateTime;

class ControllerHelper
{

    public function formatMember($member_array){
        $count = 0;
        $data = null;
        foreach( $member_array as $member){
            $date = $member->getFirstVisitDate()->format("m-d-Y");
            $DOB = null;
            if(!is_null($member->getDateOfBirth())){
                $data[$count]["age"] = $this->calculateAge($member->getDateOfBirth(), new DateTime());
                $DOB =  $member->getDateOfBirth()->format("m-d-y");
            }
            $household = $member->getHousehold();
            
            $data[$count] = array(
                            "household_id" => $household->getId(),
                            "member-id" => $member->getId(),
                            "first-name" => $member->getFirstName(),
                            "last-name"  => $member->getLastName(),
                            "phone-number"  => $member->getPhoneNumber(),
                            "medicare-number"  => $member->getMcareNumber(),
                            "work-status"  => $member->getWorkStatus(),
                            "welfare-number"  => $member->getWelfareNumber(),
                            "referral"  => $member->getReferral(),
                            "mother-tongue"=> $member->getMotherTongue(),
                            "language"  => $member->getLanguage(),
                            "marital"  => $member->getMaritalStatus(),
                            "gender"  => $member->getGender(),
                            "origin"   => $member->getOrigin(),
                            "first-visit-date"  => $date,
                            "income"   => $member->getIncome(),
                    );
            ++$count;
        }
        return $data;
    }

    public function calculateAge($earlierDate, $olderDate){
        return $earlierDate->format("md") > $olderDate->format("md") ? 
                    ($olderDate->format("Y") - $earlierDate->format("Y") - 1) 
                    : 
                    ($olderDate->format("Y") - $earlierDate->format("Y"));
    }

}

