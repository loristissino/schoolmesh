<?php

/**
 * GuardSecurity class.
 *
 * @package    schoolmesh
 * @subpackage lib.schoolmesh
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class GuardSecurity {

	static function retrieveAllSorted()
	{
    $c=new Criteria();
    $c->addAscendingOrderByColumn(sfGuardPermissionPeer::DESCRIPTION);
    return sfGuardPermissionPeer::doSelect($c);
  }
 
}
