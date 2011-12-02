<?php

/**
 * YearPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class YearPeer extends BaseYearPeer
{
	public static function retrieveByDescription($value)
	{
		$c=new Criteria();
		$c->add(self::DESCRIPTION, $value);
		return self::doSelectOne($c);
	}
  
  public static function retrieveAll()
  {
    $c=new Criteria();
		return self::doSelect($c);
  }
	
	
}
