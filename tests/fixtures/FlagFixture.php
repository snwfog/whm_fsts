<?php

namespace Test\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use WHM\Model\Flag;
use WHM\Model\FlagDescriptor;


class FlagFixture extends AbstractFixture
{
    private $flagAttribute = array
    (
        // Goes with Buttons
        'color' => array(
            'success',      // green
            'warning',      // yellow
            'danger',       // red
            'info'          // pale blue
        ),

        // Goes with Alerts
        'alternative_color' => array(
            'success',      // green
            '',             // yellow
            'error',        // red
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
            $flagDescriptor->setMeaning($this->flagAttribute['meaning'][$i]);

            $em->persist($flagDescriptor);
            $em->flush();
        }
    }
}