<?php

/**
 * AccountTypePeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class AccountTypePeer extends BaseAccountTypePeer
{
	
	public static function retrieveByName($name)
	{
		$c= new Criteria();
		$c->add(AccountTypePeer::NAME, $name);
		return AccountTypePeer::doSelectOne($c);
	}
	
}
