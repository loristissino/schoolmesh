<?php

/**
 * profile actions.
 *
 * @package   schoolmesh
 * @subpackage profile
 * @author     Loris Tissino
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
	
  }

  public function executeGoogleapps($request)
  {
	
  }


}


