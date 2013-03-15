<?php

namespace Test\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use WHM\Model\Event;
use WHM\Model\Timeslot;

class EventFixture extends AbstractFixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return array('Test\Fixture\MultiAddressHouseholdFixture'); // fixture classes fixture is dependent on
    }

    public function load(ObjectManager $manager)
    {
        $e1 = new Event();
        $e1->setCapacity(90);
        $e1->setDescription("Lorem ipsum dolor sit amet, 
            consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
            labore et dolore magna aliqua. Ut enim ad minim veniam, 
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea 
            commodo consequat.");
        $e1->setGroupId(1);
        $e1->setIsTemplate(false);
        $e1->setName("Food Distribution");
        $e1->setStartDate(date_create("2013-03-16"));
        $e1->setStartTime(new \DateTime("13:30"));
        $slot1 = new Timeslot();
        $slot1->setCapacity(90);
        $slot1->setDuration(3600);
        $slot1->setName('slot1');
        $e1->addTimeslot($slot1);        
        
        $e2 = new Event();
        $e2->setCapacity(45);
        $e2->setDescription("Lorem ipsum dolor sit amet, 
            consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
            labore et dolore magna aliqua. Ut enim ad minim veniam, 
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea 
            commodo consequat.");
        $e2->setGroupId(2);
        $e2->setIsTemplate(false);
        $e2->setName("Mattress Distribution");
        $e2->setStartDate(date_create("2013-03-13"));
        $e2->setStartTime(new \DateTime("9:50"));        
        $slot2 = new Timeslot();
        $slot2->setCapacity(90);
        $slot2->setDuration(3600);
        $slot2->setName('slot1');
        $e2->addTimeslot($slot2);        

        $e3 = new Event();
        $e3->setCapacity(100);
        $e3->setDescription("Lorem ipsum dolor sit amet, 
            consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
            labore et dolore magna aliqua. Ut enim ad minim veniam, 
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea 
            commodo consequat.");
        $e3->setGroupId(2);
        $e3->setIsTemplate(false);
        $e3->setName("Food Distribution");
        $e3->setStartDate(date_create("2013-03-20"));
        $e3->setStartTime(new \DateTime("13:30"));
        $slot3 = new Timeslot();
        $slot3->setCapacity(90);
        $slot3->setDuration(3600);
        $slot3->setName('slot1');
        $e3->addTimeslot($slot3);         
        

        $e4 = new Event();
        $e4->setCapacity(90);
        $e4->setDescription("Lorem ipsum dolor sit amet, 
            consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
            labore et dolore magna aliqua. Ut enim ad minim veniam, 
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea 
            commodo consequat.");
        $e4->setGroupId(3);
        $e4->setIsTemplate(false);
        $e4->setName("Mattress Distribution");
        $e4->setStartDate(date_create("2013-03-22"));       
        $e4->setStartTime(new \DateTime("18:50"));
        $slot4 = new Timeslot();
        $slot4->setCapacity(90);
        $slot4->setDuration(3600);
        $slot4->setName('slot1');
        $e4->addTimeslot($slot4);         

        $e5 = new Event();
        $e5->setCapacity(10);
        $e5->setDescription("Lorem ipsum dolor sit amet, 
            consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
            labore et dolore magna aliqua. Ut enim ad minim veniam, 
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea 
            commodo consequat.");
        $e5->setGroupId(4);
        $e5->setIsTemplate(false);
        $e5->setName("Food Distribution");
        $e5->setStartDate(date_create("2013-03-24"));
        $e5->setStartTime(new \DateTime("17:50"));
        $slot5 = new Timeslot();
        $slot5->setCapacity(90);
        $slot5->setDuration(3600);
        $slot5->setName('slot1');
        $e5->addTimeslot($slot5);            
                
        $manager->persist($e1);
        $manager->persist($e2);
        $manager->persist($e3);
        $manager->persist($e4);
        $manager->persist($e5);
        
        $manager->flush();
    }

}

?>
