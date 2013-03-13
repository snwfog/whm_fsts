<?php

namespace WHM\Model;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *@Entity @Table(name="timeslots")
 **/
class Timeslot
{
     /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;
     /**
     * * -> 1 -- Owning by Default
     *
     * @ManyToOne(targetEntity="Event")
     * @JoinColumn(name="event_id", referencedColumnName="id")
     *
     * @var $event;
     */
    protected $event;

    /** @Column(type="time", nullable=TRUE) */   
    protected $relative_start_time;

    /** @Column(type="time", nullable=TRUE) */
    protected $duration;

     /**
     * * <-> * -- Inversing
     * @ManyToMany(targetEntity="HouseholdMember", mappedBy="Timeslot")
     * @JoinTable(name="participants_eventslot")
     **/
    protected $participants;

    /** @Column(type="integer") */
    protected $capacity;



    /**
    * Helper Method for Timeslot class used to achieve bi-directional relationship
    * attribute synchronization.
    * You should never have to call this method explicitly,
    *
    * @param \WHM\Model\HouseholdMember $participant
    */

    public function _construct()
    {
        $this->participants = new ArrayCollection();
    }
    public function addParticipant(HouseholdMember $participant)
    {
        $this->participants[] = $participant;
    }

    public function removeParticipant($participant)
    {
        $this->participants->removeElement($participant);
    }

    public function getParticipants()
    {
        return $this->participants;
    }


}


