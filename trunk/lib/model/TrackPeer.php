<?php

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
