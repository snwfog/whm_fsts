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
            "member-id" => "6",
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
            "province" => "QC",
            "city" => "Montreal"
        );
    }

    public function testFindHousehold()
    {
        // Find the Household with id = 3
        $householdToFind = $this->manageHousehold->findHousehold(3);

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
        $newHousehold = $this->manageHousehold->createHousehold($this->data);

        $this->assertThat(get_class($newHousehold), $this->equalTo('WHM\Model\Household'));
        $this->assertThat(
                $newHousehold->getHouseholdPrincipal()->getFirstName(), $this->equalTo('Georges'));
    }

    public function testUpdateHousehold()
    {
        // Update the Household with id = 4        
        $this->manageHousehold->updateHousehold($this->data);
        $household = $this->manageHousehold->findHousehold(3);

        $principal = $household->getHouseholdPrincipal();
        $address = $household->getAddress();

        $this->assertThat($principal->getId(), $this->equalTo(6));
        $this->assertThat($principal->getLastName(), $this->equalTo('John'));
        $this->assertThat($principal->getFirstName(), $this->equalTo('Georges'));
        $this->assertThat($address->getId(), $this->equalTo(3));
        $this->assertThat($address->getStreet(), $this->equalTo('Mckay'));
        $this->assertThat($address->getAptNumber(), $this->equalTo('3'));
    }

    public function testRemoveHousehold()
    {
//        $this->manageHousehold->removeHousehold(3);        
//        $this->assertThat(
//                $this->manageHousehold->findHousehold(3), 
//                $this->isNull());
    }

    public function testFindAllHouseholds()
    {
        $households = $this->manageHousehold->findAllHouseholds();
        $this->assertThat(
                sizeof($households), $this->equalTo(10));
    }

    public function testFindMember()
    {
        // Find the Member with id = 7
        $memberToFind = $this->manageHousehold->findMember(7);

        $this->assertThat($memberToFind->getId(), $this->equalTo(7));
        $this->assertThat(
                $memberToFind->getHousehold(), $this->manageHousehold->findHousehold(4)
        );

        $this->assertThat($memberToFind->getFirstName(), $this->equalTo('FAIRBAIRN'));
        $this->assertThat($memberToFind->getLastName(), $this->equalTo('EGLANTINE'));
    }

    public function testGetHouseholdMembers()
    {
        $members = $this->manageHousehold->getHouseholdMembers(1);
        $this->assertThat(sizeof($members), $this->equalTo(2));
    }

    public function testAddMember()
    {
        $this->manageHousehold->addMember($this->data);
        
        $household = $this->manageHousehold->findHousehold(3);

        $principal = $household->getHouseholdPrincipal();
        $address = $household->getAddress();

        $this->assertThat($principal->getId(), $this->equalTo(6));
        $this->assertThat($principal->getLastName(), $this->equalTo('John'));
        $this->assertThat($principal->getFirstName(), $this->equalTo('Georges'));
        $this->assertThat($address->getId(), $this->equalTo(3));
        $this->assertThat($address->getStreet(), $this->equalTo('Mckay'));
        $this->assertThat($address->getAptNumber(), $this->equalTo('3'));
    }

    public function testCreateMember()
    {

    }

    public function testCreateAddress()
    {
        
    }

    public function testUpdateMember()
    {
        
    }

    public function testUpdateAddress()
    {
        
    }

    public function testFormatData()
    {
        
    }

}
