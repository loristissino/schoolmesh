<?php

/**
 * SyllabusPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class SyllabusPeer extends BaseSyllabusPeer {

  public static function retrieveActive()
  {
    $c=new Criteria();
    $c->add(self::IS_ACTIVE, true);
    return parent::doSelect($c);
  }

} // SyllabusPeer
