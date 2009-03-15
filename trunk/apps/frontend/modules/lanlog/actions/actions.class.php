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
	$this->lanlog_list = LanlogPeer::retrieveOnline();
	}  

  public function executeCreate(sfWebRequest $request)
  {
//  $this->forward404Unless($request->isMethod('POST'), "");
  $this->checkParameters($request);

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
/*
  $this->internet=in_array('internet', $this->user->getAllPermissions());
  
   if ($this->internet)
        $lanlog->getWorkstation()->InternetEnable(true);
  
*/
   $this->autoEnableWorkstation($lanlog, true);


  }


  public function executeUpdate(sfWebRequest $request)
  {

  $this->checkParameters($request);

  $this->forward404Unless($lanlog=LanlogPeer::retrieveByUserAndWorkstation($this->user->getId(), $this->workstation->getId()), sprintf('User %s does not seem to be active on workstation %s',  $this->user->getUsername(), $this->workstation->getname()));

	  $lanlog->setIsOnline(false);
      $lanlog->save();  
	  $this->lanlog= $lanlog;  
     $this->autoEnableWorkstation($lanlog, false);

}


  protected function checkParameters(sfWebRequest $request)
	{
		
//   $this->forward404Unless($request->getPostParameter('token')==sfConfig::get('app_prelogin_token'), "Invalid token");
	
    $this->decodedUsername=chop(base64_decode($request->getParameter('username')));
    $this->forward404Unless($this->user = sfGuardUserProfilePeer::retrieveByUsername($this->decodedUsername, sprintf('Username does not exist (%s).', $this->decodedUsername)));

    $this->forward404Unless($this->workstation = WorkstationPeer::retrieveByNameAndIp($request->getParameter('workstation'), $request->getParameter('ip')), sprintf('Wokstation %s with IP address %s does not exist.', $request->getParameter('workstation'), $request->getParameter('ip')));
	
	}  


   protected function autoEnableWorkstation($lanlog, $active=false)
   {
   $this->internet=in_array('internet', $this->user->getAllPermissions());
  
   if ($this->internet)
        $lanlog->getWorkstation()->InternetEnable($active);
       
    }


}
