<?php

/**
 * Subclass for performing query and update operations on the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class sfGuardUserProfilePeer extends BasesfGuardUserProfilePeer
{
	
	public static function retrieveByUsername($username)
	{
	$c=new Criteria();
	$c->add(sfGuardUserPeer::USERNAME, $username);
	$t = sfGuardUserPeer::doSelectOne($c);
	return $t;
	}


	public static function retrieveAllUsers()
	{
	$c = new Criteria();
	$c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
	$c->addJoin(RolePeer::ID, sfGuardUserProfilePeer::ROLE_ID);
	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
	$t = self::doSelectJoinAll($c);
	return $t;
		
	}


	public static function retrieveTeachersWithAppointments()
	{
	$c = new Criteria();
	$c->addJoin(AppointmentPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
	$c->add(AppointmentPeer::YEAR_ID, sfConfig::get('app_config_current_year'));
	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
	$t = self::doSelect($c);
	return $t;

	}


}
