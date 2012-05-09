<?php

/**
 * ProjActivity class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
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
  
  public function getProjectActivityMessage(sfGuardUserProfile $sender, sfContext $sfContext=null)
  {
    return new ProjectActivityMessage($this->getPerformerProfile(), $sender, $this, $sfContext);
  }

  
  public function saveChanges($params=array())
  {
    Generic::updateObjectFromForm($this, array('beginning', 'quantity', 'notes', 'paper_log'), $params);
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
