<?php

namespace Test\Fixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use WHM\Model\Address;

class AddressFixture implements FixtureInterface
{
    public function load(ObjectManager $em)
    {
        $address = new Address();
        $address->setPostalCode("h1m 2m7");
        $address->getAptNumber("4578");
        $address->setCity("montreal");
        $address->setProvince("none");
        $address->setStreet("none");
        
        
        $em->persist($address);
        $em->flush();
    }
}
?>
