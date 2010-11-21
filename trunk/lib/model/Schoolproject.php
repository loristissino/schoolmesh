<?php

require 'lib/model/om/BaseSchoolproject.php';


/**
 * Skeleton subclass for representing a row from the 'schoolproject' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Schoolproject extends BaseSchoolproject {

	public function __toString()
	{
		return $this->getTitle();
	}
  
  public function isEditableBy($user)
  {
    return 
      $user->getProfile()->getUserId()===$this->getUserId()
      || 
      $user->hasCredential('admin')
      ;
  }
  
  public function isViewableBy($user)
  {
    return 
      $user->getProfile()->getUserId()===$this->getUserId() 
      || 
      $user->hasCredential('schoolmaster') 
      || 
      $user->hasCredential('admin')
      ;
  }
  
  
  public function getProjectAlertMessage(sfGuardUserProfile $sender, sfContext $sfContext=null)
  {
    return new SchoolprojectAlertMessage($this->getsfGuardUser()->getProfile(), $sender, $this, $sfContext);
  }
  
  
  public function getOverdueDeadlines($options=array())
  {
    $c=new Criteria();
    $c->add(ProjDeadlinePeer::SCHOOLPROJECT_ID, $this->getId());
    $c->add(ProjDeadlinePeer::CURRENT_DEADLINE_DATE, time(), Criteria::LESS_THAN);
    $c->add(ProjDeadlinePeer::COMPLETED, false);
    $deadlines=ProjDeadlinePeer::doSelect($c);
    $text='';
    foreach($deadlines as $deadline)
    {
      $text.='* ' . $deadline->getCurrentDeadlineDate('d/m/Y') . ': ' . $deadline->getDescription() . "\n";
    }
    return $text;
  }
  
  
  public function sendEmail($params, sfGuardUserProfile $sender, sfContext $sfContext=null)
  {
    $to_email=$this->getsfGuardUser()->getProfile()->getValidatedEmail();
    if ($to_email=='')
    {
      $result['result']='error';
      $result['message']='The coordinator of this project does not have a validated email.';
      return $result;
    }
    
    $from_email=$sender->getValidatedEmail();
    if ($from_email=='')
    {
      $result['result']='error';
      $result['message']='Sender must have a validated email.';
      return $result;
    }

        
    $message=new SimpleMessage($sfContext);
    $message
    ->setFrom(array($from_email=>$sender->getFullname()))
    ->setTo(array($to_email=>$this->getsfGuardUser()->getProfile()->getFullname()))
    ->setBody($params['body'])
    ->setSubject($params['email_subject'])
    ->addSchoolMeshHeader($sfContext);
    
		$mailer=$sfContext->getMailer();
		$mailer->send($message);
    
    $this->addEmailAttachment($message);
      
    $result['result']='notice';
    $result['message']='The message has been correctly sent.';
    return $result;

  }
  
  public function addEmailAttachment($message)
  {
    $attachment=new AttachmentFile();
    $attachment->setMessage($message);
    $this->addAttachmentFile($attachment);
  }
  
  public function addAttachmentFile($attachment)
  {
    $attachment
    ->setUserId($this->getUserId())
    ->setBaseTable(AttachmentFilePeer::getBaseTableId(get_class($this)))
    ->setBaseId($this->getId())
    ->save()
    ;
  }
  
  public function deleteDeadline(sfGuardUserProfile $profile, ProjDeadline $deadline)
  {
    if($profile->getUserId()!=$this->getUserId())
    {
      $result['result']='error';
      $result['message']='You are not allowed to remove deadlines from this project.';
      return $result;
    }
    
    try
    {
      $deadline->delete();
      $result['result']='notice';
      $result['message']='The deadline has been deleted.';
      return $result;
    }
    catch(Exception $e)
    {
      $result['result']='error';
      $result['message']='The deadline could not be deleted.';
      return $result;
    }
    
  }
  
  public function addDeadline(sfGuardUserProfile $profile)
  {
    if($profile->getUserId()!=$this->getUserId())
    {
      $result['result']='error';
      $result['message']='You are not allowed to add deadlines to this project.';
      return $result;
    }
    
    if($this->getState()!=Workflow::PROJ_DRAFT)
    {
      $result['result']='error';
      $result['message']='You are not allowed to add deadlines to a project in this state.';
      return $result;
    }
    
    
    try
    {
			$deadline=new ProjDeadline();
			$deadline
			->setUserId($this->getUserId())
      ->setSchoolprojectId($this->getId())
      ->setOriginalDeadlineDate(Generic::currentDate())
      ->setCurrentDeadlineDate(Generic::currentDate())
      ->save();
      $result['result']='notice';
      $result['message']='The deadline has been added.';
      return $result;
    }
    catch(Exception $e)
    {
      $result['result']='error';
      $result['message']='The deadline could not be added.';
      return $result;
    }
  }
  
  public function updateFromForm($params)
  {
    Generic::updateObjectFromForm($this, array(
      'title',
      'description',
      'hours_approved',
      'notes',
      'proj_category_id',
      ), $params);
      
    return $this;
  }
  
	
	public function getProjDeadlines($criteria = null, PropelPDO $con = null)
	{
		$criteria=new Criteria();
		$criteria->addAscendingOrderByColumn(ProjDeadlinePeer::ORIGINAL_DEADLINE_DATE);
		$criteria->addAscendingOrderByColumn(ProjDeadlinePeer::DESCRIPTION);
		return parent::getProjDeadlines($criteria);
	}
	
	
	public function getOdf($doctype, sfContext $sfContext=null, $template='', $complete=true)
	{
		
		if ($template=='')
		{
			$template='project_resume.odt';
		}
			
		try
		{
			$odf=new OdfDoc($template, $this->__toString(). '.' . $doctype, $doctype);
		}
		catch (Exception $e)
		{
			throw $e;
		}
		
		$odfdoc=$odf->getOdfDocument();
		
		$owner=$this->getSfGuardUser()->getProfile();
		
		$odfdoc->setVars('salutation', $this->getSfGuardUser()->getProfile()->getSalutation($sfContext));
		$odfdoc->setVars('year',  $this->getYear()->__toString());
		$odfdoc->setVars('coordinator',  $this->getSfGuardUser()->getProfile()->getFullName());
		$odfdoc->setVars('title', $this->getTitle());
		$odfdoc->setVars('category',  $this->getProjCategory()->getTitle());
		$odfdoc->setVars('hours_approved', $this->getHoursApproved());
		
		$projDeadlines=$this->getProjDeadlines();
		
		$deadlines=$odfdoc->setSegment('deadlines');
		foreach($projDeadlines as $projDeadline)
		{
			$deadlines->infoDescription($projDeadline->getDescription());
			$deadlines->infoDeadlineDate($projDeadline->getOriginalDeadlineDate('d/m/Y'));
			$deadlines->infoAssignee($projDeadline->getsfGuardUser()->getProfile()->getFullName());
			$deadlines->merge();
		}
		
		$odfdoc->mergeSegment($deadlines);
		
		return $odf;
	}

	

} // Schoolproject
