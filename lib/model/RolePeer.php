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
	
	public static function retrieveByDescription($description)
	{
	$c=new Criteria();
	$c->add(self::DESCRIPTION, $description);
	$t = self::doSelectOne($c);
	return $t;
	
		
	}
	
}
