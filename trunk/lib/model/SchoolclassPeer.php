<?php

/**
 * Subclass for performing query and update operations on the 'schoolclass' table.
 *
 * 
 *
 * @package lib.model
 */ 
class SchoolclassPeer extends BaseSchoolclassPeer
{
		
	public static function retrieveCurrentSchoolclasses()
	{
		$c=new Criteria();
		$c->addJoin(SchoolclassPeer::TRACK_ID, TrackPeer::ID);
		return self::doSelectJoinAll($c);
	}

}
