<?php

class Workstation extends BaseWorkstation
{
    private $_jobs;
    private $_state;
  
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
    
    public function getState()
    {
      // for compatibility with workflow event manager
      return $this->_state;
    }
    
    public function setState($v)
    {
      // for compatibility with workflow event manager
      $this->_state=$v;
    }
    
    public function disableInternetAccess($user_id, $sf_context)
    {
      try
      {
        Generic::executeCommand(sprintf('workstation_disableinternetaccess %s', $this->getIpCidr()), false);
        $result['result']='notice';
        $result['message']='Internet access disabled for the workstation.';
        $this->addWfevent(
          $user_id,
          'Internet access disabled',
          null,
          1,
          $sf_context
          );
        
      }
      catch (Exception $e)
      {
        $result['result']='error';
        $result['message']='Internet access could not be disabled for the workstation.';
      }
      return $result;
      
    }

    public function enableInternetAccess($user_id, $from, $to, $username, $sf_context)
    {
      try
      {
        Generic::executeCommand(sprintf('workstation_enableinternetaccess %s %s %s %s', $this->getIpCidr(), $from, $to, $username), false);
        $result['result']='notice';
        $result['message']='Internet access enabled for the workstation.';
        $this->addWfevent(
          $user_id,
          'Internet access enabled',
          null,
          2,
          $sf_context
          );
        }
      catch (Exception $e)
      {
        $result['result']='error';
        $result['message']='Internet access could not be enabled for the workstation.';
      }
      return $result;
      
    }

  public function addWfevent($userId, $comment='', $i18n_subs, $state=0, $sf_context=null)
  {
    Generic::logMessage('wfevent', $state);
    Generic::addWfevent($this, $userId, $comment, $i18n_subs, $state, $sf_context);
    return $this;
  }
  
  public function getWorkflowLogs()
	{
		$t = WfeventPeer::retrieveByClassAndId('Workstation', $this->getId(), true);
		if ($t)
			return $t;
		else
			return NULL;
	}


}
