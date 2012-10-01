<?php

/**
 * UserTeam class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class UserTeam extends BaseUserTeam
{
  public function getFirstName()
  {
  return $this->getsfGuardUser()->getProfile()->getFirstName();    
  }
  public function getLastName()
  {
      return $this->getsfGuardUser()->getProfile()->getLastName();
  }
	
	public function __toString()
	{
		return $this->getTeam()->getDescription();
	}
  
  public function getUnserializedDetails()
  {
    return unserialize($this->getDetails());
  }
}
