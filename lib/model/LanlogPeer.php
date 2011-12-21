<?php

/**
 * LanlogPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class LanlogPeer extends BaseLanlogPeer
{

	public static function retrieveByClientIP($clientIP)
	{
    $c=new Criteria();
    $c->add(LanlogPeer::IS_ONLINE, true);
    $c->add(WorkstationPeer::IP_CIDR, $clientIP);
    $c->addDescendingOrderByColumn(self::UPDATED_AT);
    $t = LanlogPeer::doSelectJoinAll($c);
    if ($t) 
        return $t[0];
    else
        return null;
	}

	public static function retrieveByUserAndWorkstation($userId, $workstationId)
	{
    Generic::logMessage('userid', $userId);
    Generic::logMessage('wsid', $workstationId);
    $c=new Criteria();
    $c->add(LanlogPeer::USER_ID, $userId);
    $c->add(LanlogPeer::WORKSTATION_ID, $workstationId);
    $c->add(LanlogPeer::IS_ONLINE, true);
    $t = LanlogPeer::doSelectOne($c);
    Generic::logMessage('t', $t);
    return $t;
	}

	public static function retrieveOnline()
	{
    $c=new Criteria();
    $c->add(LanlogPeer::IS_ONLINE, true);
    $c->addDescendingOrderByColumn(self::UPDATED_AT);
    $t = LanlogPeer::doSelectJoinAll($c);
    return $t;
	}

	public static function getLatestLog()
	{
    $c=new Criteria();
    $c->addDescendingOrderByColumn(self::UPDATED_AT);
    $t = LanlogPeer::doSelectOne($c);
    return $t;
	}
  
	public static function retrieveByUserId($userId)
	{
    $c=new Criteria();
    $c->add(LanlogPeer::USER_ID, $userId);
    $c->addDescendingOrderByColumn(self::UPDATED_AT);
    return LanlogPeer::doSelectJoinAll($c);
	}

	public static function retrieveByWorkstationId($userId)
	{
    $c=new Criteria();
    $c->add(LanlogPeer::WORKSTATION_ID, $userId);
    $c->addDescendingOrderByColumn(self::UPDATED_AT);
    return LanlogPeer::doSelectJoinAll($c);
	}


}
