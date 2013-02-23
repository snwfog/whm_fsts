<?php

namespace Test\Controller;

class Household_Controller_Test extends ControllerTestCase
{

    function testNewHousehold()
    {
        
    }

    function testRegisterHousehold()
    {
        
    }

    function testDisplayInformationForm()
    {
        
    }

    function testHouseholdWithoutArgsRedirectsToSearch()
    {
        $this->client->followRedirects(false);
        $this->request('GET', '/household');                        
        $this->AssertEquals(302, $this->client->getResponse()->getStatus()); 
        $this->AssertEquals('search', $this->client->getResponse()->getHeader('location'));
    }

    function testRemoveHousehold()
    {
        
    }

    function testFindMember()
    {
        
    }

    function testRemoveMember($id)
    {
        
    }

    function testEditHousehold($id)
    {
        
    }

    function testUpdateHousehold()
    {
        
    }

    function testNewDependency()
    {
        
    }

    function testAddMember()
    {
        
    }

}
