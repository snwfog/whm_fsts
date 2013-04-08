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
use PHPExcel;
use PHPExcel_Writer_Excel2007;
use PHPExcel_IOFactory;

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
        $start_date = $start_date->setTimezone(new DateTimeZone(LOCALTIME));
        $end_date = new DateTime();
        $end_date = $end_date->setTimezone(new DateTimeZone(LOCALTIME));
        $start_time = new DateTime();
        $start_time = $start_time->setTimezone(new DateTimeZone(LOCALTIME));
        $currentYear = date('Y');

        if(isset($_POST["occurrence-type"]))
        {
            $repeat = array(   
                                "monthly" => "1 month", 
                                "yearly" => "1 year",
                                "fiscal" => "1 year",
                      );

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

            $motherTongueReport=$this->mevent->eventStatistic(
                                                               "HouseholdMember",
                                                               "mother_tongue",
                                                               $_POST["group-id"], 
                                                               $start_date, $end_date
                                              );
            $originReport=$this->mevent->eventStatistic(  
                                                          "HouseholdMember",
                                                          "origin", 
                                                          $_POST["group-id"], 
                                                          $start_date, $end_date
                                        );
            $incomeReport=$this->mevent->eventStatistic(
                                                        "HouseholdMember",
                                                        "income",$_POST["group-id"], 
                                                        $start_date, 
                                                        $end_date
                                        );
            $postalCodeReport=$this->mevent->eventStatistic(
                                                              "Address",
                                                              "postal_code",
                                                              $_POST["group-id"], 
                                                              $start_date, 
                                                              $end_date
                                            );
            $districtReport=$this->mevent->eventStatistic(
                                                            "Address",
                                                            "district",
                                                            $_POST["group-id"], 
                                                            $start_date, 
                                                            $end_date
                                          );
            $workStatusReport=$this->mevent->eventStatistic(
                                                              "HouseholdMember",
                                                              "work_status",
                                                              $_POST["group-id"],
                                                              $start_date,
                                                              $end_date
                                            );
            $maritalStatusReport= $this->mevent->eventStatistic(
                                                                  "HouseholdMember",
                                                                  "marital_status",
                                                                  $_POST["group-id"],
                                                                  $start_date,
                                                                  $end_date
                                                );
            $totalMemberEvent= $this->mevent->eventStatistic(
                                                              "HouseholdMember",
                                                              "id",
                                                              $_POST["group-id"],
                                                              $start_date,
                                                              $end_date
                                              );


            $numberOfVisitsStatistic = ManageEvent::getNumberOfVisits(
                                                                      $_POST["group-id"],
                                                                      $start_date,
                                                                      $end_date
                                                    );
            
            $totalWorkStatus = array_sum($workStatusReport);
            $totalMotherTongue = array_sum($motherTongueReport);
            $totalOrigin = array_sum($originReport);
            $totalPostalCode = array_sum($postalCodeReport);
            $totalDistrict = array_sum($districtReport);
            $totalMaritalStatus = array_sum($maritalStatusReport);
            $data = array(
                          "mother-tongue"  =>  $motherTongueReport,
                          "origin" => $originReport,
                          "income" => $incomeReport,
                          "postal-code" => $postalCodeReport,
                          "district" => $districtReport,
                          "work-status" => $workStatusReport,
                          "marital-status" =>$maritalStatusReport,
                          "visit"=> $numberOfVisitsStatistic,
                     //     "totalIndividual" =>
                    );



            $totalMemberEvent = array_sum($totalMemberEvent);

            $event = $this->mevent->findEvent($_POST["group-id"]);
            $objPHPExcel = new PHPExcel();

            // Set properties
            echo date('H:i:s') . " Set properties\n";
            $objPHPExcel->getProperties()->setCreator("WELCOME HALL MISSION");
            $objPHPExcel->getProperties()->setLastModifiedBy("WHM");
            $objPHPExcel->getProperties()->setTitle("");
            $objPHPExcel->getProperties()->setSubject("");
            $objPHPExcel->getProperties()->setDescription("");


            // Add some data
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Welcome Hall Mission');
            $objPHPExcel->getActiveSheet()->SetCellValue('A2', "Summar Report from ".$start_date->format("M d, Y")." to ". $end_date->format("M d, Y"));
            $objPHPExcel->getActiveSheet()->SetCellValue('A3', "Event ID: ".$event->getId());
            $objPHPExcel->getActiveSheet()->SetCellValue('A4', "Event Name: ".$event->getName());
            $objPHPExcel->getActiveSheet()->SetCellValue('H4', "Dist Fam Units: ".$totalMemberEvent);


            //WorkStatus and Mother Tongue
            $objPHPExcel->getActiveSheet()->SetCellValue('B8', "Work Status");
            $workrow = 9;
            $motherrow = $workrow;

            foreach ($data["work-status"] as $key => $value){
                if(empty($key)){
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('B'.$workrow, "Not Specified");
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('C'.$workrow, $value);
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('D'.$workrow, round( ((float)$value/(float)$totalWorkStatus)*100, 1)."%");
                }else{
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('B'.$workrow, $key);
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('C'.$workrow, $value);
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('D'.$workrow, round( ((float)$value/(float)$totalWorkStatus)*100, 1)."%");
                }
                ++$workrow;
            }

            $objPHPExcel->getActiveSheet()->SetCellValue('F8', "Mother Tongue");
            
            foreach ($data["mother-tongue"] as $key => $value){
                if(empty($key)){
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('F'.$motherrow, "Not Specified");
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('G'.$motherrow, $value);
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('H'.$motherrow, round( ((float)$value/(float)$totalMotherTongue)*100, 1)."%");
                }else{
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('F'.$motherrow, $key);
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('G'.$motherrow, $value);
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('H'.$motherrow, round( ((float)$value/ (float)$totalMotherTongue)*100, 1)."%");
                }
                ++$motherrow;
            }


                        
            //origin and marital
            
            $originrow = $workrow > $motherrow ? $workrow+2 : $motherrow+2;
            $maritalrow = $originrow;

            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$originrow, "Ethnic Origin");
            ++$originrow;
            foreach ($data["origin"] as $key => $value){
                if(empty($key)){
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('B' . $originrow, "Not Specified");
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('C' . $originrow, $value);
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('D' . $originrow, round(((float)$value/(float)$totalOrigin)*100, 1)."%");
                }else{
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('B' . $originrow, $key);
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('C' . $originrow, $value);
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('D' . $originrow, round(((float)$value/(float)$totalOrigin)*100, 1)."%");
                }
                ++$originrow;
            }

            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$maritalrow, "Fam Composition");
            ++$maritalrow;
            foreach ($data["marital-status"] as $key => $value){
                if(empty($key)){
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('F' . $maritalrow, "Not Specified");
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('G' . $maritalrow, $value);
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('H' . $maritalrow, round(((float)$value/(float)$totalMaritalStatus)*100, 1)."%");
                }else{
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('F' . $maritalrow, $key);
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('G' . $maritalrow, $value);
                   $objPHPExcel->getActiveSheet()
                               ->SetCellValue('H' . $maritalrow, round(((float)$value/(float)$totalMaritalStatus)*100, 1)."%");

                }
                ++$maritalrow;
            }



            $visitrow = $originrow > $maritalrow ? $originrow+2 : $maritalrow+2;
            $individrow = $visitrow;

            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$visitrow, "Number of visits");
            ++$visitrow;
            foreach ($data["visit"] as $key => $value){
                if(empty($key)){
                   $objPHPExcel->getActiveSheet()->SetCellValue('B'.$visitrow, "Not Specified");
                   $objPHPExcel->getActiveSheet()->SetCellValue('C'.$visitrow, $value);
                   $objPHPExcel->getActiveSheet()->SetCellValue('D'.$visitrow, round(((float)$value/(float)$totalMemberEvent)*100,1)."%");
                }else{
                   $objPHPExcel->getActiveSheet()->SetCellValue('B'.$visitrow, $key);
                   $objPHPExcel->getActiveSheet()->SetCellValue('C'.$visitrow, $value);
                   $objPHPExcel->getActiveSheet()->SetCellValue('D'.$visitrow, round(((float)$value/(float)$totalMemberEvent)*100,1)."%");
                }
                ++$visitrow;
            }

