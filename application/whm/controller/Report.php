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
use \WHM\Model\HouseholdMember;
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
            //$event = $this->mevent->findEvent($eventId);
            //$allEvents = $this->mevent->getAllEvents();
     /*       $annualReport=$this->createAnnualReport($eventId);
            print_r($annualReport);

            $data = array(
                           "participants"  =>  $annualReport
                    ); */

         /*

            header("Content-Type: text/plain");

            // filename for download
            $filename = "website_data_" . date('Ymd') . ".xls";

            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Content-Type: application/vnd.ms-excel");
            $flag = false;
            foreach($data as $row) 
            {
                $data = array(
                           "participants"  =>  $annualReport
                    );

                if(!$flag) 
                {
                    // display field/column names as first row
                echo implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
                }
                echo implode("\t", array_values($row)) . "\r\n";
             }
*/

        
            $this->display("report.stat.twig");  

           
    }

    // Update Event
    public function post()
	{
        if (isset($_POST))
        {
            $annualReport=$this->createAnnualReport($_POST);
            print_r($annualReport);

            $data = array(
                           "participants"  =>  $annualReport
                    );

             header("Content-Type: text/plain");

            // filename for download
            $filename = "website_data_" . date('Ymd') . ".xls";

            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Content-Type: application/vnd.ms-excel");
            $flag = false;
            foreach($data as $row) 
            {
                $data = array(
                           "participants"  =>  $annualReport
                    );

                if(!$flag) 
                {
                    // display field/column names as first row
                echo implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
                }
              //  echo implode("\t", array_values($row)) . "\r\n";
             }
  
         //   $this->redirect("household/" . $_POST["household-id"] . "/" . $_POST["member-id"]);
        }
        else
        {
            $this->display("report.stat.twig",$data);
        }
        
    }

      public function createAnnualReport()
    {
        $data = array();
        $count = 0;
        $allEvents = $this->mevent->getAllEvents();
        
        foreach ($allEvents as $event) 
        {
          $participants = $this->getEventParticipants($event); 
          foreach ($participants as $member) 
          { 
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
        }
         return $data;
    }


    public function createMonthlyReport()
    {

    } 

    public function createAdhocReport()
    {

    } 

     public function getEventParticipants($eventInstance)
    {   
        $eventSlots = $eventInstance->getTimeslots();
        $participants = null;
        $data = array();
        if(!is_null($eventSlots))
        {  
            foreach ($eventSlots as $es) 
            {
                $participants = $es->getParticipants();
                if(!empty($participants))
                {
                    $data = $data + $participants;
                }
                              
            }
        }

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