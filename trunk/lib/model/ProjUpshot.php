<?php

require 'lib/model/om/BaseProjUpshot.php';


/**
 * Skeleton subclass for representing a row from the 'proj_upshot' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
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
