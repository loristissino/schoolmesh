<?php

class WpmodulePeer extends BaseWpmodulePeer
{
	
	static function retrieveByRank($rank = 1, $workplanId = 1)
	{
	  $c = new Criteria;
	  $c->add(self::RANK, $rank);
	  $c->add(self::WORKPLAN_ID, $workplanId);
	  return self::doSelectOne($c); 
	}

	
}
