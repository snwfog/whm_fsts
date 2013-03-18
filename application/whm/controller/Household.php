<?php

namespace WHM\Controller;

use \WHM\Helper;
use \WHM\Controller;
use \WHM\IRedirectable;
use \WHM\Model\ManageHousehold;
use \WHM\Model\ManageFlag;
use \WHM\Model\Flag;
use \WHM\Model\HouseholdMember;
use \WHM\Model\ManageEvent;
use \WHM\Controller\ControllerHelper;

class Household extends Controller implements IRedirectable
{
    public $data = array( "errors" => array(), "form" => array());
    private $manageHousehold;
    private $manageFlag;
    private $manageEvents;
    private $flag;
    private $helper;


    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //Helper::backtrace();
        $this->helper = new ControllerHelper();
        $this->manageHousehold = new ManageHousehold();
        $this->manageFlag = new ManageFlag();
        $this->manageEvents = new ManageEvent();
        $this->flag = new Flag();


    }

    public function get($household_id = null, $member_id = null)
    {
        if (isset($_GET["household_id"]))
        {
            $household_id = $_GET["household_id"];
        }

        if(!is_null($household_id)){
            //Get household and as default, get household principal if specific member is not specified.
            $household = $this->manageHousehold->findHousehold($household_id);
            if(is_null($member_id)){
                $member = $household->getHouseholdPrincipal();
            }else{
                $member = $this->manageHousehold->findMember($member_id);
            }

            $data = $this->formatHouseholdInfo($household, $member);
            
            //Get flag descriptor for creating flags
            $flagDescriptors = $this->manageFlag->getFlagDescriptors();
            $formattedDescriptor = $this->formatDescriptor($flagDescriptors);

            //Get member flags
            $flags = $member->getFlags();
            $formattedFlags = $this->formatMessage($flags);
            
        //   $flagNumber = $this->flagNum($formattedFlags);

            //Get Events to make appointment
            $eventcontroller = new \WHM\Controller\Event; 
            $eventdraft=$this->manageEvents->getUpComingEvents();
            $events=$eventcontroller->getIndexedEvents($eventdraft, $household_id, $member_id);

            $data = array(
                            "household"         =>  $data,
                            "flagDescriptors"   =>  $formattedDescriptor,
                            "flags"             =>  $formattedFlags,
      //                    "flag_number"       =>  $flagNumber,
                            "events"            =>  $events
                    );
            $this->display("household.create.twig", $data);
        }
        else
        {
            $this->redirect("search");
        }

    }



    public function put()
    {

        $content = "charles=yang&mike=pham";
        file_put_contents("php://output", $content);
        $var = null;
        echo "before marker";
        $unparsed = file_get_contents("php://input");
        echo $unparsed."unique<br>";

        echo $unparsed."secondtime<br>";
        parse_str($unparsed, $var);
        print_r($var);

    }

    /**
     * Update household
     *
     *
     */
    public function post()
    {
        $this->manageHousehold->updateHousehold($_POST);
        $this->redirect('household/'.$_POST["household-id"]."/".$_POST["member-id"] );
    }

    public function setHousehold($household)
    {
       $this->household = $household;
    }

  /*  public function delete($household_id)
    {
    $manageHouse = new ManageHousehold();
    $household_id = $manageHouse->getId();
    $manageHouse->removeHousehold($household_id);
    }
*/


    public function formatHouseholdInfo($household, $member)
    {
        
        $principal = $household->getHouseholdPrincipal();
        $address = $household->getAddress();
        $dependents = $household->getMembers();
        
        //Get list of Members
        $members = array();
        foreach ($dependents as $dependent){
            if (($principal->getId() == $dependent->getId())) {
                $members["principal"] = array(
                                        "member-id"  => $dependent->getId(),
                                        "first-name" => $dependent->getFirstName(),
                                        "last-name"  => $dependent->getLastName(),
                                        "gender"     => $dependent->getGender(),
                                        "active"     => $member->getId() == $dependent->getId()? TRUE : FALSE,
                                        "principal"  => true,
                                 );
            }else{
                array_push($members, array(
                                            "member-id"  => $dependent->getId(),
                                            "first-name" => $dependent->getFirstName(),
                                            "last-name"  => $dependent->getLastName(),
                                            "gender"     => $dependent->getGender(),
                                            "active"     => $member->getId() == $dependent->getId()? TRUE : FALSE,
                                     ));
            } 
        }

        //Get detailed info of displayed member
        $formatMember = $this->helper->formatMember(array( 0 => $member));
        $data = array(
                        "house-number"    => $address->getHouseNumber(),
                        "street"    => $address->getStreet(),
                        "apt-number" => $address->getAptNumber(),
                        "postal-code"   => $address->getPostalCode(),
                        "district"   => $address->getDistrict(),
                );
        $data = array_merge($formatMember[0], $data);
        $data["members"] = $members;
        return $data;
    }

    private function formatDescriptor($flagDescriptors)
    {
        $data = array();
        $count = 0;
        foreach( $flagDescriptors as $flagD){
            $data[$count++] = array(
                                  "flag-id" => $flagD->getId(),
                                  "flag-color" => $flagD->getColor(),
                                  "flag-meaning" => $flagD->getMeaning(),
                              );
        }

        return $data;
    }

    private function formatMessage($flagMessage)
    {
      //  $household = new Household();
        $member = new HouseholdMember();

        $data = array();
        $count = 0;
        foreach( $flagMessage as $flag){
            $flagD = $flag->getDescriptor();
            $data[$count++] = array
            (
                "member-id" => $member->getId(),
                "flag-id" => $flag->getId(),
                "message" => $flag->getMessage(),
                "flag-color" => $flagD->getColor(),
                "tag-color" => (!strcasecmp($flagD->getColor(),
                    "danger")) ? "important" : $flagD->getColor(),
                "alert-color" => (!strcasecmp($flagD->getColor(),
                    "danger")) ? "error" : $flagD->getColor(),
                "flag-alternative-color" => $flagD->getAlternativeColor(),
                "flag-meaning" => $flagD->getMeaning(),
            );
        }

        return $data;      
    }

    private function flagNum($flagN)
    {
        $data = array();
        $count = 0;
        foreach( $flagN as $manageFlag){
            $manageFlag = new ManageFlag();
            $data[$count++] = array(
                                    "flagn" => $manageFlag->flagNumber(),
                              );
        }

        return $data;
    }
}

