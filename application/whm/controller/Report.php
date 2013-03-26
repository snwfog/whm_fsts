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
        $currentMonth = date('m');
    


 

             if(isset($_POST["occurrence-type"]))
             {
                $repeat = array(   
                                    "monthly" => "1 month", 
                                    "yearly" => "1 year",
                                    "fiscal" => "1 year",
                );
                
            //    $months = array_keys(int($months));
            //    print_r($months);

                $incrementer = DateInterval::createFromDateString($repeat[$_POST["occurrence-type"]]);

                if($_POST["occurrence-type"] == "yearly")
                {
                    $end_date->setDate($currentYear, "1", "1");
                    $start_date->setDate($currentYear, "1", "1");
                    $start_date = $start_date->sub($incrementer);
                }

                 if($_POST["occurrence-type"] == "fiscal")
                {
                    $end_date->setDate($currentYear, "10", "1");
                    $start_date->setDate($currentYear, "10", "1");
                    $start_date = $start_date->sub($incrementer);
                    $oneDay = DateInterval::createFromDateString("1 day");
                    $end_date->sub($oneDay);
                    print_r($start_date);
                    print_r($end_date);
                }

                if($_POST["occurrence-type"] == "monthly")
                {
                        $month = $_POST["monthly-report"];                  
                        $start_date->setDate($currentYear, (int) $month, "1");
                        $end_date->setDate($currentYear, (int) $month, "1");

                        $oneMonth = DateInterval::createFromDateString("1 month");
                        $oneDay = DateInterval::createFromDateString("1 day");
                        $end_date->add($oneMonth)->sub($oneDay);
                  
                }

                $report=$this->createReportForEvent($_POST["group-id"], $start_date, $end_date);
                $originReport=$this->createOriginReportForEvent($_POST["group-id"], $start_date, $end_date);
                $incomeReport=$this->createIncomeReportForEvent($_POST["group-id"], $start_date, $end_date);
                $postalCodeReport=$this->createPostalCodeReportForEvent($_POST["group-id"], $start_date, $end_date);
                $districtReport=$this->createDistrictReportForEvent($_POST["group-id"], $start_date, $end_date);
            //    $workStatusReport=$this->createWorkStatusReportForEvent($_POST["group-id"], $start_date, $end_date);
                 $data = array(
                   "participants"  =>  $report,
                   "origin" => $originReport,
                   "income" => $incomeReport,
                   "postal-code" => $postalCodeReport,
                   "district" => $districtReport,
            //       "work-status" => $workStatusReport,
                 );

                 print_r($data);
                   
            
         /*      

            header("Content-Type: text/plain");

            // filename for download
            $filename = "report_" . date('Y-m-d') . ".xls";

            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Content-Type: application/vnd.ms-excel");
              
            $flag = false;
            foreach($data as $row) 
            {
                $data = array(
                           "participants"  =>  $report,
                           "origin" => $originReport,
                           "income" => $incomeReport,
                           "postal-code" => $postalCodeReport,
                           "district" => $districtReport,
                  //         "work-status" => $workStatusReport,
                    );

                if(!$flag) 
                {
                    // display field/column names as first row
              //  echo implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
                }
              //  echo implode("\t", array_values($row)) . "\r\n";
             }

              
            exit();
     
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
            if($ev->getStartDate() >= $startDateObject && $ev->getStartDate() <= $endDateObject){
                $participants = $this->getEventParticipants($ev); 
                foreach ($participants as $member) 
                { 
                $household = $member->getHousehold();
                $address = $household->getAddress();  
                $data[$count++] = array( 
                            "mother-tongue"  => $member->getMotherTongue(),
                     //       "work-status"  => $member->getWorkStatus(),
                      //      "origin"   => $member->getOrigin(),
                     /*       "income" => $member->getIncome(),
                            "postal-code"   => $address->getPostalCode(),
                            "district" => $address->getDistrict(),  */
                            );

                }
            //    $result =  array_unique($data);
          //      $data2 = array_count_values(array_map('strlen',array_keys($data)));
         //       $data = array_map("unserialize", array_unique(array_map("serialize", $data)));
         //       $data = call_user_func_array('array_merge', $data);
         //       $counts = var_export(array_count_values(array_map('strlen', array_keys($data))));
              //  var_dump($counts);

               
                foreach($data as $item) 
                { 
            
                   //  $count= array_count_values($item);
                     $count = array_count_values(array_map(function($item) 
                    {
                     return $item['mother-tongue'];
                    }, $data));
                   
                } 

            }
        }
        
        return $count;
    //    return $data;
     //   return $counts;
    }

    //Object are type Datetime
    public function createWorkStatusReportForEvent($eventGroupId, $startDateObject, $endDateObject)
    {
        $events = $this->mevent->getRelatedEvents($eventGroupId);
        $data = array();
        $count = 0;
     //   $allEvents = $this->mevent->getAllEvents();
        
        foreach ($events as $ev) 
        {
            if($ev->getStartDate() >= $startDateObject && $ev->getStartDate() <= $endDateObject){
                $participants = $this->getEventParticipants($ev); 
                foreach ($participants as $member) 
                { 
                    $household = $member->getHousehold();
                    $address = $household->getAddress();  
                    $data[$count++] = array( 
                                "work-status" => $member->getWorkStatus(),
                        
                                );
                }
          
               
                foreach($data as $item) 
                { 
                     $count = array_count_values(array_map(function($item) 
                    {
                     return $item['work-status'];
                    }, $data));
                   
                } 

            }
        }
        
        return $count;
    }



    //Object are type Datetime
    public function createOriginReportForEvent($eventGroupId, $startDateObject, $endDateObject)
    {
        $events = $this->mevent->getRelatedEvents($eventGroupId);
        $data = array();
        $count = 0;
     //   $allEvents = $this->mevent->getAllEvents();
        
        foreach ($events as $ev) 
        {
            if($ev->getStartDate() >= $startDateObject && $ev->getStartDate() <= $endDateObject){
                $participants = $this->getEventParticipants($ev); 
                foreach ($participants as $member) 
                { 
                    $household = $member->getHousehold();
                    $address = $household->getAddress();  
                    $data[$count++] = array( 
                                "origin"   => $member->getOrigin(),
                        
                                );
                }
          
               
                foreach($data as $item) 
                { 
                     $count = array_count_values(array_map(function($item) 
                    {
                     return $item['origin'];
                    }, $data));
                   
                } 

            }
        }
        
        return $count;
    }



    //Object are type Datetime
    public function createIncomeReportForEvent($eventGroupId, $startDateObject, $endDateObject)
    {
        $events = $this->mevent->getRelatedEvents($eventGroupId);
        $data = array();
        $count = 0;
     //   $allEvents = $this->mevent->getAllEvents();
        
        foreach ($events as $ev) 
        {
            if($ev->getStartDate() >= $startDateObject && $ev->getStartDate() <= $endDateObject){
                $participants = $this->getEventParticipants($ev); 
                foreach ($participants as $member) 
                { 
                $household = $member->getHousehold();
                $address = $household->getAddress();  
                $data[$count++] = array( 
                            "income" => $member->getIncome(),
                            );

                }
             
                foreach($data as $item) 
                { 
                 $count = array_count_values(array_map(function($item) 
                {
                 return $item['income'];
                }, $data));
                   
                } 

            }
        }
        
        return $count;
    }



     //Object are type Datetime
    public function createPostalCodeReportForEvent($eventGroupId, $startDateObject, $endDateObject)
    {
        $events = $this->mevent->getRelatedEvents($eventGroupId);
        $data = array();
        $count = 0;
     //   $allEvents = $this->mevent->getAllEvents();
        
        foreach ($events as $ev) 
        {
            if($ev->getStartDate() >= $startDateObject && $ev->getStartDate() <= $endDateObject){
                $participants = $this->getEventParticipants($ev); 
                foreach ($participants as $member) 
                { 
                    $household = $member->getHousehold();
                    $address = $household->getAddress();  
                    $data[$count++] = array( 
                                "postal-code"   => $address->getPostalCode(),
                                );

                }
                foreach($data as $item) 
                { 
                     $count = array_count_values(array_map(function($item) 
                    {
                     return $item['postal-code'];
                    }, $data));
                   
                } 

            }
        }
        
        return $count;
    }



     //Object are type Datetime
    public function createDistrictReportForEvent($eventGroupId, $startDateObject, $endDateObject)
    {
        $events = $this->mevent->getRelatedEvents($eventGroupId);
        $data = array();
        $count = 0;
     //   $allEvents = $this->mevent->getAllEvents();
        
        foreach ($events as $ev) 
        {
            if($ev->getStartDate() >= $startDateObject && $ev->getStartDate() <= $endDateObject){
                $participants = $this->getEventParticipants($ev); 
                foreach ($participants as $member) 
                { 
                    $household = $member->getHousehold();
                    $address = $household->getAddress();  
                    $data[$count++] = array(
                                 "district" => $address->getDistrict(),  
                                );
                    }
           
                foreach($data as $item) 
                { 
                     $count = array_count_values(array_map(function($item) 
                    {
                     return $item['district'];
                    }, $data));
                       
                } 

            }
        }
        
        return $count;
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