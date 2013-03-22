<?php
namespace WHM\Controller;
use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Application;
use \WHM\Model\ManageEvent;
use \WHM\Model\ManageAppointment;
use \WHM\Model\ManageHousehold;
use \WHM\Model\Timeslot;
use \WHM\Model\HouseholdMember;
use WHM\Controller\Event;
use DateTime;
use DateTimeZone;
use DateInterval;

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

    public function get($event_id= null)
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
            $allEvents = $this->mevent->getAllEventsByGroup();
            $this->data["allEvents"] = $this->event->formatEvents($allEvents);

            if(!is_null($event_id))
            {
                $event = $this->mevent->findEvent($event_id);
                $event = $this->event->formatEvents(array( 0 => $event));

                $this->data["event"] = $event[0];
                $this->display("report.stat.twig", $this->data);
    
           }
           else
           $this->display("report.stat.twig");   
    }

    public function post()
	{

         //Format Date to be used as object type DateTime
        $start_date = new DateTime();
        $start_date->setTimezone(new DateTimeZone(LOCALTIME));
        $end_date = new DateTime();
        $end_date->setTimezone(new DateTimeZone(LOCALTIME));
        $start_time = new DateTime();
        $start_time->setTimezone(new DateTimeZone(LOCALTIME));
        $currentYear = date('Y');
    


       /* if (isset($_POST))
        {
            $annualReport=$this->createAnnualReportForEvent($_POST["group-id"]);

            $data = array(
                           "participants"  =>  $annualReport
                    );

            print_r($data);   */

             if(isset($_POST["occurrence-type"]))
             {
                $repeat = array(   
                                    "monthly" => "1 month", 
                                    "yearly" => "1 year",
                );

                $incrementer = DateInterval::createFromDateString($repeat[$_POST["occurrence-type"]]);

                if($_POST["occurrence-type"] == "yearly"){
                    $end_date->setDate($currentYear, "1", "1");
                    $start_date->setDate($currentYear, "1", "1");
                    $start_date = $start_date->sub($incrementer);
                }

                if($_POST["occurrence-type"] == "monthly"){
                    //todo
                }

                $annualReport=$this->createReportForEvent($_POST["group-id"], $start_date, $end_date);

                 $data = array(
                   "participants"  =>  $annualReport
                 );

                 print_r($data);
                   
            
                

/*           header("Content-Type: text/plain");

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

         */
        }
        else
        {
            $this->display("report.stat.twig",$data);
        }
        
    }

    //Object are type Datetime
    public function createReportForEvent($eventGroupId, $startDateObject, $endDateObject)
    {
        $events = $this->mevent->getRelatedEvents($eventGroupId);
        $data = array();
        $count = 0;
     //   $allEvents = $this->mevent->getAllEvents();
        
        foreach ($events as $ev) 
        {
            echo $endDateObject->format("Y/m/d");
            if($ev->getStartDate() >= $startDateObject && $ev->getStartDate() <= $endDateObject){
                echo "mike";
                $participants = $this->getEventParticipants($ev); 
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