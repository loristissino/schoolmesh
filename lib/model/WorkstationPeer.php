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
  
	public static function retrieveAllWorkstations()
	{
		$c = new Criteria();
    $c->addJoin(WorkstationPeer::SUBNET_ID, SubnetPeer::ID);
    $c->addAscendingOrderByColumn(WorkstationPeer::SUBNET_ID);
		$t = WorkstationPeer::doSelectJoinAll($c);
		return $t;
	}
  

}
