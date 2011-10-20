<?php

require 'lib/model/om/BaseProjResourceTypePeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'proj_resource_type' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ProjResourceTypePeer extends BaseProjResourceTypePeer {

  public static function retrieveResourcesWithRole()
  {
    $c=new Criteria();
    $c->add(ProjResourceTypePeer::ROLE_ID, null, Criteria::ISNOTNULL);
    return ProjResourceTypePeer::doSelect($c);
  }


} // ProjResourceTypePeer
