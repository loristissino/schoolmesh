<?php

/**
 * TrackPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class TrackPeer extends BaseTrackPeer
{
	
		
	static public function retrieveByShortcut($shortcut)
	{
	$c=new Criteria();
	$c->add(self::SHORTCUT, $shortcut);
	$t = self::doSelectOne($c);
	return $t;
		
	}

	
}
