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
  
  public function getDeadlineDate($format)
  {
    return $this->getCurrentDeadlineDate() ? $this->getCurrentDeadlineDate($format) : $this->getOriginalDeadlineDate($format);
  }
  
  
  
  public function updateFromForm($params, sfValidatedFile $file=null)
  {
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

    $result['result']='notice';
    $result['message']='Deadline successfully updated.';
    
    if($file)
    {
      $result=AttachmentFilePeer::addAttachment($con, $this, 'deadline', $this->getUserId(), $file, $result);
    }
    else
    {
      $this->save();
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
      $user->getProfile()->getUserId()===$this->getSchoolproject()->getUserId()
      || 
      $user->hasCredential('admin')
      ||
      $user->getProfile()->getBelongsToTeamById($this->getSchoolproject()->getTeamId())   
      ;
  }



} // ProjDeadline

