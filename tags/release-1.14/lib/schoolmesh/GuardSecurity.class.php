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

  static function upcmp($a, $b)
  {
    $profile_a=sfGuardUserProfilePeer::retrieveByPK($a->getUserId());
    $profile_b=sfGuardUserProfilePeer::retrieveByPK($b->getUserId());
    return $profile_a->getLastName().$profile_a->getFirstName() > $profile_b->getLastName().$profile_b->getFirstName();
  }

  static function getsfGuardUserPermissions(sfGuardPermission $credential)
  {
    $userpermissions=$credential->getsfGuardUserPermissions();
    // this are not by users' last names, but the method is in the plugin and we won't touch it directly...
    // highly inefficient, but this function is used very seldom...
    uasort($userpermissions, 'self::upcmp');

    return $userpermissions;
  }
 
}
