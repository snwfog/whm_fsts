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


        $participantsTimeslot1->setHouseHoldMember($this->getReference('HouseHoldMember1'));
        $participantsTimeslot1->setTimeslot($this->getReference('timeslot1'));


        $manager->persist($participantsTimeslot1);

        $manager->flush();
    }

}

?>
