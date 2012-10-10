<?php

/**
 * WpmodulePeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class WpmodulePeer extends BaseWpmodulePeer
{
	
	static function retrieveByRank($rank = 1, $appointmentId = 1)
	{
	  $c = new Criteria;
	  $c->add(self::RANK, $rank);
	  $c->add(self::APPOINTMENT_ID, $appointmentId);
	  return self::doSelectOne($c); 
	}

	
}
