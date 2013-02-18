<?php

namespace WHM\Model;
use WHM;
use WHM\Application;

/**
 * Manage entity household
 **/
class ManageHousehold {

	public static function createHousehold($form_data) {
		//include_once('Entity_Manager.php');
		//Objects to be saved
		$em = Application::em();


		$address = new Address();
		$household = new Household();
		$household_member = new HouseholdMember();

		//Preparing object to be saved
		$address->setStreet($form_data['address']);
		$address->setApp_number($form_data['appt_number']);
		$address->setCity($form_data['city']);
		$address->setPost_Code($form_data['postal_code']);
		$address->setProvince($form_data['province']);
		$em->persist($address);
		$em->flush();

		$household_member->setFirst_name("first_name");
		$household_member->setLast_name("last_name");
		$household_member->setWork_status("work_status");
		$household_member->setWelfare_number("welfare_number");
		$household_member->setReferal("referal");
		$household_member->setLanguage("language");
		$household_member->setMarital_status("marital");
		$household_member->setOrigin("origin");
		$em->persist($household_member);
		$em->flush();

		








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
}
?>