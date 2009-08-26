<?php

/**
 * passwordreset actions.
 *
 * @package    schoolmesh
 * @subpackage passwordreset
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class passwordresetActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

	$this->userlist=sfGuardUserProfilePeer::retrieveUsersOfGuardGroup('student');
	$this->available_accounts=sfConfig::get('app_config_accounts');

	}
}
