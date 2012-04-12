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
    
  static public function retrieveAll($c=null)
    {
      if(!$c)
      {
        $c=new Criteria();
      }
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

  static public function retrieveJoined($user_id, $options=array())
    {
      /* retrieves teams which have the user identified by $user_id as component */
			$c = new Criteria();
      $c->addJoin(TeamPeer::ID, UserTeamPeer::TEAM_ID);
			$c->add(UserTeamPeer::USER_ID, $user_id);
			$c->addAscendingOrderByColumn(TeamPeer::DESCRIPTION);
      $c->setDistinct();
      
      $result=parent::doSelect($c);
      
      $array=array();
      if(isset($options['as_array']) && $options['as_array'])
      {
        foreach($result as $team)
        {
          $array[]=$team->getId();
        }
        return $array;
      }
      
			return $result;
    }
    
  static public function createTeam($caller_id, $params=array(), $sf_context, $con)
    {
      if(!$con)
      {
        $con = Propel::getConnection(TeamPeer::DATABASE_NAME);
      }
      $con->beginTransaction();
      
      try
      {
        $Team=new Team();
        Generic::updateObjectFromForm(
          $Team,
          array('description', 'posix_name', 'quality_code', 'needs_folder', 'needs_mailing_list', 'is_public'),
          $params
          );
        $Team->save($con);
        $Team->addWfevent(
          $caller_id,
          'Team «%team%» created, posix name «%posix_name%»',
          array('%team%'=>$Team->getDescription(), '%posix_name%'=>$Team->getPosixName()),
          0,
          $sf_context,
          $con
          );
   
        $con->commit();
      }
      catch (Exception $e)
      {
        throw $e;
        //$con->rollback();
      }
      
      return $Team;
      
    }
}
