<?php

require 'lib/model/om/BaseAppointmentTypePeer.php';


/**

 *
 * @package    lib.model
 */
class AppointmentTypePeer extends BaseAppointmentTypePeer {

  public static function retrieveActive()
  {
    $c= new Criteria();
    $c->add(self::IS_ACTIVE, true);
    return self::retrieveAll($c);
  }

  public static function retrieveByShortcut($v)
  {
    $c= new Criteria();
    $c->add(self::SHORTCUT, $v);
    return self::doSelectOne($c);
  }

  public static function retrieveAll(Criteria $c=null)
  {
    if(!$c)
    {
      $c= new Criteria();
    }
    $c->addAscendingOrderByColumn(self::RANK);
    return self::doSelect($c);
  }


} // AppointmentTypePeer
