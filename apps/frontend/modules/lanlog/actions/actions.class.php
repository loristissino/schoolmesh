<?php

/**
 * lanlog actions.
 *
 * @package   schoolmesh
 * @subpackage lanlog
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class lanlogActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
	{
//	$this->lanlog_list = LanlogPeer::retrieveOnline();

// FIXME This must be reviewed in order to take in consideration users logged on (the network) and in (the application)
	$this->lanlog_list = sfGuardUserProfilePeer::retrieveOnline();

	}
  
  public function executeViewonline(sfWebRequest $request)
  {
    $this->forward404Unless($request->getParameter('token')==sfConfig::get('app_authentication_token'));
    $this->lanlog_list = LanlogPeer::retrieveOnline();
    $this->setTemplate('list');
  }
  
  public function executeViewbyuser(sfWebRequest $request)
  {
    $this->lanlog_list = LanlogPeer::retrieveByUserId($request->getParameter('id'));
    $this->setTemplate('list');
  }
  
  public function executeViewbyworkstation(sfWebRequest $request)
  {
    $this->lanlog_list = LanlogPeer::retrieveByWorkstationId($request->getParameter('id'));
    $this->setTemplate('list');
  }
  
  public function executeRegisterlogon(sfWebRequest $request)
  {
    if(!$this->checkParameters($request))
    {
      return sfView::ERROR;
    }
    
    if (!$lanlog=LanlogPeer::retrieveByUserAndWorkstation($this->user->getId(), $this->workstation->getId()))
    {
      $lanlog = new Lanlog();
      
      $lanlog->setUserId($this->user->getId());
      $lanlog->setWorkstationId($this->workstation->getId());

      $lanlog->setIsOnline(true);
      $this->type="new";  
    }
    else
    {
      $this->type="update";
      $lanlog->setUpdatedAt(time());
    }

    $lanlog->save();
  
    $this->lanlog = $lanlog;  

    $this->autoEnableWorkstation($lanlog, true);
  }


  public function executeRegisterlogoff(sfWebRequest $request)
  {
    if(!$this->checkParameters($request))
    {
      return sfView::ERROR;
    }
    
    if(!$lanlog=LanlogPeer::retrieveByUserAndWorkstation($this->user->getId(), $this->workstation->getId()))
    {
      $this->errormessage=sprintf('User %s does not seem to be active on workstation %s.',  $this->user->getUsername(), $this->workstation->getname());
      return sfView::ERROR;
    }

	  $lanlog->setIsOnline(false);
    $lanlog->save();  
    
    $this->type='deleted';

    $this->autoEnableWorkstation($lanlog, false);

}


  protected function checkParameters(sfWebRequest $request)
	{
    $this->forward404Unless($request->isMethod('POST'), 'Only POST requests are allowed.');
    
    $this->setTemplate('register');
    
    $this->username=$request->getParameter('username');
    $this->ip=$request->getParameter('ip');
    $this->workstationname=$request->getParameter('workstation');
    
    if($request->getParameter('token')!=sfConfig::get('app_authentication_token'))
    {
      $this->errormessage='Wrong token.';
      return false;
    }
    
    if(!$this->user=sfGuardUserPeer::retrieveByUsername($this->username))
    {
      $this->errormessage=sprintf('Invalid username: %s.', $this->username);
      return false;
    }
      
    if(!$this->workstation = WorkstationPeer::retrieveByNameAndIp($this->workstationname, $this->ip))
    {
      $this->errormessage=sprintf('Wokstation %s with IP address %s does not exist.', $this->workstationname, $this->ip);
      return false;
    }
    
    return true;
    
	}  


   protected function autoEnableWorkstation($lanlog, $active=false)
   {
     $this->internet=in_array('internet', $this->user->getAllPermissions());
     if ($this->internet)
     {
       if($active)
       {
         $tsc=new TimeslotsContainer(sfConfig::get('app_config_timeslotsfile'));
         
         Generic::logMessage('tsc', $tsc->getCurrentSlotBegin());
         Generic::logMessage('tsc', $tsc->getEleventhHour());
         
         $this->result=$lanlog->getWorkstation()->enableInternetAccess(
          $this->user->getId(),
          $tsc->getCurrentSlotBegin(),
          $tsc->getEleventhHour(),
          $this->user->getUsername(), 
          $this->getContext()
          );
        }
        else
        {
         $this->result=$lanlog->getWorkstation()->disableInternetAccess(
          $this->user->getId(), 
          Generic::b64_serialize(array('user'=>$this->user->getUsername(), 'type'=>'allday')),
          $this->getContext()
          );
        }
     }
   }


}
