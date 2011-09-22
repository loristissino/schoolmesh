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
  
	public static function retrieveAllWorkstations(Subnet $Subnet=null)
	{
		$c = new Criteria();
    $c->addJoin(WorkstationPeer::SUBNET_ID, SubnetPeer::ID);
    $c->addAscendingOrderByColumn(WorkstationPeer::SUBNET_ID);
    if($Subnet)
    {
      $c->add(WorkstationPeer::SUBNET_ID, $Subnet->getId());
    }
		$t = WorkstationPeer::doSelectJoinAll($c);
    
    $jobs=Generic::executeCommand(sprintf('workstations_getjobs go'), false);
    
    Generic::logMessage('jobs', $jobs);
    
		return $t;
	}
  

}
