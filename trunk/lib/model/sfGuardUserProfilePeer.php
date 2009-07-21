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
	$t = self::doSelect($c);
	return $t;
		
	}
	
}
