<?php

namespace WHM\Controller;

use WHM\Model\FlagDescriptor;
use WHM\Application;
use WHM\Controller;
use WHM\IRedirectable;

class ManageFlag extends Controller implements IRedirectable
{    
    protected $em;

    public function __construct(array $args = null)
    {
        parent::__construct();
        $this->em = Application::em();
    }
    
    public function post()
    {        
        for($i = 1 ; $i <= 4; $i++)
        {
            $this->updateFlagDescriptor($i, $_POST['flag-descriptor-'.$i]);
        }
        
        $this->em->flush();
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
