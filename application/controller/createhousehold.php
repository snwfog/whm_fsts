<?php

class CreateHousehold_Controller extends Controller_Core implements IRedirectable_Core
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
        $this->display("household_create_form.twig");
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

        if (isset($_POST))
        {
            $this->data["form"] = $_POST;
            print_r($this->data);
            $this->check_form($this->data["form"]);

        }



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

        if ($householdModel->exist_attribute("welfare_number", $form["welfare_number"]))
        {
            array_push($this->data["errors"], "welfare number Exist!");
        }

        if ($householdModel->exist_attribute("medicare", $form["medicare"]))
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
