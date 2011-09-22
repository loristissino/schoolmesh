<?php

class Workstation extends BaseWorkstation
{
    private $_jobs;
  
    public function __toString()
    {
    return $this->getName();    
    }
    
    public function InternetEnable($status=true)
    {
        $this->setIsEnabled($status);
        $this->save();
    }
    
    public function setJobs($values)
    {
      $this->_jobs=$values;
      return $this;
    }
    
    public function getJobs()
    {
      return $this->_jobs;
    }

}
