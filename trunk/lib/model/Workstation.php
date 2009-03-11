<?php

class Workstation extends BaseWorkstation
{
    public function __toString()
    {
    return $this->getName();    
    }
    
    public function InternetEnable($status=true)
    {
        $this->setIsEnabled($status);
        $this->save();
    }
    
    
}
