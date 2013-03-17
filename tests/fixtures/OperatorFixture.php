<?php

namespace Test\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use WHM\Model\Operator;

class OperatorFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $admin = new Operator();
        $admin->setUsername("Admin");
        $admin->setPassword("27334453ae927929546a7b95f723209a1604bbafac8236c24e1847a420651acf");                
        
        $manager->persist($admin);
        $manager->flush();
    }
}

?>
