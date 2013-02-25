<?php

namespace Test\Controller;

use Test\Controller\ControllerTestCase;

class CreateHouseholdControllerTest extends ControllerTestCase
{

    function testNewHouseholdGet()
    {
        $crawler = $this->client->request('GET', 'household/new');
        $this->assertEquals(0, $crawler->filter('html:contains("new")')->count());
    }

    function testNewHouseholdPost()
    {
        $crawler = $this->client->request('POST', 'household/new');
        $this->assertEquals(0, $crawler->filter('html:contains("new")')->count());
    }

    function testNewHouseholdPostWithFormValues()
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

        $crawler = $this->client->request('POST', 'household/new', $formValues);
        $this->assertEquals(302, $this->client->getResponse()->getStatus());
        $this->assertContains('334/1000', $this->client->getResponse()->getHeader('location'));
        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("John")')->count()
        );
    }

}

?>
