<?php

/**
 * Subclass for performing query and update operations on the 'year' table.
 *
 * 
 *
 * @package lib.model
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
