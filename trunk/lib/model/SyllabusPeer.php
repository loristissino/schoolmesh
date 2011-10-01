<?php

require 'lib/model/om/BaseSyllabusPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'syllabus' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class SyllabusPeer extends BaseSyllabusPeer {

  public static function retrieveActive()
  {
    $c=new Criteria();
    $c->add(self::IS_ACTIVE, true);
    return parent::doSelect($c);
  }

} // SyllabusPeer
