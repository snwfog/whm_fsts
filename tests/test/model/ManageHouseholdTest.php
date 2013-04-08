<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\ManageHousehold;
use WHM\Application;
use Test\FixtureProvider;

class ManageHouseholdTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var ManageHousehold 
     */
    private $manageHousehold;
    private $data;

    protected function setUp()
    {
        parent::setUp();

        FixtureProvider::load();

        $this->manageHousehold = new ManageHousehold;

        $this->data = array(
            "household-id" => "3",
            "member-id" => NULL,
            "first-name" => "Georges",
            "last-name" => "John",
            "phone-number" => "514 999 9999",
            "sin-number" => "9999 - 999 - 999",
            "mcare-number" => "999 - 9999 - 999",
            "work_status" => "Employed",
            "welfare-number" => "9999 - 999 - 999",
            "referral" => "A good guy",
            "language" => "English",
            "marital-status" => "Single",
            "gender" => "M",
            "origin" => "Canada",
            "contact" => "514 222 - 2220",
            "postal-code" => "h2f 6o5",
            "house-number" => "0",
            "apt-number" => "3",
            "street" => "Mckay",
            "district" => "Montreal",
            "city" => "Montreal",
            "first-visit-date" => "04-01-2012",
            "date-of-birth" =>NULL,
            "mother-tongue" =>"Chinese",
            "income" => "5289"
        );
    }

    public function testFindHousehold()
    {
        // Find the Household with id = 3
        $householdToFind = ManageHousehold::findHousehold(3);

        $this->assertThat($householdToFind->getId(), $this->equalTo(3));

        $principal = $householdToFind->getHouseholdPrincipal();
        $address = $householdToFind->getAddress();

        $this->assertThat($principal->getId(), $this->equalTo(6));
        $this->assertThat($principal->getLastName(), $this->equalTo('PONTO'));
        $this->assertThat($principal->getFirstName(), $this->equalTo('GAMMIDGE'));
        $this->assertThat($address->getId(), $this->equalTo(3));
        $this->assertThat($address->getStreet(), $this->equalTo('184TH STREET'));
        $this->assertThat($address->getAptNumber(), $this->equalTo('db'));
    }

    public function testCreateHousehold()
    {
        $newHousehold = ManageHousehold::createHousehold($this->data);

        $this->assertThat(get_class($newHousehold), $this->equalTo('WHM\Model\Household'));
        $this->assertThat(
                $newHousehold->getHouseholdPrincipal()->getFirstName(), $this->equalTo('Georges'));
    }

    public function testUpdateHousehold()
    {
        // Update the Household with id = 4        
        ManageHousehold::updateHousehold($this->data);
        $household = ManageHousehold::findHousehold(3);

        $principal = $household->getHouseholdPrincipal();
        $address = $household->getAddress();

        $this->assertThat($principal->getLastName(), $this->equalTo('PONTO'));

    }


    public function testGetHouseholdMembers()
    {
        $members = ManageHousehold::getHouseholdMembers(1);
        $this->assertThat(sizeof($members), $this->equalTo(2));
    }

    public function testAddMember()
    {
        ManageHousehold::addMember($this->data);
        
        $household = ManageHousehold::findHousehold(3);
        
        $this->assertThat(sizeof($household), $this->equalTo(1));
    }

}
