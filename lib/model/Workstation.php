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
    
    public function disableInternetAccess()
    {
      try
      {
        Generic::executeCommand(sprintf('workstation_disableinternetaccess %s', $this->getIpCidr()), false);
        $result['result']='notice';
        $result['message']='Internet access disabled for the workstation.';
      }
      catch (Exception $e)
      {
        $result['result']='error';
        $result['message']='Internet access could not be disabled for the workstation.';
      }
      return $result;
      
    }

}
