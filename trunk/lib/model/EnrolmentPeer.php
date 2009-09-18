<?php

class EnrolmentPeer extends BaseEnrolmentPeer
{
   public static function countCurrentEnrolmentsOfUser($userId)
	{
	$c=new Criteria();
	$c->add(EnrolmentPeer::USER_ID, $userId);
	$c->add(EnrolmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
	$enr =  parent::doCount($c);
	return $enr;
	}
		

}
