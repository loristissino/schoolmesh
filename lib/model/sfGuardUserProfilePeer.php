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


	public static function retrieveUsersForGoogleApps()
	{
		$c = new Criteria();
		$c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
		$c->add(sfGuardUserProfilePeer::GOOGLEAPPS_ACCOUNT_TEMPORARY_PASSWORD, '', Criteria::GREATER_THAN);
		$c->add(sfGuardUserProfilePeer::GOOGLEAPPS_ACCOUNT_APPROVED_AT, 0, Criteria::GREATER_THAN);
		$t = self::doSelectJoinsfGuardUser($c);
		
		return $t;
	}

	public static function retrieveAllUsers($sortby='', $filter='', $filtered_role_id='', $filtered_schoolclass_id='')
	{
	$c = new Criteria();
	$c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
	$c->addJoin(RolePeer::ID, sfGuardUserProfilePeer::ROLE_ID);
	
	if ($filter=='set')
	{
		if ($filtered_role_id!='')
		{
			$c->add(sfGuardUserProfilePeer::ROLE_ID, $filtered_role_id);
		}
		if ($filtered_schoolclass_id!='')
		{
			$c->addJoin(sfGuardUserProfilePeer::USER_ID, EnrolmentPeer::USER_ID, Criteria::LEFT_JOIN);
			$c->add(EnrolmentPeer::YEAR_ID, 2008);
			$c->add(EnrolmentPeer::SCHOOLCLASS_ID, $filtered_schoolclass_id);
		}
	}


	switch($sortby)
	{
		case 'gender': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::GENDER); break;
		case 'username': 	$c->addAscendingOrderByColumn(sfGuardUserPeer::USERNAME); break;
		case 'firstname': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME); break;
		case 'lastname': 	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME); break;
		case 'role': 	$c->addAscendingOrderByColumn(RolePeer::DESCRIPTION); break;
		case 'blocks': 	$c->addDescendingOrderByColumn(sfGuardUserProfilePeer::DISK_USED_BLOCKS); break;
		case 'files': 	$c->addDescendingOrderByColumn(sfGuardUserProfilePeer::DISK_USED_FILES); break;
		case 'alerts': 	$c->addDescendingOrderByColumn(sfGuardUserProfilePeer::SYSTEM_ALERTS); break;

		default: $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
	}
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

	public static function resetGoogleAppsAccountInfoForAll()
	{
		$connection = Propel::getConnection();
		$sql = 'UPDATE ' . sfGuardUserProfilePeer::TABLE_NAME . ' SET googleapps_account_status = 0';
		$statement = $connection->prepare($sql);
		$statement->execute();
	}


}
