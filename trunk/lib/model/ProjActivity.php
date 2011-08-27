<?php

require 'lib/model/om/BaseProjActivity.php';


/**
 * Skeleton subclass for representing a row from the 'proj_activity' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ProjActivity extends BaseProjActivity {
  
  public function getPerformer()
  {
    return sfGuardUserPeer::retrieveByPk($this->getUserId());
  }
  public function getPerformerProfile()
  {
    return sfGuardUserProfilePeer::retrieveByPk($this->getUserId());
  }
  
  public function saveChanges($params=array())
  {
    Generic::updateObjectFromForm($this, array('beginning', 'quantity', 'notes'), $params);
    $this->save();
    $result['result']='notice';
    $result['message']='Activity information updated.';
    return $result;
    
  }
  
  public function getEnding($format)
  {
    if ($this->getBeginning())
    {
      return date($format, Generic::addtime($this->getBeginning('U'), $this->getProjResource()->getProjResourceType()->getMeasurementUnit(), $this->getQuantity()));
    }
    else
    {
      return null;
    }
  }

} // ProjActivity
