<?php

namespace Test\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use WHM\Model\Event;
use WHM\Model\Timeslot;
use WHM\Model\ParticipantsTimeslots;
use WHM\Model\ManageAppointment;

class AppointmentFixture extends AbstractFixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return array('Test\Fixture\EventFixture',
         'Test\Fixture\MultiAddressHouseholdFixture'); // fixture classes fixture is dependent on
    }

    public function load(ObjectManager $manager)
    {

         for ($i = 0; $i < 248; $i++)
        {
            
             $randomNumberOfApp = rand(1, 1);
             for($j = 0; $j < $randomNumberOfApp/2; $j++)
             {                
               // echo $i."\n";
                $randomTimeslotReference = rand(1, 15); 

                $participantsTimeslot = new ParticipantsTimeslots();
                $participantsTimeslot->setHouseHoldMember($this->getReference('HouseHoldMember'. $i));
                $participantsTimeslot->setTimeslot($this->getReference('timeslot'. $randomTimeslotReference));    

                $manager->persist($participantsTimeslot);

               // echo $i."\n";
                $randomTimeslotReference = rand(17, 38); 

                $participantsTimeslot = new ParticipantsTimeslots();
                $participantsTimeslot->setHouseHoldMember($this->getReference('HouseHoldMember'. $i));
                $participantsTimeslot->setTimeslot($this->getReference('timeslot'. $randomTimeslotReference));    

                $manager->persist($participantsTimeslot);                            
             }            
        }

        $manager->flush();
    }

}

?>
