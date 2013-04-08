<?php

namespace Test\Controller;

use Test\Controller\ControllerTestCase;
use Test\Controller\CreateHouseholdControllerTest;
use Test\Controller\FlagControllerTest;

class IntegrationTest extends ControllerTestCase
{
    function IntegrationCreateHouseholdAndFlag()
    {
        $formValues = array(
            "first-name" => "Georges",
            "last-name" => "John",
            "phone-number" => "514 999 9999",
            "sin-number" => "9999 - 999 - 999",
            "mcare-number" => "999 - 9999 - 999",
            "work_status" => "Employed",
            "welfare-number" => "9999 - 999 - 999",
            "referral" => "A good guy",
            "language" => "English",
            "marital-status" => "Single",
            "gender" => "M",
            "origin" => "Canada",
            "contact" => "514 222 - 2220",
        );

        $this->request('POST', '/household/new', $formValues);

        $formValues = array(
            "message" => "Missing Phone Number!",
            "household-i" => "1",
            "member-id" => "1",
            "flag-descriptor-id" => "2",
        );
        $this->request('POST', '/flag', $formValues);
        $crawler = $this->request('GET', '/household/5/9');
        $this->assertEquals(
                1, $crawler->filter('html:contains("John")')->count()
        );
        $this->assertEquals(
                1, $crawler->filter('html:contains("Warning")')->count()
        );
        
    }
    
    
}
?>
