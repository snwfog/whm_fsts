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
        $now = new \DateTime();
        $oneWeek = new \DateInterval('P7D');
        $twoWeek = new \DateInterval('P2W');
        $oneDay = new \DateInterval('P1D');
        $threeDays = new \DateInterval('P3D');
        
        $e1 = new Event();
        $e1->setCapacity(90);
        $e1->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
        $e1->setGroupId(1);
        $e1->setIsTemplate(false);
        $e1->setName("Food Distribution");
        $e1->setStartDate($now);
        $e1->setStartTime(new \DateTime("13:30"));
        $slot1 = new Timeslot();
        $slot1->setCapacity(90);
        $slot1->setDuration(60);
        $slot1->setName('Group A');
        $e1->addTimeslot($slot1);        
        
        $e2 = new Event();
        $e2->setCapacity(45);
        $e2->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
        $e2->setGroupId(2);
        $e2->setIsTemplate(false);
        $e2->setName("Mattress Distribution");
        $clone2 = clone $now;
        $e2->setStartDate($clone2->add($oneDay));
        $e2->setStartTime(new \DateTime("9:50"));        
        $slot2 = new Timeslot();
        $slot2->setCapacity(90);
        $slot2->setDuration(60);
        $slot2->setName('slot1');        
        $e2->addTimeslot($slot2);        

        $e3 = new Event();
        $e3->setCapacity(100);
        $e3->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
        $e3->setGroupId(1);
        $e3->setIsTemplate(false);
        $e3->setName("Food Distribution");
        $clone3 = clone $now;
        $e3->setStartDate($clone3->add($oneDay));
        $e3->setStartTime(new \DateTime("13:30"));
        $slot3 = new Timeslot();
        $slot3->setCapacity(90);
        $slot3->setDuration(60);
        $slot3->setName('Group A');
        $e3->addTimeslot($slot3);         
        

        $e4 = new Event();
        $e4->setCapacity(90);
        $e4->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
        $e4->setGroupId(3);
        $e4->setIsTemplate(false);
        $e4->setName("Mattress Distribution");
        $clone4 = clone $now;
        $e4->setStartDate($clone4->add($threeDays));       
        $e4->setStartTime(new \DateTime("18:50"));
        $slot4 = new Timeslot();
        $slot4->setCapacity(90);
        $slot4->setDuration(60);
        $slot4->setName('Group A');
        $e4->addTimeslot($slot4);         

        $e5 = new Event();
        $e5->setCapacity(10);
        $e5->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
        $e5->setGroupId(4);
        $e5->setIsTemplate(false);
        $e5->setName("Food Distribution");
        $clone5 = clone $now;
        $e5->setStartDate($clone5->add($threeDays));
        $e5->setStartTime(new \DateTime("17:50"));
        $slot5 = new Timeslot();
        $slot5->setCapacity(90);
        $slot5->setDuration(60);
        $slot5->setName('Group A');
        $e5->addTimeslot($slot5);    

        $e6 = new Event();
        $e6->setCapacity(90);
        $e6->setDescription("Today's special event");  
        $e6->setGroupId(5);   
        $e6->setIsTemplate(false);
        $e6->setName("Special giveaways");
        $e6->setStartDate($now);
        $e6->setStartTime(new \DateTime("15:30"));
        $slot6 = new Timeslot();
        $slot6->setCapacity(90);
        $slot6->setDuration(70);
        $slot6->setName('Group A');
        $e6->addTimeslot($slot6);   
        $slot7 = new Timeslot();
        $slot7->setCapacity(90);
        $slot7->setDuration(70);
        $slot7->setName('Group A');
        $e6->addTimeslot($slot7);   
                
        $manager->persist($e1);
        $manager->persist($e2);
        $manager->persist($e3);
        $manager->persist($e4);
        $manager->persist($e5);
        $manager->persist($e6);
        
        // Adding similar events for next week        
        $e1week2 = clone $e1;
        $e2week2 = clone $e2;
        $e3week2 = clone $e3;
        $e4week2 = clone $e4;
        $e5week2 = clone $e5;

        
        $e1DateClone = clone $e1->getStartDate();
        $e2DateClone = clone $e2->getStartDate();
        $e3DateClone = clone $e3->getStartDate();
        $e4DateClone = clone $e4->getStartDate();
        $e5DateClone = clone $e5->getStartDate();

        $e1week2->setStartDate($e1DateClone->add($oneWeek));
        $e2week2->setStartDate($e2DateClone->add($oneWeek));
        $e3week2->setStartDate($e3DateClone->add($oneWeek));
        $e4week2->setStartDate($e4DateClone->add($oneWeek));
        $e5week2->setStartDate($e5DateClone->add($oneWeek));
        
        $manager->persist($e1week2);
        $manager->persist($e2week2);
        $manager->persist($e3week2);
        $manager->persist($e4week2);
        $manager->persist($e5week2);



        $e1week2 = clone $e1;
        $e2week2 = clone $e2;
        $e3week2 = clone $e3;
        $e4week2 = clone $e4;
        $e5week2 = clone $e5;

        
        $e1DateClone = clone $e1->getStartDate();
        $e2DateClone = clone $e2->getStartDate();
        $e3DateClone = clone $e3->getStartDate();
        $e4DateClone = clone $e4->getStartDate();
        $e5DateClone = clone $e5->getStartDate();

        $e1week2->setStartDate($e1DateClone->add($twoWeek));
        $e2week2->setStartDate($e2DateClone->add($twoWeek));
        $e3week2->setStartDate($e3DateClone->add($twoWeek));
        $e4week2->setStartDate($e4DateClone->add($twoWeek));
        $e5week2->setStartDate($e5DateClone->add($twoWeek));
        
        $manager->persist($e1week2);
        $manager->persist($e2week2);
        $manager->persist($e3week2);
        $manager->persist($e4week2);
        $manager->persist($e5week2);

        $manager->flush();

        $this->addReference('timeslot1', $slot1); 
        $this->addReference('timeslot2', $slot6);       
    }

}

?>
