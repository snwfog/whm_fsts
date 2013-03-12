<?php

namespace Test\Controller;


class Household_Controller_Test extends ControllerTestCase
{
    
    //passed
    function testGet()
    {
        $crawler = $this->request('GET', '/household/1/1');
        $this->assertEquals(200, $this->client->getResponse()->getStatus());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("VIERA")')->count());
    }
    //passed  
    function testPost()
    {
         $formValues = array(
            "household-id" => "1",
            "member-id" => "2",
            "first-name" => "Kahan",
            "last-name" => "Xianadu",
            "phone-number" => "514 999 9999",
            "sin-number" => "9945 - 799 - 999",
            "mcare-number" => "699 - 9599 - 599",
            "work_status" => "Unemployed",
            "welfare-number" => "6799 - 999 - 999",
            "referral" => "A scum",
            "language" => "English",
            "marital-status" => "Single",
            "gender" => "M",
            "origin" => "Canada",
            "contact" => "514 452 - 2320",
            "house-number" => "899",
            "street" => "NewMan",
            "apt-number" => "66",
            "city" => "Vancouver",
            "postal-code" => "H1N3Y5",
            "province" => "QC",            
        );

        $crawler = $this->request('POST', '/household/1', $formValues);
        //$this->assertEquals(200, $this->client->getResponse()->getStatus());        
        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("Kahan")')->count()
        );
    }

    //failed
    function testDelete()
    {
        $this->request('DELETE', '/household/1');
        $crawler = $this->request('GET', '/household/1');
        //$this->assertEquals(200, $this->client->getResponse()->getStatus());
        $this->assertEquals(0, $crawler->filter('html:contains("VIERA")')->count());
    }
 
    //passed
    function testHouseholdWithoutArgsRedirectsToSearch()
    {
        $this->client->followRedirects(false);
        $this->request('GET', '/household');                        
        $this->AssertEquals(302, $this->client->getResponse()->getStatus()); 
        $this->assertContains('search', $this->client->getResponse()->getHeader('location'));
    } 

}