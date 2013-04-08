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
        // 1:
// 
// 
        $now = new \DateTime();
        $oneWeek = new \DateInterval('P7D');
        $twoWeek = new \DateInterval('P2W');
        $threeWeek = new \DateInterval('P3W');
        $oneDay = new \DateInterval('P1D');
        $twoDays = new \DateInterval('P2D');
        $threeDays = new \DateInterval('P3D');
        $fourDays = new \DateInterval('P4D');
        $fiveDays = new \DateInterval('P5D');
        $sixDays = new \DateInterval('P6D');
        
        $e1 = new Event();
        $e1->setCapacity(90);
        $e1->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
        $e1->setGroupId(1);
        $e1->setIsActivated(1);
        $e1->setIsTemplate(false);
        $e1->setName("Food Bank");
        $e1->setStartDate($now);
        $e1->setStartTime(new \DateTime("13:30"));
        $slot1 = new Timeslot();
        $slot1->setCapacity(90);
        $slot1->setDuration(60);
        $slot1->setName('Group A');
        $e1->addTimeslot($slot1);     
        $slot2 = new Timeslot();
        $slot2->setCapacity(90);
        $slot2->setDuration(60);
        $slot2->setName('Group A');
        $e1->addTimeslot($slot2);
        $slot3 = new Timeslot();
        $slot3->setCapacity(90);
        $slot3->setDuration(60);
        $slot3->setName('Group A');
        $e1->addTimeslot($slot3);
        $slot4 = new Timeslot();
        $slot4->setCapacity(90);
        $slot4->setDuration(60);
        $slot4->setName('Group A');
        $e1->addTimeslot($slot4);
        $slot5 = new Timeslot();
        $slot5->setCapacity(90);
        $slot5->setDuration(60);
        $slot5->setName('Group A');
        $e1->addTimeslot($slot5);
        
        $e2 = new Event();
        $e2->setCapacity(45);
        $e2->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
        $e2->setGroupId(2);
        $e2->setIsActivated(1);
        $e2->setIsTemplate(false);
        $e2->setName("Mattress");
        $clone2 = clone $now;
        $e2->setStartDate($clone2->add($oneDay));
        $e2->setStartTime(new \DateTime("9:50"));
        $slot6 = new Timeslot();
        $slot6->setCapacity(90);
        $slot6->setDuration(60);
        $slot6->setName('slot1');        
        $e2->addTimeslot($slot6);
        $slot7 = new Timeslot();
        $slot7->setCapacity(90);
        $slot7->setDuration(60);
        $slot7->setName('Group A');
        $e2->addTimeslot($slot7);
        $slot8 = new Timeslot();
        $slot8->setCapacity(90);
        $slot8->setDuration(60);
        $slot8->setName('Group A');
        $e2->addTimeslot($slot8);
        $slot9 = new Timeslot();
        $slot9->setCapacity(90);
        $slot9->setDuration(60);
        $slot9->setName('Group A');
        $e2->addTimeslot($slot9);
        $slot10 = new Timeslot();
        $slot10->setCapacity(90);
        $slot10->setDuration(60);
        $slot10->setName('Group A');
        $e2->addTimeslot($slot10);
        $slot11 = new Timeslot();
        $slot11->setCapacity(90);
        $slot11->setDuration(60);
        $slot11->setName('Group A');
        $e2->addTimeslot($slot11);       

        $e3 = new Event();
        $e3->setCapacity(100);
        $e3->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
        $e3->setGroupId(6);
        $e2->setIsActivated(1);
        $e3->setIsTemplate(false);
        $e3->setName("Income");
        $clone3 = clone $now;
        $e3->setStartDate($clone3->add($oneDay));
        $e3->setStartTime(new \DateTime("13:30"));
        $slot12 = new Timeslot();
        $slot12->setCapacity(90);
        $slot12->setDuration(60);
        $slot12->setName('Group A');
        $e3->addTimeslot($slot12);
        $slot13 = new Timeslot();
        $slot13->setCapacity(90);
        $slot13->setDuration(60);
        $slot13->setName('slot1');        
        $e3->addTimeslot($slot13);
        $slot14 = new Timeslot();
        $slot14->setCapacity(90);
        $slot14->setDuration(60);
        $slot14->setName('Group A');
        $e3->addTimeslot($slot14);
        $slot14 = new Timeslot();
        $slot14->setCapacity(90);
        $slot14->setDuration(60);
        $slot14->setName('Group A');
        $e3->addTimeslot($slot14);
        $slot15 = new Timeslot();
        $slot15->setCapacity(90);
        $slot15->setDuration(60);
        $slot15->setName('Group A');
        $e3->addTimeslot($slot15);
        $slot16 = new Timeslot();
        $slot16->setCapacity(90);
        $slot16->setDuration(60);
        $slot16->setName('Group A');
        $e3->addTimeslot($slot16);
        $slot17 = new Timeslot();
        $slot17->setCapacity(90);
        $slot17->setDuration(60);
        $slot17->setName('Group A');
        $e3->addTimeslot($slot17); 
        

        $e4 = new Event();
        $e4->setCapacity(90);
        $e4->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
        $e4->setGroupId(3);
        $e4->setIsActivated(1);
        $e4->setIsTemplate(false);
        $e4->setName("BackToSchool");
        $clone4 = clone $now;
        $e4->setStartDate($clone4->add($threeDays));       
        $e4->setStartTime(new \DateTime("18:50"));
        $slot18 = new Timeslot();
        $slot18->setCapacity(90);
        $slot18->setDuration(60);
        $slot18->setName('Group A');
        $e4->addTimeslot($slot18);
        $slot19 = new Timeslot();
        $slot19->setCapacity(90);
        $slot19->setDuration(60);
        $slot19->setName('slot1');        
        $e4->addTimeslot($slot19);
        $slot20 = new Timeslot();
        $slot20->setCapacity(90);
        $slot20->setDuration(60);
        $slot20->setName('Group A');
        $e4->addTimeslot($slot20);
        $slot21 = new Timeslot();
        $slot21->setCapacity(90);
        $slot21->setDuration(60);
        $slot21->setName('Group A');
        $e4->addTimeslot($slot21);
        $slot22 = new Timeslot();
        $slot22->setCapacity(90);
        $slot22->setDuration(60);
        $slot22->setName('Group A');
        $e4->addTimeslot($slot22);
        $slot23 = new Timeslot();
        $slot23->setCapacity(90);
        $slot23->setDuration(60);
        $slot23->setName('Group A');
        $e4->addTimeslot($slot23);
        $slot24 = new Timeslot();
        $slot24->setCapacity(90);
        $slot24->setDuration(60);
        $slot24->setName('Group A');
        $e4->addTimeslot($slot24);  

        $e5 = new Event();
        $e5->setCapacity(10);
        $e5->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
        $e5->setGroupId(4);
        $e5->setIsActivated(1);
        $e5->setIsTemplate(false);
        $e5->setName("Christmas");
        $clone5 = clone $now;
        $e5->setStartDate($clone5->add($fourDays));
        $e5->setStartTime(new \DateTime("17:50"));
        $e5->addTimeslot($slot10);
        $slot25 = new Timeslot();
        $slot25->setCapacity(90);
        $slot25->setDuration(60);
        $slot25->setName('Group A');
        $e5->addTimeslot($slot25); 
        $slot26 = new Timeslot();
        $slot26->setCapacity(90);
        $slot26->setDuration(60);
        $slot26->setName('Group A');
        $e5->addTimeslot($slot26);
        $slot27 = new Timeslot();
        $slot27->setCapacity(90);
        $slot27->setDuration(60);
        $slot27->setName('Group A');
        $e5->addTimeslot($slot27);
        $slot28 = new Timeslot();
        $slot28->setCapacity(90);
        $slot28->setDuration(60);
        $slot28->setName('Group A');
        $e5->addTimeslot($slot28);
        $slot29 = new Timeslot();
        $slot29->setCapacity(90);
        $slot29->setDuration(60);
        $slot29->setName('Group A');
        $e5->addTimeslot($slot29);
        $slot30 = new Timeslot();
        $slot30->setCapacity(90);
        $slot30->setDuration(60);
        $slot30->setName('Group A');
        $e5->addTimeslot($slot30);
        $slot31 = new Timeslot();
        $slot31->setCapacity(90);
        $slot31->setDuration(60);
        $slot31->setName('Group A');
        $e5->addTimeslot($slot31);
         


        $e6 = new Event();
        $e6->setCapacity(90);
        $e6->setDescription("Today's special event");  
        $e6->setGroupId(5);  
        $e6->setIsActivated(1); 
        $e6->setIsTemplate(false);
        $e6->setName("Special giveaways");
        $e6->setStartDate($now);
        $e6->setStartTime(new \DateTime("15:30")); 
        $slot32 = new Timeslot();
        $slot32->setCapacity(90);
        $slot32->setDuration(60);
        $slot32->setName('Group A');
        $e6->addTimeslot($slot32); 
        $slot33 = new Timeslot();
        $slot33->setCapacity(90);
        $slot33->setDuration(60);
        $slot33->setName('Group A');
        $e6->addTimeslot($slot33);
        $slot34 = new Timeslot();
        $slot34->setCapacity(90);
        $slot34->setDuration(60);
        $slot34->setName('Group A');
        $e6->addTimeslot($slot34);
        $slot35 = new Timeslot();
        $slot35->setCapacity(90);
        $slot35->setDuration(60);
        $slot35->setName('Group A');
        $e6->addTimeslot($slot35);
        $slot36 = new Timeslot();
        $slot36->setCapacity(90);
        $slot36->setDuration(60);
        $slot36->setName('Group A');
        $e6->addTimeslot($slot36);
        $slot37 = new Timeslot();
        $slot37->setCapacity(90);
        $slot37->setDuration(60);
        $slot37->setName('Group A');
        $e6->addTimeslot($slot37);
        $slot38 = new Timeslot();
        $slot38->setCapacity(90);
        $slot38->setDuration(60);
        $slot38->setName('Group A');
        $e6->addTimeslot($slot38);
         

                
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
        $this->makeTimeSlot($e1week2);
        $e2week2->setStartDate($e2DateClone->add($oneWeek));
        $this->makeTimeSlot($e2week2);
        $e3week2->setStartDate($e3DateClone->add($oneWeek));
        $this->makeTimeSlot($e3week2);
        $e4week2->setStartDate($e4DateClone->add($oneWeek));
        $this->makeTimeSlot($e4week2);
        $e5week2->setStartDate($e5DateClone->add($oneWeek));
        $this->makeTimeSlot($e5week2);

        $manager->persist($e1week2);
        $manager->persist($e2week2);
        $manager->persist($e3week2);
        $manager->persist($e4week2);
        $manager->persist($e5week2);

        // Adding similar events for two week    
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
        $this->makeTimeSlot($e1week2);
        $e2week2->setStartDate($e2DateClone->add($twoWeek));
        $this->makeTimeSlot($e2week2);
        $e3week2->setStartDate($e3DateClone->add($twoWeek));
        $this->makeTimeSlot($e3week2);
        $e4week2->setStartDate($e4DateClone->add($twoWeek));
        $this->makeTimeSlot($e4week2);
        $e5week2->setStartDate($e5DateClone->add($twoWeek));
        
        $manager->persist($e1week2);
        $manager->persist($e2week2);
        $manager->persist($e3week2);
        $manager->persist($e4week2);
        $manager->persist($e5week2);

        // Adding similar events for three week later   
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

        $e1week2->setStartDate($e1DateClone->add($threeWeek));
        $this->makeTimeSlot($e1week2);
        $e2week2->setStartDate($e2DateClone->add($threeWeek));
        $this->makeTimeSlot($e2week2);
        $e3week2->setStartDate($e3DateClone->add($threeWeek));
        $this->makeTimeSlot($e3week2);
        $e4week2->setStartDate($e4DateClone->add($threeWeek));
        $this->makeTimeSlot($e4week2);
        $e5week2->setStartDate($e5DateClone->add($threeWeek));
        $this->makeTimeSlot($e5week2);


        $manager->persist($e1week2);
        $manager->persist($e2week2);
        $manager->persist($e3week2);
        $manager->persist($e4week2);
        $manager->persist($e5week2);

        $this->createEvents($manager, $oneDay, 6);
        $this->createEvents($manager, $twoDays, 10);
        $this->createEvents($manager, $threeDays, 20);
        $this->createEvents($manager, $fourDays, 30);
        $this->createEvents($manager, $fiveDays, 40);
        $this->createEvents($manager, $sixDays, 50);

        for($j = 8; $j <= 28; $j++)
        {
            $stringDays = 'P'.$j.'D';
            $days = new \DateInterval($stringDays);
            
            // $this->createEvents($manager, $days);
            $this->create2to3Events($manager, $days, 100);
        }

        $manager->flush();

        $this->addReference('timeslot1', $slot1); 
        $this->addReference('timeslot2', $slot2); 
        $this->addReference('timeslot3', $slot3); 
        $this->addReference('timeslot4', $slot4); 
        $this->addReference('timeslot5', $slot5); 
        $this->addReference('timeslot6', $slot6); 
        $this->addReference('timeslot7', $slot7); 
        $this->addReference('timeslot8', $slot8); 
        $this->addReference('timeslot9', $slot9); 
        $this->addReference('timeslot10', $slot10); 
        $this->addReference('timeslot11', $slot11); 
        $this->addReference('timeslot12', $slot12); 
        $this->addReference('timeslot13', $slot13); 
        $this->addReference('timeslot14', $slot14); 
        $this->addReference('timeslot15', $slot15); 
        $this->addReference('timeslot16', $slot16); 
        $this->addReference('timeslot17', $slot17); 
        $this->addReference('timeslot18', $slot18); 
        $this->addReference('timeslot19', $slot19); 
        $this->addReference('timeslot20', $slot20);  
        $this->addReference('timeslot21', $slot21); 
        $this->addReference('timeslot22', $slot22); 
        $this->addReference('timeslot23', $slot23); 
        $this->addReference('timeslot24', $slot24); 
        $this->addReference('timeslot25', $slot25); 
        $this->addReference('timeslot26', $slot26); 
        $this->addReference('timeslot27', $slot27); 
        $this->addReference('timeslot28', $slot28); 
        $this->addReference('timeslot29', $slot29); 
        $this->addReference('timeslot30', $slot30);      
        $this->addReference('timeslot31', $slot31); 
        $this->addReference('timeslot32', $slot32); 
        $this->addReference('timeslot33', $slot33); 
        $this->addReference('timeslot34', $slot34);
        $this->addReference('timeslot35', $slot35);
        $this->addReference('timeslot36', $slot36); 
        $this->addReference('timeslot37', $slot37); 
        $this->addReference('timeslot38', $slot38);    
    }

    private function makeTimeSlot($event)
    {
        $capacity = ceil(rand(30, 100) / 10) * 10;
        $time = array("30", "60");
        $duration = $time[rand(0,1)];
        $numberOfSlots = rand(4,6);

        for($i = 1; $i <= $numberOfSlots; $i++)
        {   
            $slot = new Timeslot();
            $slot->setCapacity($capacity);
            $slot->setDuration($duration);
            $slot->setName('Timeslot');
            $event->addTimeslot($slot);
            $slot = null;
        }
    }

    private function createEvents($manager, $day, $num)
    {
        $now = new \DateTime();
        $eventsToCreate = rand(2, 3);
        $name = array("Mattress", "Food Bank", "Christmas", "Income Tax", "BackToSchool");
        $id = $num;
        for($i = 1; $i <= $eventsToCreate ; $i++)
        {
            $event = new Event();
            $event->setCapacity(45);
            // $event->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
            $event->setGroupId($id++);
            $event->setIsActivated(1);
            $event->setIsTemplate(false);
            $event->setName($name[rand(0,4)]);
            $clone = clone $now;
            $event->setStartDate($clone->add($day));
            $event->setStartTime(new \DateTime("13:00"));
            $this->makeTimeSlot($event);

            $manager->persist($event);
        }
    }

    private function create2to3Events($manager, $day, $num)
    {
        $now = new \DateTime();
        $eventsToCreate = rand(1, 2);
        $name = array("Mattress", "Food Bank", "Christmas", "Income Tax", "BackToSchool");
        $id = $num;
        for($i = 1; $i <= $eventsToCreate ; $i++)
        {
            $event = new Event();
            $event->setCapacity(45);
            // $event->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
            $event->setGroupId($id++);
            $event->setIsActivated(1);
            $event->setIsTemplate(false);
            $event->setName($name[rand(0,4)]);
            $clone = clone $now;
            $event->setStartDate($clone->add($day));
            $event->setStartTime(new \DateTime("13:00"));
            $this->makeTimeSlot($event);

            $manager->persist($event);
        }
    }
}

?>
