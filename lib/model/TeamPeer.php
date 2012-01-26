<?php

/**
 * TeamPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */


class TeamPeer extends BaseTeamPeer
{
	
	
	static public function retrieveByPosixName($name)
    {
			$c = new Criteria();
			$c->add(TeamPeer::POSIX_NAME, $name);
			return parent::doSelectOne($c);
		}
    
  static public function retrieveAllSortedByDescription()
    {
			$c = new Criteria();
			$c->addAscendingOrderByColumn(TeamPeer::DESCRIPTION);
			return parent::doSelect($c);
    }
}
