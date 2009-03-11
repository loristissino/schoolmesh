<?php

class WorkstationPeer extends BaseWorkstationPeer
{

	public static function retrieveByNameAndIp($name, $ip)
	{
		$c = new Criteria();
	
		$c->add(WorkstationPeer::NAME, $name);
		$c->add(WorkstationPeer::IP_CIDR, $ip);
		$t = WorkstationPeer::doSelectOne($c);
		return $t;
	}

}
