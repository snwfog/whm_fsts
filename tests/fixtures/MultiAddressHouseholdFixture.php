<?php

namespace Test\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use WHM\Model\Address;
use WHM\Model\HouseholdMember;
use WHM\Model\Household;
use WHM\Helper;

class MultiAddressHouseholdFixture extends AbstractFixture
{
	public function load(ObjectManager $em)
	{
        // Load the user test file
        $userArr = $this->loadTestFile();
        // Shuffle the records so that every time
        // we get different records
        shuffle($userArr);

        // Test file format
        //   Number
        // | GivenName
        // | Surname
        // | StreetAddress
        // | City
        // | State
        // | ZipCode
        // | Country
        // | TelephoneNumber
        // | Occupation

        // Set the number of created users (Max: 20 000)
        $max = 1000;

        // Generate users
        $i = 1;

        list($id, $lastName, $firstName, $streetAddress,
                $city, $state, $postalCode, $country,
                $phoneNumber, $occupation) =
            explode("|", strtoupper($userArr[0]));

        // Further narrow down the variables
        $addressArr = explode(' ', $streetAddress);
        $houseNumber = array_shift($addressArr);
        $streetName = implode(' ', $addressArr);

        // Generate a first household
        $addr = $this->_createAddress($houseNumber, $streetName, $postalCode,
                    $city, $state);
        $person = $this->_createMember($firstName, $lastName, $phoneNumber);
        $hh = $this->_createHousehold($addr, $person);

        do
        {
            // ob_start();

            // Helper::entity_dump($person);

            // ob_flush();

            // Get the properties that we are looking for
            list($id, $lastName, $firstName, $streetAddress,
                $city, $state, $postalCode, $country,
                $phoneNumber, $occupation) =
            explode("|", strtoupper($userArr[$i]));

            // Further narrow down the variables
            $addressArr = explode(' ', $streetAddress);
            $houseNumber = array_shift($addressArr);
            $streetName = implode(' ', $addressArr);


            // Determine the fate of this person
            // This new person has 1/3 chance of becoming
            // a household pricipal, or 2/3 chance
            // of being added to a household as a member
            switch (rand(1, 9))
            {
                case 1:
                case 2:
                case 3:
                    // Flush the household before creating a new one
                    $em->persist($person);
                    $em->persist($hh);
                    $em->flush();

                    // Create a new person
                    $person = $this->_createMember($firstName, $lastName,
                        $phoneNumber);
                    $addr = $this->_createAddress($houseNumber, $streetName,
                        $postalCode, $city, $state);
                    $hh = $this->_createHousehold($addr, $person);
                break;
                default:
                    $person = $this->_createMember($firstName, $lastName,
                        $phoneNumber);
                    $hh->addMember($person);
            }
        } while (++$i < $max);
	}

    private function _createMember($firstName, $lastName, $phoneNumber)
    {
        // Create a new member
        $person = new HouseholdMember();
        $person->setFirstName($firstName);
        $person->setLastName($lastName);
        $person->setPhoneNumber($phoneNumber);
        $person->setMcareNumber($this->getRandomMcareNumber());
        $person->setFirstVisitDate(new \DateTime("now"));

        return $person;
    }

    private function _createHousehold($addr, $principal)
    {
        // Create a new household
        $hh = new Household();
        $hh->setAddress($addr);
        $hh->setHouseholdPrincipal($principal);

        return $hh;
    }

    private function _createAddress($houseNumber, $streetName, $postalCode,
        $city, $state)
    {
        // Create new address object
        $addr = new Address();
        $addr->setHouseNumber($houseNumber);
        $addr->setStreet($streetName);
        $addr->setAptNumber(rand(1, 999));
        $addr->setPostalCode(str_replace(" ", "", $postalCode));
        $addr->setCity($city);
        $addr->setProvince($state);

        return $addr;
    }

    private function getRandomMcareNumber()
    {
        $char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $number = "0123456789";
        $mcare = "";

        for ($i = 0; $i < 2; $i++)
        {
            switch ($i)
            {
                case 0:
                    $mcare .= substr(str_shuffle($char), 0, 4);
                    break;
                case 1:
                case 2:
                    $mcare .= substr(str_shuffle($number), 0, 8);
            }
        }

        return $mcare;
    }

    private function loadTestFile()
    {
        return file(__DIR__ . "/../users-20000.txt");
    }
}
