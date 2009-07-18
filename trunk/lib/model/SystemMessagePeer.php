<?php

class SystemMessagePeer extends BaseSystemMessagePeer
{
	
	
	public static function retrieveByKey($key)
	{
		$c=new Criteria();
		$c->add(self::KEY, $key);
		return self::doSelectOne($c);
	}
}
