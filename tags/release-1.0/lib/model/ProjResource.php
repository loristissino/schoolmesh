<?php

/**
 * ProjResource class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
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
      $user->hasCredential('proj_adm_ok')
      ||
      $user->getProfile()->getBelongsToTeamById($this->getSchoolproject()->getTeamId())   
      ;
  }
  
  public function getChargedUserProfile()
  {
    return sfGuardUserProfilePeer::retrieveByPK($this->getChargedUserId());
  }
  
  public function updateFromForm($params, $user=null, $sf_context=null)
  {
    $old_quantity_approved=$this->getQuantityApproved();
    $old_amount_funded_externally=$this->getAmountFundedExternally();
    $con = Propel::getConnection(ProjResourcePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    // we need to check which ones are present, because they depend on the state
    Generic::updateObjectFromForm($this, array(
      'proj_resource_type_id',
      'description',
      'quantity_estimated',
      'quantity_approved',
      'charged_user_id',
      'scheduled_deadline',
      'amount_funded_externally',
      'financing_notes',
      ), $params);
      
    if(!$this->getProjResourceType()->getRoleId())
    {
      $this->setChargedUserId(null);
    }
      
    try
    {
      $this->save();
      $result['result']='notice';
      $result['message']='Resource successfully updated.';
      
      if($user)
      {
        $project=$this->getSchoolproject();
        if($project->getState()>PROJ_DRAFT && $this->getQuantityApproved()!=$old_quantity_approved)
        {
          $this->getSchoolproject()->addWfevent(
            $user->getProfile()->getId(),
            'Updated quantity approved for resource «%resource%», set to %quantity_approved%',
            array('%resource%'=>$this->getDescription(), '%quantity_approved%'=>$params['quantity_approved']),
            null,
            $sf_context
          );
        }
        if($this->getAmountFundedExternally()!=$old_amount_funded_externally)
        {
          $this->getSchoolproject()->addWfevent(
            $user->getProfile()->getId(),
            'Updated amount funded externally for resource «%resource%», set to %amount% (%notes%)',
            array('%resource%'=>$this->getDescription(), '%amount%'=>$params['amount_funded_externally'], '%notes%'=>$params['financing_notes']),
            null,
            $sf_context
          );
        }
        
      }
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
  
  public function getTotalQuantityForAcknowledgedActivities()
  {
    $c=new Criteria();
    $c->addJoin(ProjResourcePeer::ID, ProjActivityPeer::PROJ_RESOURCE_ID);
    $c->add(ProjResourcePeer::ID, $this->getId());
    $c->add(ProjActivityPeer::ACKNOWLEDGED_AT, null, Criteria::ISNOTNULL);
    $c->clearSelectColumns();
    $c->addAsColumn('TOTALQUANTITY', 'SUM(' . ProjActivityPeer::QUANTITY . ')');
    $stmt=SyllabusItemPeer::doSelectStmt($c);
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    return $row->TOTALQUANTITY;
  }
  
  public function countProjActivities(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
  {
    return self::countProjActivitys($criteria, $distinct, $con);
  }
  public function getProjActivities($criteria = null, PropelPDO $con = null)
  {
    $c=new Criteria();
    $c->addAscendingOrderByColumn(ProjActivityPeer::BEGINNING);
    $c->add(ProjActivityPeer::PROJ_RESOURCE_ID, $this->getId());
    return self::getProjActivitys($c, $con);
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
  
  public function getCriteriaForUserSelection()
	{
      $c = new Criteria();
      $c->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID);
      $c->add(RolePeer::ID, $this->getProjResourceType()->getRoleId());
      $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
      $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME);
      $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
      $c->add(sfGuardUserPeer::IS_ACTIVE, true);
      
      return $c;
	}
  
  public function getQuantityMultipliedByCost()
  {
    if (!$this->getIsMonetary())
    {
      return false;
    }
    return $this->getStandardCost() ? $this->getQuantityApproved() * $this->getStandardCost() : $this->getQuantityApproved();
  }
  
  public function getAmountEstimated()
  {
    return $this->getQuantityMultipliedByCost();
    // kept for compatibility with templates
  }


} // ProjResource
