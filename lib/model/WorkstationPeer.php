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
    
    $active=Generic::executeCommand(sprintf('workstations_getinternetenabled go'), false);
    $jobs=Generic::executeCommand(sprintf('workstations_getjobs go'), false);

    $queue=array();
    foreach($jobs as $job)
    {
      list($ip, $time, $status, $user)=explode(',', $job);
      $queue[$ip][$time]=array(
        'status'=>$status,
        'user'=>$user,
        );
    }

    foreach($t as $Workstation)
    {
      if(array_key_exists($Workstation->getIpCidr(), $active))
      {
        $Workstation
        ->setIsEnabled(true)
        ->setUser($active[$Workstation->getIpCidr()])
        ;
      }
      else
      {
        $Workstation
        ->setIsEnabled(false)
        ->setUser('')
        ;
      }
      
      $Workstation->setJobs(array_key_exists($Workstation->getIpCidr(), $queue) ? $queue[$Workstation->getIpCidr()] : null);
    }
    
		return $t;
	}
  

}
