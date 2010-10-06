<?php

require 'lib/model/om/BaseProjDeadline.php';


/**
 * Skeleton subclass for representing a row from the 'proj_deadline' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ProjDeadline extends BaseProjDeadline {

	public function getState()
	{
		if ($this->getCompleted())
		{
			return 'completed';
		}
		
		if ($this->getCurrentDeadlineDate('U') < time())
		{
			return 'overdue';
		}
		
		return 'not yet over';
		
	}
  
  
  public function updateFromForm($params, sfValidatedFile $file=null)
  {
    $con = Propel::getConnection(ProjDeadlinePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    // we need to check which ones are present, because it depends on the state
    Generic::updateObjectFromForm($this, array(
      'original_deadline_date',
      'current_deadline_date',
      'description',
      'notes',
      'completed',
      ), $params);


    $result['result']='notice';
    $result['message']='Deadline successfully updated.';

    $con->beginTransaction();
    
    $this->save($con);

    if(!is_null($file))
    {
      $attachment=new AttachmentFile();
      
      $attachment
      ->setUserId($this->getUserId())
      ->setBaseTable(AttachmentFilePeer::getBaseTableId(get_class($this)))
      ->setBaseId($this->getId())
      ;
      
      if ($attachment->setFile('deadline', $file))
      {
        try
        {
          $attachment->save($con);
          $con->commit();
        }
        catch (Exception $e)
        {
          $con->rollBack();
          $result['result']='error';
          $result['message']='This file was already uploaded.';
        }
      }
      else
      {
        $con->rollBack();
        $result['result']='error';
        $result['message']='Could not save the uploaded file.';
      }
        
    }
    else
    {
      $con->commit();
    }
    
    return $result;
  }
  
  
  public function getAttachmentFiles()
  {
    return AttachmentFilePeer::retrieveByClassAndId(get_class($this), $this->getId());
  }


  public function isEditableBy($user)
  {
    return 
      $user->getProfile()->getUserId()===$this->getUserId()
      || 
      $user->hasCredential('admin')
      ;
  }



} // ProjDeadline

