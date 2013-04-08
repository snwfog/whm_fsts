<?php

namespace WHM\Model;

/**
 * @Entity
 * @Table(name="flags")
 * */
class Flag
{


    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var id
     **/
    private $id;

    /**
     * @Column(type="text")
     * @var message
     */
    private $message;

    /**
     * * <-> 1 -- Owning by default
     * @ManyToOne(targetEntity="HouseholdMember", inversedBy="flags")
     * @JoinColumN(name="household_member_id", referencedColumnName="id")
     * */
    private $household_member;

    /**
     * * -> 1 -- Owning
     *
     * @ManyToOne(targetEntity="FlagDescriptor")
     * @JoinColumn(name="flag_descriptor_id", referencedColumnName="id")
     */
    private $descriptor;

     /**
    * @Column(type="datetime")
    */
    protected $flag_date;

    /**
     * @return \WHM\Model\id
     */
    public function getId()
    {
        return $this->id;
    }

    public function setDescriptor($descriptor)
    {
        $this->descriptor = $descriptor;
    }

    public function getDescriptor()
    {
        return $this->descriptor;
    }

    public function setHouseholdMember($household_member)
    {
        $this->household_member = $household_member;
    }

    public function getHouseholdMember()
    {
        return $this->household_member;
    }

    /**
     * @param \WHM\Model\message $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return \WHM\Model\message
     */
    public function getMessage()
    {
        return $this->message;
    }


    public function setFlagDate($flag_date)
    {
        $this->flag_date = $flag_date;
    }

    public function getFlagDate()
    {
        return $this->flag_date;
    }
}
