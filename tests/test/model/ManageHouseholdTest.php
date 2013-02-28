<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\ManageHousehold;
use WHM\Application;

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
        $this->manageHousehold = new ManageHousehold;

        $this->data = array(
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

    public function testCreateHousehold()
    {
        $em = Application::em();

        $newHousehold = $this->manageHousehold->createHousehold($this->data);

        $this->assertThat(
                get_class($newHousehold), $this->equalTo('WHM\Model\Household'));
        $this->assertThat(
                $newHousehold->getHouseholdPrincipal()->getFirstName(), $this->equalTo('Georges'));
    }

    public function testUpdateHousehold()
    {
        // Update the Household with id = 50
        $householdToUpdate = $this->manageHousehold->findHousehold(50);
    }

    public function testRemoveHousehold()
    {
        
    }

    public function testFindAllHouseholds()
    {
        // to do
    }

    public function testFindHousehold()
    {
        // Find the Household with id = 50
        $householdToUpdate = $this->manageHousehold->findHousehold(50);

        $this->assertThat(
                $householdToUpdate->getId(), 
                $this->equalTo(50));

        $principal = $householdToUpdate->getHouseholdPrincipal();
        $address = $householdToUpdate->getAddress();

        $this->assertThat(
                $principal->getId(),
                $this->equalTo(100));
        $this->assertThat(
                $principal->getLastName(),
                $this->equalTo('ERLING'));
        $this->assertThat(
                $principal->getFirstName(),
                $this->equalTo('PROUDFOOT'));        
        $this->assertThat(
                $address->getId(),
                $this->equalTo(50));
        $this->assertThat(
                $address->getStreet(),
                $this->equalTo('TYCOS DR'));
        $this->assertThat(
                $address->getAptNumber(),
                $this->equalTo('ff'));
    }

    public function testFindMember()
    {
        
    }

    public function testGetHouseholdMembers()
    {
        
    }

    public function testAddMember()
    {
        
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
