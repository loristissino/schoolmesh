<?php

class ReservedUsernamePeer extends BaseReservedUsernamePeer
{
	
	public static function retrieveByUserName($username)
	{
		$c= new Criteria();
		$c->add(parent::USERNAME, $username);
		return parent::doSelectOne($c);
	}
}
