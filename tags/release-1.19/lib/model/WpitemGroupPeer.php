<?php

/**
 * WpitemGroupPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class WpitemGroupPeer extends BaseWpitemGroupPeer
{
	
	static public function retrieveByModuleAndType($moduleId, $typeId)
	{
		
	$c= new Criteria();
	$c->add(self::WPMODULE_ID, $moduleId);
	$c->add(self::WPITEM_TYPE_ID, $typeId);
	$t = self::doSelectOne($c); 

	if (sizeof($t)>0)
		return $t;
	else
		return null;
	
	}
	
}
