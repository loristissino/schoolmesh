<?php

/**
 * UserTeamPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class UserTeamPeer extends BaseUserTeamPeer
{
	
	public static function retrieveUserTeam(sfGuardUser $user, Team $team)
	{
		$c=new Criteria();
		$c->add(UserTeamPeer::USER_ID, $user->getId());
		$c->add(UserTeamPeer::TEAM_ID, $team->getId());
		$t = UserTeamPeer::doSelectOne($c);
		return $t;
	}
	
}
