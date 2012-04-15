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

	static function retrieveAllPermissionsSorted()
	{
    $c=new Criteria();
    $c->addAscendingOrderByColumn(sfGuardPermissionPeer::DESCRIPTION);
    return sfGuardPermissionPeer::doSelect($c);
  }

	static function retrieveAllPermissionsSortedWithJoins()
	{
    $c=new Criteria();
    $c->addAscendingOrderByColumn(sfGuardPermissionPeer::DESCRIPTION);
    $c->addJoin(sfGuardPermissionPeer::ID, sfGuardUserPermissionPeer::PERMISSION_ID, Criteria::LEFT_JOIN);
    $c->addJoin(sfGuardPermissionPeer::ID, sfGuardGroupPermissionPeer::PERMISSION_ID, Criteria::LEFT_JOIN);
    return sfGuardPermissionPeer::doSelectJoinAll($c);
  }


 
}