/*  TO BE DONE

            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$individrow, "Total Individual");
            ++$individrow;
            foreach ($data["total-individual"] as $key => $value){
                if(empty($key)){
                   $objPHPExcel->getActiveSheet()->SetCellValue('F'.$individrow, "Not Specified");
                   $objPHPExcel->getActiveSheet()->SetCellValue('G'.$individrow, $value);
          //         $objPHPExcel->getActiveSheet()->SetCellValue('H'.$individrow, round($value/$totalIndividual,1)."%");
                }else{
                   $objPHPExcel->getActiveSheet()->SetCellValue('F'.$individrow, $key);
                   $objPHPExcel->getActiveSheet()->SetCellValue('G'.$individrow, $value);
            //       $objPHPExcel->getActiveSheet()->SetCellValue('H'.$individrow, round($value/$totalIndividual,1)."%");

                }
                ++$individrow;
            }

*/


            // Rename sheet
            echo date('H:i:s') . " Rename sheet\n";
            $objPHPExcel->getActiveSheet()->setTitle('Statistic');

                    
            // Save Excel 2007 file
            // We'll be outputting an excel file
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
            ob_end_clean();
            $fileName = $start_date->format("M_Y")."_report.xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=". $fileName);
            $objWriter->save("php://output");

        }
        else
        {
            $this->display("report.stat.twig", $data);
        }
        
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

}