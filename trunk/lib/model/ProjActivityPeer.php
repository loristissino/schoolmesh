<?php

require 'lib/model/om/BaseProjActivityPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'proj_activity' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ProjActivityPeer extends BaseProjActivityPeer {

  public static function retrieveAllForYearAndUser($year, $user_id)
	{
		$c=new Criteria();
    $c->addJoin(self::PROJ_RESOURCE_ID, ProjResourcePeer::ID);
    $c->addJoin(ProjResourcePeer::SCHOOLPROJECT_ID, SchoolprojectPeer::ID);
    $c->addJoin(ProjResourcePeer::PROJ_RESOURCE_TYPE_ID, ProjResourceTypePeer::ID);
		$c->add(SchoolprojectPeer::YEAR_ID, $year);
    $c->add(self::USER_ID, $user_id);
		$c->addAscendingOrderByColumn(self::BEGINNING);
		return self::doSelectJoinAllExceptsfGuardUserRelatedByUserId($c);
	}
  
  public static function addActivity($user_id, $params=array(), $added_by_coordinator=false)
  {
        
    try
    {
      $activity= new ProjActivity();
      $activity
      ->setUserId($user_id)
      ->setProjResourceId($params['proj_resource_id'])
      ->setBeginning($params['beginning'])
      ->setQuantity($params['quantity'])
      ->setNotes($params['notes'])
      ->setAcknowledgerUserId($user_id)
      ->setAcknowledgedAt($added_by_coordinator? time() : null)
      ->setAddedByCoordinator($added_by_coordinator)
      ->save();
      
      $result['result']='notice';
      $result['message']='The activity has been saved.';
      
    }
    
    catch (PropelException $e)
    {

      $result['result']='error';
      $result['message']='The activity could not be saved.' . $e->getCause()->getMessage();
    }
    
    return $result;
    
  }

} // ProjActivityPeer
