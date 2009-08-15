<?php

class AccountTypePeer extends BaseAccountTypePeer
{
	
	public static function retrieveByName($name)
	{
		$c= new Criteria();
		$c->add(AccountTypePeer::NAME, $name);
		return AccountTypePeer::doSelectOne($c);
	}
	
}
