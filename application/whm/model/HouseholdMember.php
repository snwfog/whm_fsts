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
     * @Column(nullable=TRUE)
     */
    protected $mcare_number;

    /**
     * @Column(nullable=TRUE)
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
     * @Column(nullable=TRUE)
     */
    protected $mother_tongue;


    /**
     * @Column(nullable=TRUE)
     */
    protected $language;

	/**
     * @Column(nullable=TRUE)
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
     * @Column(nullable=TRUE)
     */
    protected $income;

    /**
     * @Column(nullable=TRUE)
     */
    protected $school;

    /**
     * @Column(nullable=TRUE)
     */
    protected $student_id;

    /**
     * @Column(nullable=TRUE)
     */
    protected $grade;

    /**
     * @Column(nullable=TRUE)
     */
    protected $student_bursary;

    /**
    * @Column(type="date", nullable=TRUE)
    */
    protected $date_of_birth;

    /**
    * @Column(type="datetime")
    */
    protected $first_visit_date;

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
     * @OneToMany(targetEntity="ParticipantsTimeslots", mappedBy="household_member")
     *
     **/
    protected $timeslots = null;

    /**
     * 1 <-> * -- Inversing by default
     *
     * @OneToMany(targetEntity="Flag", mappedBy="household_member")
     * @var flags
     */
    protected $flags = null;

	public function _construct()
	{
		$this->timeslots = new ArrayCollection();
        $this->flags = new ArrayCollection();
	}

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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

    public function setMotherTongue($mother_tongue)
    {
        $this->mother_tongue = $mother_tongue;
    }

    public function getMotherTongue()
    {
        return $this->mother_tongue;
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

    public function setIncome($income)
    {
        $this->income = $income;
    }

    public function getIncome()
    {
        return $this->income;
    }

      public function setSchool($school)
    {
        $this->school = $school;
    }

    public function getSchool()
    {
        return $this->school;
    }

    public function setStudentId($student_id)
    {
        $this->student_id = $student_id;
    }

    public function getStudentId()
    {
        return $this->student_id;
    }

    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    public function getGrade()
    {
        return $this->grade;
    }

    public function setStudentBursary($student_bursary)
    {
        $this->student_bursary = $student_bursary;
    }

    public function getStudentBursary()
    {
        return $this->student_bursary;
    }


    public function setDateOfBirth($date_of_birth)
    {
        $this->date_of_birth = $date_of_birth;
    }

    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }


    public function setFirstVisitDate($first_visit_date)
    {
        $this->first_visit_date = $first_visit_date;
    }

    public function getFirstVisitDate()
    {
        return $this->first_visit_date;
    }


    /**
     * Helper Method for HouseholdMember class used to achieve bi-directional relationship
     * attribute synchronization.
     * You should never have to call this method explicitly,
     * 
     * @param \WHM\Model\Timeslot $timeslots
     */ 

    public function getTimeslots()
    {
        $data = array();
        foreach($this->timeslots as $relation){
            array_push($data, $relation->getTimeslot());
        }
        return $data;
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
        $flags->setHouseholdMember($this);
    }

    /**
     * @return \WHM\Model\flags
     */
    public function getFlags()
    {
        return $this->flags;
    }
}
