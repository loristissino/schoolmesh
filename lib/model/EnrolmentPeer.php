<?php

/**
 * EnrolmentPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

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
