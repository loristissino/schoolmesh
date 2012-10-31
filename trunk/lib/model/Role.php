<?php

/**
 * Role class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class Role extends BaseRole
{
  public function __toString()
  {
      return $this->getMaleDescription();
  }
	
	public function getRoleDescriptionByGender($isMale=true)
	{
    if(!$this->getFemaleDescription())
    {
      return $this->getMaleDescription();
    }
		return ($isMale? $this->getMaleDescription(): $this->getFemaleDescription());
	}
  
  public function getUsersPlayingRole()
  {
     $userteam=RolePeer::retrieveUsersPlayingRole($this);
     return sizeof($userteam) ? $userteam : false;
  }

  public function countUsersPlayingRole()
  {
     return RolePeer::countUsersPlayingRole($this);
  }
  

}
