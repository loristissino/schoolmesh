<?php

require 'lib/model/om/BaseProjResource.php';


/**
 * Skeleton subclass for representing a row from the 'proj_resource' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ProjResource extends BaseProjResource {
  
  public function __toString()
  {
    return $this->getDescription();
  }
  
  public function isEditableBy($user)
  {
    return 
      $user->getProfile()->getUserId()===$this->getSchoolproject()->getUserId()
      || 
      $user->hasCredential('admin')
      ;
  }
  
  public function updateFromForm($params)
  {
    $con = Propel::getConnection(ProjResourcePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    // we need to check which ones are present, because it depends on the state
    Generic::updateObjectFromForm($this, array(
      'proj_resource_type_id',
      'description',
      'quantity_estimated',
      'quantity_approved',
      ), $params);
      
    try
    {
      $this->save();
      $result['result']='notice';
      $result['message']='Resource successfully updated.';
    }
    catch (Exception $e)
    {
      $result['result']='error';
      $result['message']='Resource could not be saved.';
    }
    
    return $result;
  }


  public function countActivities($acknowledged=false)
  {
    $comparison=$acknowledged? Criteria::ISNOTNULL : Criteria::ISNULL;
    $c=new Criteria();
    $c->addJoin(ProjResourcePeer::ID, ProjActivityPeer::PROJ_RESOURCE_ID);
    $c->add(ProjResourcePeer::ID, $this->getId());
    $c->add(ProjActivityPeer::ACKNOWLEDGED_AT, null, $comparison);
    return ProjResourcePeer::doCount($c);
  }
  
  public function countProjActivities(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
  {
    return self::countProjActivitys($criteria, $distinct, $con);
  }
  public function getProjActivities($criteria = null, PropelPDO $con = null)
  {
    return self::getProjActivitys($criteria, $con);
  }

  public function acknowledgeActivity($user_id, ProjActivity $activity)
  {
    if($activity->getAcknowledgedAt())
    {
      $result['result']='error';
      $result['message']='The activity was already acknowledged.';
      return $result;
    }
    
    try
    {
      $activity
      ->setAcknowledgerUserId($user_id)
      ->setAcknowledgedAt(time())
      ->save();
      
      $result['result']='notice';
      $result['message']='The activity has been acknowledged.';
      return $result;
    }
    catch (PropelException $e)
    {
      $result['result']='error';
      $result['message']='The activity could not be acknowledged.';
      return $result;
    }
    
  }

} // ProjResource
