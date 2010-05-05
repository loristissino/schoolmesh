<?php

/**
 * Subclass for performing query and update operations on the 'role' table.
 *
 * 
 *
 * @package lib.model
 */ 
class RolePeer extends BaseRolePeer
{
	
	public static function retrieveMainRoles()
	{
		$c=new Criteria();
		$c->add(RolePeer::MAY_BE_MAIN_ROLE, true);
    $c->addAscendingOrderByColumn(RolePeer::MALE_DESCRIPTION);
		return self::doSelect($c);
	}

	public static function retrieveByDescription($description)
	{
	$c=new Criteria();
	$c->add(self::DESCRIPTION, $description);
	$t = self::doSelectOne($c);
	return $t;
	
		
	}

	public static function retrieveByPosixName($value)
	{
	$c=new Criteria();
	$c->add(self::POSIX_NAME, $value);
	$t = self::doSelectOne($c);
	return $t;
	
		
	}



}
