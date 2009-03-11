<?php

/**
 * profile actions.
 *
 * @package    mattiussi
 * @subpackage profile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class profileActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex($request)
  {
        $this->name = $this->getUser()->getProfile()->getFullName();
		
        $this->appointments = $this->getUser()->getProfile()->getCurrentAppointments();

        $this->teams=$this->getUser()->getProfile()->getTeams();
	
   	$this->credentials=$this->getUser()->hasCredential('admin');
	
  }
}


