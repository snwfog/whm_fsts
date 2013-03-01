<?php

namespace WHM\Model;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *@Entity @Table(name="events")
 **/
class Event
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * * <-> * -- Inversing
     * @ManyToMany(targetEntity="HouseholdMember", mappedBy="events")
     * @JoinTable(name="participants_events")
     **/
    protected $participants;

    public function _construct()
    {
        $this->participants = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function registeredParticipant(HouseholdMember $participant)
    {
        $this->participants[] = $participant;
        $participant->addEvent($this);
    }

    /**
     * Helper Method for Event class used to achieve bi-directional relationship
     * attribute synchronization.
     * You should never have to call this method explicitly,
     *
     * @param \WHM\Model\HouseholdMember $participant
     */
    public function addParticipant(HouseholdMember $participant)
    {
        $this->participants[] = $participant;
    }

    public function getParticipants()
    {
        return $this->participants;
    }
}

