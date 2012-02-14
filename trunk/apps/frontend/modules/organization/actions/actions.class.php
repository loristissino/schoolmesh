<?php

/**
 * organization actions.
 *
 * @package    schoolmesh
 * @subpackage organization
 * @author     Loris Tissino <loris.tissino@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class organizationActions extends sfActions     // $userteam=RolePeer::retrieveUsersPlayingRole($keyrole);

{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->list=array();
    $this->keyroles=RolePeer::retrieveKeyRoles();
    
    foreach($this->keyroles as $keyrole)
    {
      $this->list[$keyrole->getId()]=array('keyrole'=>$keyrole, 'userteam'=>$keyrole->getUsersPlayingRole());
    }
    
  }
}
