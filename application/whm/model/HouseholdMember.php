<?php

namespace WHM\Model;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="household_members")
 */
class HouseholdMember
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(nullable=TRUE)
     */
    protected $first_name;

    /**
     * @Column(nullable=TRUE)
     */
    protected $last_name;

    /**
     * @Column(nullable=TRUE)
     */
    protected $phone_number;

    /**
     * @Column(nullable=TRUE, length=9)
     */
    protected $sin_number;

    /**
     * @Column(nullable=TRUE)
     */
    protected $mcare_number;

    /**
     * @Column(nullable=TRUE, length=2)
     */
    protected $work_status;

    /**
     * @Column(nullable=TRUE)
     */
    protected $welfare_number;

    /**
     * @Column(nullable=TRUE)
     */
    protected $referral;

    /**
     * @Column(nullable=TRUE, length=2)
     */
    protected $language;

	/**
     * @Column(nullable=TRUE, length=2)
     */
    protected $marital_status;

    /**
     * @Column(nullable=TRUE, length=1)
     */
    protected $gender;

    /**
     * TO BE CHANGED TO TABLES...
     *
     * @Column(nullable=TRUE)
     */
    protected $origin;

    /**
     * @Column(type="datetime")
     */
    protected $first_visit_date;

    /**
     * @Column(nullable=TRUE)
     */
    protected $contact;

    /**
     * @Column(nullable=TRUE)
     */
    protected $income;


    /**
     * * -> 1 -- Owning by Default
     *
     * @ManyToOne(targetEntity="Household")
     * @JoinColumn(name="household_id", referencedColumnName="id")
     *
     * @var $household;
     */
    protected $household;

    /**
     * * <-> * -- Owning
     *
     * @ManyToMany(targetEntity="Event", inversedBy="participants")
     * @JoinTable
     * (
     *      name="participants_events",
     *      joinColumns=
     *      {
     *          @JoinColumn
     *          (
     *              name="household_member_id",
     *              referencedColumnName="id"
     *          )
     *      },
     *      inverseJoinColumns=
     *      {
     *          @JoinColumn
     *          (
     *              name="event_id",
     *              referencedColumnName="id"
     *          )
     *      }
     * )
     *
     **/
    protected $events = null;

    /**
     * 1 <-> * -- Inversing by default
     *
     * @OneToMany(targetEntity="Flag", mappedBy="household_member")
     * @var flags
     */
    protected $flags = null;

	public function _construct()
	{
		$this->events = new ArrayCollection();
        $this->flags = new ArrayCollection();
	}

    public function getId()
    {
        return $this->id;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function setSinNumber($sin_number)
    {
        $this->sin_number = $sin_number;
    }

    public function getSinNumber()
    {
        return $this->sin_number;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setMcareNumber($mcare_number)
    {
        $this->mcare_number = $mcare_number;
    }

    public function getMcareNumber()
    {
        return $this->mcare_number;
    }

    public function setWorkStatus($work_status)
    {
        $this->work_status = $work_status;
    }

    public function getWorkStatus()
    {
        return $this->work_status;
    }

    public function setWelfareNumber($welfare_number)
    {
        $this->welfare_number = $welfare_number;
    }

    public function getWelfareNumber()
    {
        return $this->welfare_number;
    }

    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    public function getOrigin()
    {
        return $this->origin;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setMaritalStatus($marital_status)
    {
        $this->marital_status = $marital_status;
    }

    public function getMaritalStatus()
    {
        return $this->marital_status;
    }

    public function setReferral($referral)
    {
        $this->referral = $referral;
    }

    public function getReferral()
    {
        return $this->referral;
    }

    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    public function getContact()
    {
        return $this->contact;
    }

    public function setIncome($income)
    {
        $this->income = $income;
    }

    public function getIncome()
    {
        return $this->income;
    }

    public function setFirstVisitDate($first_visit_date)
    {
        $this->first_visit_date = $first_visit_date;
    }

    public function getFirstVisitDate()
    {
        return $this->first_visit_date;
    }

    public function attendEvent(Event $events)
    {
        $this->events[] = $events;
        $events->addParticipant($this);
    }

    public function removeEvent(Event $event)
    {
        $this->events->removeElement($event);
        $event->removeParticipant($this);
    }

    /**
     * Helper Method for HouseholdMember class used to achieve bi-directional relationship
     * attribute synchronization.
     * You should never have to call this method explicitly,
     * 
     * @param \WHM\Model\Event $events
     */
    public function addEvent(Event $events)
    {
        $this->events[] = $events;
    }    

    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param  $household
     */
    public function setHousehold(Household $household)
    {
        $this->household = $household;
    }

    /**
     * @return Household
     */
    public function getHousehold()
    {
        return $this->household;
    }

    /**
     * @param \WHM\Model\flags $flags
     */
    public function addFlags($flags)
    {
        $this->flags[] = $flags;
        $flags->addHouseholdMember($this);
    }

    /**
     * @return \WHM\Model\flags
     */
    public function getFlags()
    {
        return $this->flags;
    }
}
