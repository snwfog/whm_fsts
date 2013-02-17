<?php

require_once("EntityManager.php");

class Household_Controller extends Controller_Core implements IRedirectable_Core
{
    public $data = array("errors" => array(), "form" => array());
    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        Helper_Core::backtrace();

    }

    public function get($args = null)
    {
        switch ($args) {
            case 'createHousehold':
                if (isset($_POST["registration_create"]))
                {
                    $this->data["form"] = $_POST;
                    $this->check_form($_POST);
            
               }
                else
                $this->display("household_create_form.twig");
                break;
            
            default:
                $data = array("first_name" => "wais");
                $this->display("household_view_form.twig", $data);
                break;
        }

        
		$household = new Household();
		$household->setHousehold_principal_id("123");
		$household->setPhone_number("514-6789999");
		$em->persist($household);
		$em->flush();
		echo "Created Household with ID " . $household->getId() . "\n";
		
			
       // $this->display("household_create_form.twig");
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

    public function post()
    {
        echo "This is a post";

        $householdModel = new Household();
        $householdMemberModel  = new HouseholdMember();
        $addressModel    = new Address();
    

        if ($household_instance = $householdModel->create_household($household_member_instance["id"], $address_instance["id"], $this)); 
        {
            
            $household_member_instance = $householdMemberModel ->create_householdMember($_POST["first_name"], $_POST["last_name"], $_POST["work_status"], $_POST["welfare_number"], $_POST["referal"], $_POST["language"], $_POST["martial_status"], $_POST["origin"], $_POST["medicare"]);
            $address_instance = $addressModel->create_address($_POST["address"], $_POST["city"], $_POST["province"], $_POST["country"], $_POST["postal_code"], $this);
        
            return $household_instance;

        } 

        $this->display("household_create_form.twig", $this->data);
        


    }



     public function check_form($form)
    {
        $householdModel = new HouseholdMember();
        
        if ($householdModel->exist_attribute("welfare_number", $_POST["welfare_number"]))
        {
            array_push($this->data["errors"], "welfare number Exist!");
        }

        if ($householdModel->exist_attribute("medicare", $_POST["medicare"]))
        {
            array_push($this->data["errors"], "medicare Exist!");
        }


        if (count($this->data["errors"]) > 0)
        {
            $this->display("household_create_form.twig", $this->data);
        }

        else
        {
            $this->post();
            $this->redirect("index.php?household");
        }

   
    }




}
