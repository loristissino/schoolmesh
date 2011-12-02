<?php

/**
 * ProjUpshot class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class ProjUpshot extends BaseProjUpshot {

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
      ||
      $user->hasCredential('project') 
      ;
  }
  
  public function updateFromForm($params, $user=null, $sf_context=null)
  {
    $con = Propel::getConnection(ProjUpshotPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    // we need to check which ones are present, because they depend on the state
    Generic::updateObjectFromForm($this, array(
      'description',
      'indicator',
      'upshot',
      'evaluation',
      'scheduled_date',
      ), $params);
      
    try
    {
      $this->save();
      $result['result']='notice';
      $result['message']='Upshot successfully updated.';
      
    }
    catch (Exception $e)
    {
      $result['result']='error';
      $result['message']='Upshot could not be saved.';
    }
    
    return $result;
  }




} // ProjUpshot
