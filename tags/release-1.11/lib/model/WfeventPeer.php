<?php

/**
 * WfeventPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class WfeventPeer extends BaseWfeventPeer {
  
  const
    PROJ_DEADLINE=1,
    SCHOOLPROJECT=2,
    APPOINTMENT=3,
    WORKSTATION=4,
    TEAM=5,
    SFGUARD_USER_PROFILE=6,
    SFGUARD_USER=7
    ;
  
  static private $basenames=Array(
    self::PROJ_DEADLINE=>'ProjDeadline',
    self::SCHOOLPROJECT=>'Schoolproject',
    self::APPOINTMENT=>'Appointment',
    self::WORKSTATION=>'Workstation',
    self::TEAM=>'Team',
    self::SFGUARD_USER_PROFILE=>'sfGuardUserProfile',
    self::SFGUARD_USER=>'sfGuardUser',
    );

  public static function getBaseTableId($classname)
  {
    $baseids=array_flip(self::$basenames);
    return $baseids[$classname];
  }
  
  public static function getBaseClass($id)
  {
    return self::$basenames[$id];
  }
  
  public static function retrieveByClassAndId($classname, $id, $ascending=true)
  {
    $c=new Criteria();
    $c->add(self::BASE_TABLE, self::getBaseTableId($classname));
    $c->add(self::BASE_ID, $id);
    if($ascending)
    {
      $c->addAscendingOrderByColumn(WfeventPeer::CREATED_AT);
    }
    else
    {
      $c->addDescendingOrderByColumn(WfeventPeer::CREATED_AT);
    }
		$c->addJoin(WfeventPeer::USER_ID, sfGuardUserProfilePeer::USER_ID, Criteria::LEFT_JOIN);
    $c->setDistinct();
    return self::doSelect($c);
  }

  public static function retrieveLastByClassIdAndState($classname, $id, $state)
  {
    $c=new Criteria();
    $c->add(self::BASE_TABLE, self::getBaseTableId($classname));
    $c->add(self::BASE_ID, $id);
    $c->add(self::STATE, $state);
    $c->addDescendingOrderByColumn(WfeventPeer::CREATED_AT);
    return self::doSelectOne($c);
  }



} // WfeventPeer
