<?php

namespace WHM\Model;

/**
 * @Entity
 * @Table(name="participants_timeslots")
 * */
class ParticipantsTimeslots
{


    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var id
     **/
    private $id;

    /** @ManyToOne(targetEntity="HouseholdMember", inversedBy="timeslots") 
    *
    */
    protected $household_member;

    /** @ManyToOne(targetEntity="Timeslot", inversedBy="participants") 
     *
     */
    protected $timeslot;

    /** @Column(type="boolean") */
    protected $attend = false;


    public function setHouseholdMember($householdMember){
        $this->household_member = $householdMember;
    }

    public function getHouseholdMember(){
        return $this->household_member;
    }

    public function setTimeslot($timeslot){
        $this->timeslot = $timeslot;
    }

    public function getTimeslot(){
        return $this->timeslot;
    }

    public function setAttend($attend){
        $this->attend = $attend;
    }

    public function getAttend(){
        return $this->attend;
    }
}
