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



} // ProjResource
