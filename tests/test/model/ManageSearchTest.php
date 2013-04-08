<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use WHM\Model\ManageSearch;

class ManageSearchTest extends PHPUnit_Framework_TestCase
{
    public function testSearchMemberByName()
    {
        $search = new ManageSearch;
        $members = $search->searchMemberByName("v");
        $this->assertEquals(2, count($members));
        
        $members = $search->searchMemberByName("vie");
        $this->assertEquals(1, count($members));
        $this->assertEquals(1, (int)$members[0]["id"]);
        $this->assertEquals("VIERA", $members[0]["first_name"]);
        
    }
}


?>
