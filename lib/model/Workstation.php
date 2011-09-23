<?php

class Workstation extends BaseWorkstation
{
    private $_jobs;
    private $_state;
    private $_user; // the one that enabled internet access
  
    public function __toString()
    {
    return $this->getName();    
    }
    
    public function InternetEnable($status=true)
    {
        $this->setIsEnabled($status);
        $this->save();
        return $this;
    }
    
    public function setUser($user)
    {
      $this->_user=$user;
      return $this;
    }
    
    public function getUser()
    {
      return $this->_user;
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
    
    public function disableInternetAccess($user_id, $code, $sf_context)
    {
      // the code is only the username of the user that enabled internet connection
      // since it's not stored on the db, but is found on iptables comments, we'll pass it here
      
      $code=Generic::b64_unserialize($code);
      $user=$code['user'];
      $type=$code['type'];
      
      try
      {
        Generic::executeCommand(sprintf('workstation_disableinternetaccess %s %s', $this->getIpCidr(), $user), false);
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
