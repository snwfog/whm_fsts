<?php


namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use WHM\Model\ManageOperator;

class ManageOperatorTest extends PHPUnit_Framework_TestCase
{
    public function testFindOperator()
    {
        $manageOperator = new ManageOperator();
        $users = $manageOperator->findOperator("Admin", "Admin");
        //var_dump($users);
        $this->assertEquals(1,  sizeof($users));
        $this->assertEquals("Admin",  $users[0]->getUsername());
    }
}
?>
