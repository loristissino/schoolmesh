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
    
  static public function retrieveAll()
    {
			$c = new Criteria();
			$c->addAscendingOrderByColumn(TeamPeer::DESCRIPTION);
			return parent::doSelect($c);
    }

  static public function retrievePublicOrJoined($user_id)
    {
      /* retrieves teams which are public or have the user identified by $user_id as component */
			$c = new Criteria();
      $c->addJoin(TeamPeer::ID, UserTeamPeer::TEAM_ID);
      
      $publicCriterion=$c->getNewCriterion(TeamPeer::IS_PUBLIC, true, Criteria::EQUAL);
      $joinedCriterion=$c->getNewCriterion(UserTeamPeer::USER_ID, $user_id, Criteria::EQUAL);
      
      $publicCriterion->addOr($joinedCriterion); 
      // see http://snippets.symfony-project.org/snippets/tagged/criteria/order_by/popularity
      
			$c->add($publicCriterion);
			$c->addAscendingOrderByColumn(TeamPeer::DESCRIPTION);
      $c->setDistinct();
			return parent::doSelect($c);
    }

}
