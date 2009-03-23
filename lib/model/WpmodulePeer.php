<?php

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
