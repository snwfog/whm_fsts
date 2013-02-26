<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\ManageHousehold;

class ManageHouseholdTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var ManageHousehold 
     */
    private $manageHousehold;

    protected function setUp()
    {
        parent::setUp();
        $this->manageHousehold = new ManageHousehold;
    }

    public function testCreateHousehold()
    {
        $data = array(
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

        $newHousehold = $this->manageHousehold->createHousehold($data);

        $this->assertThat(
                get_class($newHousehold), 
                $this->equalTo('WHM\Model\Household'));
        $this->assertThat(
                $newHousehold->getHouseholdPrincipal()->getFirstName(),
                $this->equalTo('Georges'));
    }

    public function testUpdateHousehold()
    {
        
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
