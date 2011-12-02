<?php

/**
 * ProjResourceTypePeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class ProjResourceTypePeer extends BaseProjResourceTypePeer {

  public static function retrieveResourcesWithRole()
  {
    $c=new Criteria();
    $c->add(ProjResourceTypePeer::ROLE_ID, null, Criteria::ISNOTNULL);
    return ProjResourceTypePeer::doSelect($c);
  }


} // ProjResourceTypePeer
