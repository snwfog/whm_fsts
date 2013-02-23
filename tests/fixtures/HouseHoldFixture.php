<?php

namespace Test\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use \Doctrine\Common\Persistence\ObjectManager;
use WHM\Model\Household;
use WHM\Model\Address;
use WHM\Model\HouseholdMember;

class HouseHoldFixture extends AbstractFixture
{
    public function load(ObjectManager $em)
    {
        $household1 = new Household();
        
        $householdPrincipal1 = new HouseholdMember();     
        $householdPrincipal1->setContact("+1 514 999-88888");
        $householdPrincipal1->setFirstName("Abraham");
        $householdPrincipal1->setFirstVisitDate(new \DateTime('2010-02-01'));
        $householdPrincipal1->setGender("M");
        $householdPrincipal1->setLanguage("English");
        $householdPrincipal1->setLastName("Yoyoma");
        $householdPrincipal1->setMaritalStatus("Single");
        $householdPrincipal1->setMcareNumber("99999-9999-999-9");
        $householdPrincipal1->setOrigin("Australia");
        $householdPrincipal1->setPhoneNumber("+1 514 888 0000");
        $householdPrincipal1->setReferral("Mr. Spok");
        $householdPrincipal1->setSinNumber("N/A");
        $householdPrincipal1->setWelfareNumber("+1 514 999-0008");
        $householdPrincipal1->setWorkStatus("Unemployed");
        
        $address1 = new Address();
        $address1->setPostalCode("h1m 2m7");
        $address1->getAptNumber("4578");
        $address1->setCity("montreal");
        $address1->setProvince("none");
        $address1->setStreet("none");        
        
        $household1->setAddress($address1);
        $household1->setHouseholdPrincipal($householdPrincipal1);
        $householdPrincipal1->setHousehold($household1);
        
        $em->persist($household1);
        
        $em->flush();
    }
}

?>
