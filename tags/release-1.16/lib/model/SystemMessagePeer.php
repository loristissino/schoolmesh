<?php

/**
 * SystemMessagePeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class SystemMessagePeer extends BaseSystemMessagePeer
{
	
	
	public static function retrieveByKey($key)
	{
		$c=new Criteria();
		$c->add(self::KEY, $key);
		return self::doSelectOne($c);
	}
}
