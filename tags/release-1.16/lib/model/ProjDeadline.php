<?php

/**
 * ProjDeadline class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
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
  
  public function isAcceptable()
  {
    // a deadline is considered acceptable (when the report is submitted)
    // when it is completed, or its original date is not yet over, or its
    // current date is not yet over and there are some notes
    
		if ($this->getCompleted())
		{
			return true;
		}
		if ($this->getOriginalDeadlineDate('U') > time())
		{
			return true;
		}
		if ($this->getCurrentDeadlineDate('U') > time() and $this->getNotes())
		{
			return true;
		}
    return false;
  }
  
  public function getDeadlineDate($format)
  {
    return $this->getCurrentDeadlineDate() ? $this->getCurrentDeadlineDate($format) : $this->getOriginalDeadlineDate($format);
  }
  
  
  
  public function updateFromForm($params, sfValidatedFile $file=null, $sf_context=null)
  {
    
    $was_completed=$this->getCompleted();
    
    $con = Propel::getConnection(ProjDeadlinePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    // we need to check which ones are present, because it depends on the state
    Generic::updateObjectFromForm($this, array(
      'user_id',
      'original_deadline_date',
      'current_deadline_date',
      'description',
      'notes',
      'completed',
      'needs_attachment',
      ), $params);

    if ($this->getCurrentDeadlineDate()<$this->getOriginalDeadlineDate())
    {
      $this->setCurrentDeadlineDate($this->getOriginalDeadlineDate());
    }

    try
    {
      if($file)
      {
        $result=AttachmentFilePeer::addAttachment($con, $this, 'deadline', $this->getUserId(), $file, $result);
      }
      $this->save($con);
      if($was_completed or $params['completed'])
      {
        $logged=false;
        if($was_completed and !$params['completed'])
        {
          $msg='Deadline «%deadline%» marked as not completed';
          $logged=true;
        }
        if(!$was_completed and $params['completed'])
        {
          $msg='Deadline «%deadline%» marked as completed';
          $logged=true;
        }
        
        if($logged)
        {
          $this->getSchoolproject()->addWfevent($params['user_id'],
            $msg, 
            array('%deadline%'=>$this->getDescription()),
            null,
            $sf_context,
            $con);
        }
      }
      
      $con->commit();
      $result['result']='notice';
      $result['message']='Deadline successfully updated.';
    }
    catch(Exception $e)
    {
      $result['result']='error';
      $result['message']='Deadline not updated, some error occured.';
    }
      
    return $result;
  }
  
  
  public function getAttachmentFiles()
  {
    return AttachmentFilePeer::retrieveByClassAndId(get_class($this), $this->getId());
  }
  
  public function hasAttachmentFiles()
  {
    return sizeof($this->getAttachmentFiles())>0;
  }

  public function isEditableBy($user)
  {
    return 
      $user->getProfile()->getUserId()===$this->getSchoolproject()->getUserId()
      || 
      $user->hasCredential('admin')
      ||
      $user->getProfile()->getBelongsToTeamById($this->getSchoolproject()->getTeamId())   
      ;
  }



} // ProjDeadline

