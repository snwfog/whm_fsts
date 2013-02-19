<?php

namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Helper;
use WHM\Model\Address;
use WHM\Application;

/*
 * INDEX CONTROLLER / ALSO AS TEMPLATE
 */
class Index extends Controller implements IRedirectable
{
    public function __construct(array $args = null)
    {
        parent::__construct();

        WHM\Helper::backtrace();
    }

    public function get()
    {
        $household = new WHM\Model\Household();
        $address = new Address();

        $address->setStreet("Concordia");
        $household->setAddress($address);

        $this->persist($household);
        $this->flush();

        echo "Saved...<br>";
        echo "Retreaving...<br>";

        Helper::entity_dump($household);
    }
}
