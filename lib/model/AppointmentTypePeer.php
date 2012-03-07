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
    $c->addAscendingOrderByColumn(self::RANK);
    return self::doSelect($c);
  }



} // AppointmentTypePeer
