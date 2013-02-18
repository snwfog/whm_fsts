<?php

namespace WHM\Model;
use WHM;
use WHM\Application;

/**
 * Manage entity household
 **/
class ManageHousehold {
	private $em;

	public function __construct()
	{
		$this->em = Application::em();
	}

	public function createHousehold($form_data) {
		//include_once('Entity_Manager.php');
		//Objects to be saved

		$this->create_address($form_data);
		$this->create_member($form_data);

		$household = new Household();

		//Preparing object to be saved

		// $household->setPhone_number($phone_number);
		// $household->setHousehold_principal_id($id);
		// //$household->setAddress($address);
		// $em->persist($household);
		// $em->flush();

	}
	
	//Delete
	public static function removeHousehold($id) {
		$household = findHousehold($id);
		$em->remove($household);
		$em->flush();
	}
	
	//View
	public static function findAllHouseholds() {
		// to do
	}
	public static function findHousehold($id) {
		return $household = $em->find("Household", (int)$id);
	}

	//$data is type array
	private function create_member($data)
	{
		$household_member = new HouseholdMember();
		$household_member->setFirst_name($data["first_name"]);
		$household_member->setLast_name($data["last_name"]);
		$household_member->setWork_status($data["work_status"]);
		$household_member->setWelfare_number($data["welfare_number"]);
		$household_member->setReferal($data["referal"]);
		$household_member->setLanguage($data["language"]);
		$household_member->setMarital_status($data["marital"]);
		$household_member->setOrigin($data["origin"]);
		$household_member->setFirst_visit_date(date("Y-m-d H:i:s"));
		$this->em->persist($household_member);
		$this->em->flush();
		return $household_member;
	}

	private function create_address($data)
	{
		$address = new Address();
		$address->setStreet($data['address']);
		$address->setApp_number($data['appt_number']);
		$address->setCity($data['city']);
		$address->setPost_Code($data['postal_code']);
		$address->setProvince($data['province']);
		$this->em->persist($address);
		$this->em->flush();

		return $address;

	}
}
?>