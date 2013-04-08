<?php

namespace WHM\Controller;

use WHM\Model\FlagDescriptor;
use WHM\Application;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\ManageFlag;

class ManageFlagDescriptor extends Controller implements IRedirectable
{    
    protected $em;
    protected $manageFlagDescriptor;
    
    public function __construct(array $args = null)
    {
        parent::__construct();
        $this->em = Application::em();
        $this->manageFlagDescriptor = new ManageFlag();
    }
    
    public function post()
    {        
        for($i = 1 ; $i <= 4; $i++)
        {
            $this->updateFlagDescriptor($i, $_POST['flag-descriptor-'.$i]);
        }
        
        $this->em->flush();
        $descriptors = $this->manageFlagDescriptor->getFlagDescriptors();
        
        $returnArray = array();
        foreach($descriptors as $descriptor)
        {
            $returnArray['descriptor' . $descriptor->getId()] = $descriptor->getMeaning();
        }
        echo json_encode($returnArray);        
    }
    
    private function updateFlagDescriptor($flagDescriptorId, $flagDescriptorValue)
    {
        if(isset($flagDescriptorValue) && $flagDescriptorValue)
        {
            error_log("id :".$flagDescriptorId .'/'.$flagDescriptorValue);
            $flagDescriptor = $this->em->find('WHM\Model\FlagDescriptor', $flagDescriptorId);
            $flagDescriptor->setMeaning($flagDescriptorValue);

            $this->em->persist($flagDescriptor);            
        }
    }

}

?>