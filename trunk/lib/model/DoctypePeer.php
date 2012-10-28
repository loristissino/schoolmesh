<?php

require 'lib/model/om/BaseDoctypePeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'doctype' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class DoctypePeer extends BaseDoctypePeer {

  static public function retrieveActive()
  {
    $c = new Criteria();
    $c->add(self::IS_ACTIVE, true);
    $c->addAscendingOrderByColumn(self::RANK);
    return self::doSelect($c);
  }

} // DoctypePeer
