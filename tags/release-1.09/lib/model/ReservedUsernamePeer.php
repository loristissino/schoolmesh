<?php

/**
 * ReservedUsernamePeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */
class ReservedUsernamePeer extends BaseReservedUsernamePeer
{
	
	public static function retrieveByUserName($username)
	{
		$c= new Criteria();
		$c->add(parent::USERNAME, $username);
		return parent::doSelectOne($c);
	}
}
