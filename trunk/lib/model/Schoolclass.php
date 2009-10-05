<?php

/**
 * Subclass for representing a row from the 'schoolclass' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Schoolclass extends BaseSchoolclass
{

  public function __toString()
  {
        return $this->getShortcut(); 
  }
  
  public function getShortcut()
  {
        return $this->getId();
//        return $this->getGrade() . $this->getSection() . $this->getAddress(); 
 
  }

  public function getFullDescription()
  {
        return $this->getGrade() . $this->getSection() . $this->getAddress()->getFullDescription(); 
 
  }

	public function getCurrentEnrolments()
	{
		
		$c=new Criteria();
		$c->add(EnrolmentPeer::SCHOOLCLASS_ID, $this->getId());
		$c->add(EnrolmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
		$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
		$c->addJoin(EnrolmentPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
		return EnrolmentPeer::doSelectJoinAll($c);
	}


}
