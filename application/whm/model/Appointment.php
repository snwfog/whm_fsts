<?php

namespace WHM\Model;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="participants_events")
 **/
class Appointment
{
    /**
     * @Column(length=2)
     **/
    protected $household_member_id;

    /**
     * @Column(length=2)
     **/
    protected $event_id;

    public function setEventId($event_id)
    {
        $this->event_id=event_id;
    }

    public function getEventId()
    {
        return $this->event_id;
    }

    public function setHouseholdMemberId($household_member_id)
    {
        $this->household_member_id=$household_member_id;
    }

    public function getHouseholdMemberId()
    {
        return $household_member_id;
    }

}
