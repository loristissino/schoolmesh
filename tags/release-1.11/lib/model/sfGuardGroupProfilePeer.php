<?php

/**
 * sfGuardGroupProfilePeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class sfGuardGroupProfilePeer extends sfGuardGroupPeer
{
	
	static public function retrieveGuardGroupByName($name)
	{
	  $c = new Criteria;
	  $c->add(sfGuardGroupPeer::NAME, $name);
	  return sfGuardGroupPeer::doSelectOne($c); 
	}
	
	
	static public function retrieveAllPermissions($name)
	{
	  $c = new Criteria;
	  $c->add(sfGuardGroupPeer::NAME, $name);
	  return sfGuardGroupPeer::doSelectOne($c); 
	}
	
	
}
