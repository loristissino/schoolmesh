<?php

class TeamPeer extends BaseTeamPeer
{
	
	
	static public function retrieveByPosixName($name)
	
		{
			
			$c = new Criteria();
			$c->add(TeamPeer::POSIX_NAME, $name);
			return parent::doSelectOne($c);

		}
}
