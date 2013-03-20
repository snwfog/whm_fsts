<?php
namespace WHM\Controller;
use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Application;
use \WHM\Model\Event;
use \WHM\Model\ManageEvent;
use \WHM\Model\ManageAppointment;
use \WHM\Model\ManageHousehold;
use \WHM\Model\Timeslot;
use DateTime;
use DateTimeZone;

class Report extends Controller implements IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    protected $em;

    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //WHM\Helper::backtrace();
        $this->em = Application::em();
        $this->event = new Event();
        $this->mevent = new ManageEvent();
        $this->mAppoint = new ManageAppointment();
        $this->manageHousehold = new ManageHousehold();
        
    }

    public function get($eventId = null)
    {      
            $allEvents = $this->mevent->getAllEvents();
            $annualReport=$this->createAnnualReport($allEvents);
            print_r($annualReport);

            $data = array(
                           "participants"  =>  $annualReport
                    ); 
            $this->display("report.stat.twig", $data);             
    }

    // Update Event
    public function post()
	{
     

    }

      public function createAnnualReport($eventId)
    {
        $data = array();
        $count = 0;
        
        foreach ($eventId as $event) 
        {
          $findEvent = $this->mevent->findEvent($eventId);
          $participants = $this->getEventParticipants($findEvent); 
          $member = $this->manageHousehold->findMember($participants);
          $household = $member->getHousehold();
          $address = $household->getAddress();  
          $data[$count++] = array( 
                        "mother-tongue"  => $member->getMotherTongue(),
                        "work-status"  => $member->getWorkStatus(),
                        "origin"   => $member->getOrigin(),
                        "income" => $member->getIncome(),
                        "postal-code"   => $address->getPostalCode(),
                        "district" => $address->getDistrict(),

                        );
        }
         return $data;
    }


    public function createMonthlyReport()
    {

    } 

    public function createAdhocReport()
    {

    } 

     public function getEventParticipants()
    {   
        $timeslot= new Timeslot();
        $allEvents = $this->mevent->getAllEvents();
        $eventSlots = $this->event->getTimeslots($allEvents);
        $participants = null;
        if(!is_null($eventSlots))
        {    
            foreach ($eventSlots as $es) 
            {
    
                  $participants = $es->getParticipants();
            }
        }
        $data = array(
                    "participants"  => $participants
                    );

        return $data;
    
    }


    public function groupByOrigin()
    {
        $query = $this->em->createQuery('   SELECT origin, count(origin) 
                                            FROM WHM\Model\HouseholdMember member  
                                            GROUP BY origin' );
        $groupByOrigin = $query->getResult();
        return $groupByOrigin;
    }

    public function groupByMotherTongue()
    {
        $query = $this->em->createQuery('   SELECT mother_tongue, count(mother_tongue) 
                                            FROM WHM\Model\HouseholdMember member  
                                            GROUP BY mother_tongue' );
        $groupByMotherTongue = $query->getResult();
        return $groupByMotherTongue;
    }

    public function groupByIncome()
    {
        $query = $this->em->createQuery('   SELECT income, count(income) 
                                            FROM WHM\Model\HouseholdMember member  
                                            GROUP BY income' );
        $groupByIncome = $query->getResult();
        return $groupByIncome;
    }



}