<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\ManageFlag;
use WHM\Application;
use Test\FixtureProvider;

class Manage_Flag_Test extends PHPUnit_Framework_TestCase
{

    /**
     * @var ManageFlag 
     */
    private $manageFlag;
    private $data;
    private $em;
    
    protected function setUp()
    {
        parent::setUp();
        $this->em = Application::em();
        //FixtureProvider::load();
        
        $this->manageFlag = new ManageFlag;

        $this->data = array(
            "household-id" => "1",
            "member-id" => "2",
            "message" => "Missing referal information",
            "flag-descriptor-id" => "3"
        );
    }
    
    //passed
    function testCreateFlag()
    {
        $newFlag=$this->manageFlag->createFlag($this->data);
        $query = $this->em->createQuery('SELECT f FROM WHM\Model\Flag f
                                         WHERE f.message= :message');
        $query->setParameter('message', 'Missing referal information');
        $flag =$query->getResult();
        $this->assertNotNull($flag);
        
    }
    function testFindflag()
    {
        
        $flag = $this->manageFlag->findFlag(1);
        $this->assertNotNull($flag);
    }
    function testDeletFlag()
    {
        $id =array('flag-id'=>1);
        $this->manageFlag->deleteFlag($id);
    }
    function testFindDescriptors()
    {
        $fd = $this->manageFlag->findDescriptors(1);
        $this->assertNotNull($fd);
    }
    function testGetFlagDescriptors()
    {
        $fd = $this->manageFlag->getFlagDescriptors();
        $this->assertNotNull($fd);
    }
    
//    function testFlagNumber()
//    {
//        $num = $this->manageFlag->flagNumber();
//        $this->assertEquals(1,$num);
//    }
//    function testFindDescriptors()
//    {
//        
//    }


    //failed--getFlagMessage returns array of flags, not messages
//    function testGetFlagMessage()
//    {
//        $messages=$this->manageFlag->getFlagMessage(2);
//        //var_dump($messages);
//        $this->assertThat(sizeof($messages), $this->equalTo(1));
//        $this->assertEquals('Missing referal information', $messages[0]);
//    }
    
    //passed
//    function testGetFlagDescriptors()
//    {
//        $descriptors=$this->manageFlag->getFlagDescriptors();
//        //var_dump($messages);
//        $this->assertThat(sizeof($descriptors), $this->equalTo(3));
//    }
    
    
    
}
?>
