<?php

namespace Test\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use WHM\Model\FlagDescriptor;
use WHM\Model\Flag;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FlagFixture extends AbstractFixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return array('Test\Fixture\MultiAddressHouseholdFixture'); // fixture classes fixture is dependent on
    }

    private $flagAttribute = array
        (
        // Goes with Buttons
        'color' => array(
            'success', // green
            'warning', // yellow
            'danger', // red
            'info'          // pale blue
        ),
        // Goes with Alerts
        'alternative_color' => array(
            'success', // green
            '', // yellow
            'error', // red
            'info'          // pale blue
        ),

        'alternative_color_2' => array(
            'success',      // green
            'warning',      // yellow
            'important',    // red
            'info'          // pale blue
        ),

        'alternative_color_2' => array(
            'success',      // green
            'warning',      // yellow
            'important',    // red
            'info'          // pale blue
        ),

        'meaning' => array(
            'Success',
            'Warning',
            'Error',
            'Information'
        )
    );

    public function load(ObjectManager $em)
    {
        // Create 4 kinds of flag for the user in
        // the existing database
        for ($i = 0; $i < count($this->flagAttribute['color']); $i++)
        {
            $flagDescriptor = new FlagDescriptor();
            $flagDescriptor->setColor($this->flagAttribute['color'][$i]);
            $flagDescriptor->setAlternativeColor($this->flagAttribute['alternative_color'][$i]);
            $flagDescriptor->setAlternativeColor2($this->flagAttribute['alternative_color_2'][$i]);
            $flagDescriptor->setMeaning($this->flagAttribute['meaning'][$i]);

            $em->persist($flagDescriptor);
            $this->setReference("FlagDescriptor" . ($i + 1), $flagDescriptor);
        }

        for ($i = 1; $i < 248; $i++)
        {
            $randomNumberOfFlags = rand(3, 6);
            for($j = 0; $j < $randomNumberOfFlags; $j++)
            {                
                $randomFlagDescriptorReference = rand(1, 4);            
                $flag = new Flag();
                $flag->setDescriptor($this->getReference("FlagDescriptor". $randomFlagDescriptorReference));
                $flag->setFlagDate(new \DateTime());
                $flag->setHouseholdMember($this->getReference("HouseHoldMember". $i));
                $flag->setMessage("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
            
                $em->persist($flag);                
            }            
        }

        $em->flush();
    }

}