<?php

require 'lib/model/om/BaseWfeventPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'wfevent' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class WfeventPeer extends BaseWfeventPeer {
  
  const
    PROJ_DEADLINE=1,
    SCHOOLPROJECT=2,
    APPOINTMENT=3
    ;
  
  static private $basenames=Array(
    self::PROJ_DEADLINE=>'ProjDeadline',
    self::SCHOOLPROJECT=>'Schoolproject',
    self::APPOINTMENT=>'Appointment',
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
		$c->addJoin(WpeventPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
    $c->setDistinct();
    return self::doSelect($c);
  }

} // WfeventPeer
