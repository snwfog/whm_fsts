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
        $participantsTimeslot1 = new ParticipantsTimeslots();    
        $participantsTimeslot2 = new ParticipantsTimeslots();
        $participantsTimeslot3 = new ParticipantsTimeslots();
        $participantsTimeslot4 = new ParticipantsTimeslots();
        $participantsTimeslot5 = new ParticipantsTimeslots();


        $participantsTimeslot1->setHouseHoldMember($this->getReference('HouseHoldMember1'));
        $participantsTimeslot1->setTimeslot($this->getReference('timeslot1'));

        $participantsTimeslot3->setHouseHoldMember($this->getReference('HouseHoldMember4'));
        $participantsTimeslot3->setTimeslot($this->getReference('timeslot1'));

        $participantsTimeslot4->setHouseHoldMember($this->getReference('HouseHoldMember5'));
        $participantsTimeslot4->setTimeslot($this->getReference('timeslot1'));

        $participantsTimeslot5->setHouseHoldMember($this->getReference('HouseHoldMember6'));
        $participantsTimeslot5->setTimeslot($this->getReference('timeslot1'));


        $participantsTimeslot2->setHouseHoldMember($this->getReference('HouseHoldMember2'));
        $participantsTimeslot2->setTimeslot($this->getReference('timeslot2'));



        $manager->persist($participantsTimeslot1);
        $manager->persist($participantsTimeslot2);
        $manager->persist($participantsTimeslot3);
        $manager->persist($participantsTimeslot4);
        $manager->persist($participantsTimeslot5);

        $manager->flush();
    }

}

?>
