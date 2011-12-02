<?php

/**
 * WorkstationPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


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
    
    return self::_returnUpdatedInfo($t);
	}
  
  public static function retrieveByPKs($pks, PropelPDO $con = null)
  {
    $t=parent::retrieveByPKs($pks);
    return self::_returnUpdatedInfo($t);
  }
  
  private static function _returnUpdatedInfo($t)
  {
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
      $Workstation->save();
      
      $Workstation->setJobs(array_key_exists($Workstation->getIpCidr(), $queue) ? $queue[$Workstation->getIpCidr()] : null);
    }
    
		return $t;
    
  }
  
  public static function scheduleInternetAccess($user, $params, TimeslotsContainer $tsc, $sf_context=null)
  {
    $ids=$user->getAttribute('ids');
    $user_id=$user->getProfile()->getId();
    $username=$user->getProfile()->getUsername();
    
    $Workstations = WorkstationPeer::retrieveByPKs($ids);
    
    $todo=sizeof($Workstations);
    $done=0;
    
    foreach($Workstations as $Workstation)
    {
      if($Workstation->doDisableInternetAccess($user_id, Generic::b64_serialize(array('user'=>$Workstation->getUser(), 'type'=>'allday')), $sf_context) && $Workstation->doRemoveScheduledJobs($user_id, $sf_context))
      {
        $jdone=0;
        foreach($params['when'] as $slot_index)
        {
          $slot=$tsc->getSlotByIndex($slot_index);
          if($Workstation->doEnableInternetAccess($user_id, $slot['begin'], $slot['end'], $username, $sf_context))
          {
            $jdone++;
          }
        }
        if($jdone==sizeof($params['when']))
        {
          $done++;
        }
      }
    }
    
    if($done==$todo)
    {
      $result['result']='notice';
      $result['message']='All scheduling done.';
    }
    elseif($done==0)
    {
      $result['result']='error';
      $result['message']='No scheduling done.';
    }
    else
    {
      $result['result']='error';
      $result['message']='Some scheduling done.';
    }
    return $result;
    
  }

  public static function enableInternetAccess($user, $Workstations, TimeslotsContainer $tsc, $type, $sf_context=null)
  {
    $user_id=$user->getProfile()->getId();
    $username=$user->getProfile()->getUsername();
    
    $todo=sizeof($Workstations);
    $done=0;
    foreach($Workstations as $Workstation)
    {
      if($type=='allday')
      {
        $Workstation->doRemoveScheduledJobs();
      }
      if($Workstation->doEnableInternetAccess($user_id, $tsc->getCurrentSlotBegin(), $type=='current'?$tsc->getCurrentSlotEnd(): $tsc->getEleventhHour(), $username, $sf_context))
      {
        $done++;
      }
    }
    
    if($done==$todo)
    {
      $result['result']='notice';
      $result['message']='Web access enabled for all the workstations selected.';
    }
    elseif($done==0)
    {
      $result['result']='error';
      $result['message']='Web access could not be enabled for any of the workstations selected.';
    }
    else
    {
      $result['result']='error';
      $result['message']='Web access could be enabled only for some of the workstations selected.';
    }
    return $result;
  }
  
  public static function disableInternetAccess($user, $Workstations, TimeslotsContainer $tsc, $type, $sf_context=null)
  {
    $user_id=$user->getProfile()->getId();
    $username=$user->getProfile()->getUsername();
  
    $todo=sizeof($Workstations);
    $done=0;
    foreach($Workstations as $Workstation)
    {
      if($type=='allday')
      {
        $Workstation->doRemoveScheduledJobs();
      }
      if($Workstation->doDisableInternetAccess($user_id, Generic::b64_serialize(array('user'=>$type=='allday'?$Workstation->getUser() : $username, 'type'=>$type)), $sf_context))
      {
        $done++;
      }
    }
    
    if($done==$todo)
    {
      $result['result']='notice';
      $result['message']='Web access disabled for all the workstations selected.';
    }
    elseif($done==0)
    {
      $result['result']='error';
      $result['message']='Web access could not be disabled for any of the workstations selected.';
    }
    else
    {
      $result['result']='error';
      $result['message']='Web access could be disabled only for some of the workstations selected.';
    }
    return $result;
  }

}
