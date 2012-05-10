<?php

/**
 * Schoolproject class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class Schoolproject extends BaseSchoolproject {

	public function __toString()
	{
    if($this->getTitle())
    {
      return $this->getTitle();
    }
    return 'untitled';
	}
  
  public function getCoordinatorProfile()
  {
    return $this->getsfGuardUser()->getProfile();
  }
  
  public function isEditableBy($user)
  {
    return
      (
      $user->getProfile()->getUserId()===$this->getUserId()
      || 
      $user->hasCredential('proj_adm_ok')
      ||
      $user->getProfile()->getBelongsToTeamById($this->getTeamId())   
      )
      &&
      $this->getState()<Workflow::PROJ_FINISHED;
      
  }
  
  public function isReadyForEmail()
  {
    return
      (
      $this->getsfGuardUser()->getProfile()->getHasValidatedEmail()
      &&
      $this->getState()<Workflow::PROJ_FINISHED
      );
  }
  
  public function isViewableBy($user)
  {
    return 
      $user->getProfile()->getUserId()===$this->getUserId() 
      || 
      $user->hasCredential('proj_monitoring') 
      || 
      $user->hasCredential('admin')
      ||
      $user->getProfile()->getBelongsToTeamById($this->getTeamId())   
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
    $c->add(ProjDeadlinePeer::CURRENT_DEADLINE_DATE, time(), Criteria::LESS_EQUAL);
    $c->add(ProjDeadlinePeer::COMPLETED, false);
    $deadlines=ProjDeadlinePeer::doSelect($c);
    
    if(array_key_exists('astext', $options) and $options['astext'])
    {
      $text='';
      foreach($deadlines as $deadline)
      {
        $text.='* ' . $deadline->getCurrentDeadlineDate('d/m/Y') . ': ' . $deadline->getDescription() . "\n";
      }
      return $text;
    }
    return $deadlines;
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

  public function deleteResource(sfGuardUserProfile $profile, ProjResource $resource)
  {
    if($profile->getUserId()!=$this->getUserId())
    {
      $result['result']='error';
      $result['message']='You are not allowed to remove resources from this project.';
      return $result;
    }
    
    try
    {
      $resource->delete();
      $result['result']='notice';
      $result['message']='The resource/task has been deleted.';
      return $result;
    }
    catch(Exception $e)
    {
      $result['result']='error';
      $result['message']='The resource could not be deleted.';
      return $result;
    }
    
  }

  public function deleteUpshot(sfGuardUserProfile $profile, ProjUpshot $upshot)
  {
    if($profile->getUserId()!=$this->getUserId())
    {
      $result['result']='error';
      $result['message']='You are not allowed to remove upshots from this project.';
      return $result;
    }
    
    try
    {
      $upshot->delete();
      $result['result']='notice';
      $result['message']='The upshot has been deleted.';
      return $result;
    }
    catch(Exception $e)
    {
      $result['result']='error';
      $result['message']='The upshot could not be deleted.';
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
      ->setCompleted(false)
      ->save();
      $result['result']='notice';
      $result['message']='The deadline has been added. Please proceed with filling in the necessary information.';
      $result['redirect']='projects/editdeadline?id=' . $deadline->getId();

      return $result;
    }
    catch(Exception $e)
    {
      $result['result']='error';
      $result['message']='The deadline could not be added.';
      return $result;
    }
  }

  public function addResource(sfGuardUserProfile $profile)
  {
    if($profile->getUserId()!=$this->getUserId())
    {
      $result['result']='error';
      $result['message']='You are not allowed to add resources to this project.';
      return $result;
    }
    
    if($this->getState()!=Workflow::PROJ_DRAFT)
    {
      $result['result']='error';
      $result['message']='You are not allowed to add resources to a project in this state.';
      return $result;
    }
    
    
    try
    {
			$resource=new ProjResource();
			$resource
      ->setSchoolprojectId($this->getId())
      ->save();
      $result['result']='notice';
      $result['message']='The resource/task has been added. Please proceed with filling in the necessary information.';
      $result['redirect']='projects/editresource?id=' . $resource->getId();
      return $result;
    }
    catch(Exception $e)
    {
      $result['result']='error';
      $result['message']='The resource/task could not be added.';
      return $result;
    }
  }

  public function addUpshot(sfGuardUserProfile $profile)
  {
    if($profile->getUserId()!=$this->getUserId())
    {
      $result['result']='error';
      $result['message']='You are not allowed to add upshots to this project.';
      return $result;
    }
    
    if($this->getState()!=Workflow::PROJ_DRAFT)
    {
      $result['result']='error';
      $result['message']='You are not allowed to add upshots to a project in this state.';
      return $result;
    }
    
    
    try
    {
			$upshot=new ProjUpshot();
			$upshot
      ->setSchoolprojectId($this->getId())
      ->save();
      $result['result']='notice';
      $result['message']='The upshot has been added. Please proceed with filling in the necessary information.';
      $result['redirect']='projects/editupshot?id=' . $upshot->getId();
      return $result;
    }
    catch(Exception $e)
    {
      $result['result']='error';
      $result['message']='The upshot could not be added.';
      return $result;
    }
  }


  public function updateFromForm($params, $user=null, $sf_context=null)
  {
    $changedfields = Generic::updateObjectFromForm($this, array(
      'title',
      'description',
      'proj_financing_id',
      'hours_approved',
      'notes',
      'proj_category_id',
      'purposes',
      'addressees',
      'goals',
      'final_report',
      'proposals',
      'reference_number',
      'team_id',
      'no_activity_confirm',
      ), $params);
    
    if($user && $user->getProfile()->getUserId()!=$this->getsfGuardUser()->getId())
    {
      foreach($changedfields as $field)
      {
        $this->addWfevent($user->getProfile()->getUserId(), 
          'Value for field «%fieldname%» set to «%value%»', 
          array('%fieldname%'=>$field, '%value%'=>$params[$field]),
          null,
          $sf_context);
      }
    }
    
    return $this;
  }
  
	
	public function getProjDeadlines($criteria = null, PropelPDO $con = null)
	{
		$criteria=new Criteria();
		$criteria->addAscendingOrderByColumn(ProjDeadlinePeer::ORIGINAL_DEADLINE_DATE);
		$criteria->addAscendingOrderByColumn(ProjDeadlinePeer::DESCRIPTION);
		return parent::getProjDeadlines($criteria);
	}
	
	public function getProjResources($criteria = null, PropelPDO $con = null)
	{
    if(!$criteria)
    {
      $criteria=new Criteria();
    }
    $criteria->addJoin(ProjResourcePeer::PROJ_RESOURCE_TYPE_ID, ProjResourceTypePeer::ID);
		return parent::getProjResources($criteria);
	}
  
  
  public function getActivitiesPerformed()
  {
    $c=new Criteria();
    $c->addJoin(ProjActivityPeer::PROJ_RESOURCE_ID, ProjResourcePeer::ID);
    $c->addJoin(ProjActivityPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
    $c->addJoin(ProjResourcePeer::SCHOOLPROJECT_ID, SchoolProjectPeer::ID);
    $c->addJoin(ProjResourcePeer::PROJ_RESOURCE_TYPE_ID, ProjResourceTypePeer::ID);
    $c->add(SchoolProjectPeer::ID, $this->getId());
    $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
    $c->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME);
    $c->addAscendingOrderByColumn(ProjActivityPeer::BEGINNING);
    return ProjActivityPeer::doSelect($c);
  }

	public function getProjUpshots($criteria = null, PropelPDO $con = null)
	{
		$criteria=new Criteria();
		$criteria->addAscendingOrderByColumn(ProjUpshotPeer::SCHEDULED_DATE);
		return parent::getProjUpshots($criteria);
	}

  public function submit($user_id, $sf_context=null)
  {
    // we need the user_id because the project could be started by someone
    // and submitted by someone else
    
    $checkList=$this->getChecks();

    if ($checkList->getTotalResults(Check::FAILED)==0)
    {
      try
      {
        
        $con = Propel::getConnection(SchoolprojectPeer::DATABASE_NAME);
        $con->beginTransaction();
        
        if($this->getState()==Workflow::PROJ_DRAFT)
        {
          $this
          ->setState(Workflow::PROJ_SUBMITTED)
          ->setSubmissionDate(time())
          ->save($con);
          foreach($this->getProjResources() as $resource)
          {
            $resource
            ->setQuantityApproved($resource->getQuantityEstimated())
            ->setStandardCost($resource->getProjResourceType()->getStandardCost())
            ->save($con);
          }
          $result['result']='notice';
          $result['message']='The project has been submitted.';
          
          $this->addWfevent(
            $user_id,
            'Project submitted',
            null,
            Workflow::PROJ_SUBMITTED,
            $sf_context,
            $con
          );
          
          $con->commit();
        }
        
        elseif($this->getState()==Workflow::PROJ_CONFIRMED)
        {
          $this
          ->setState(Workflow::PROJ_FINISHED)
          ->setSubmissionDate(time())
          ->save($con);
          $result['result']='notice';
          $result['message']='The report has been submitted.';
          
          $this->addWfevent(
            $user_id,
            'Report submitted',
            null,
            Workflow::PROJ_FINISHED,
            $sf_context,
            $con
          );
          
          $con->commit();
          
        }
        
        $steps=Workflow::getProjSteps();
        
        if ($this->getCoordinatorProfile()->sendWorkflowConfirmationMessage($sf_context, 'document_submission',
          array(
            '%document_id%'=>$this->getId(),
            '%document_state%'=>$sf_context->getI18n()->__($steps[$this->getState()]['stateDescription']),
            '%document_description%'=>$sf_context->getI18n()->__('Project «%project%»', array('%project%'=>$this->getTitle())),
            )
          ,
          array(
            sfConfig::get('app_config_projects_notifysubmission_email')=>sfConfig::get('app_config_projects_notifysubmission_name')
            )
        ))
        {
          $result['mail_sent_to']=$this->getCoordinatorProfile()->getEmail();
        }

      }
      catch(Exception $e)
      {
        $result['result']='error';
        $result['message']='The document could not be submitted for an unkwnow reason.';
        $con->rollback();

      }
      return $result;
    }
    else
    {
      $result['result']='error';
      $result['message']='Some errors prevented the submission of the document.';
      $result['checkList']=$checkList;
      return $result;
    }
  }
  
  public function isSubmittable()
  {
    return $this->getState()==Workflow::PROJ_DRAFT or $this->getState()==Workflow::PROJ_CONFIRMED;
  }
  
  public function getChecks()
  {
    $checkList=new CheckList();
    
    if(!$this->isSubmittable())
    {
      $checkList->addCheck(new Check(
				Check::FAILED,
				'The document cannot be submitted when it is in this state',
				'Project',
        array(
          'link_to'=>'projects/edit?id='.$this->getId(),
          )
        ));
      return $checkList;
    }
    
    if(!$this->getsfGuardUser()->getProfile()->getHasValidatedEmail())
    {
      $checkList->addCheck(new Check(
				Check::FAILED,
				'The coordinator does not have a validated email address',
				'Project',
        array(
          'link_to'=>'profile/editprofile'
          )
        ));
    }
    else
    {
      $checkList->addCheck(new Check(
				Check::PASSED,
				'The coordinator has a validated email address',
				'Project'
        ));
    }
    
    if($this->getState()==Workflow::PROJ_DRAFT)
    {
    
      if(!$this->getProjCategoryId())
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          'No category set',
          'Project',
          array(
            'link_to'=>'projects/edit?id=' . $this->getId()
            )
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          'The category is set',
          'Project'
          ));
      }


      if(!$this->getTitle())
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          'No title set',
          'Project',
          array(
            'link_to'=>'projects/edit?id=' . $this->getId()
            )
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          'Title set',
          'Project'
          ));
      }

      if(!$this->getDescription())
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          'No description set',
          'Project',
          array(
            'link_to'=>'projects/edit?id=' . $this->getId()
            )
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          'Description set',
          'Project'
          ));
      }

      if(!$this->getAddressees())
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          'No addressees set',
          'Project',
          array(
            'link_to'=>'projects/edit?id=' . $this->getId()
            )
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          'Addressees set',
          'Project'
          ));
      }


      if(!$this->getPurposes())
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          'No purposes set',
          'Project',
          array(
            'link_to'=>'projects/edit?id=' . $this->getId()
            )
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          'Purposes set',
          'Project'
          ));
      }

      if(!$this->getGoals())
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          'No goals set',
          'Project',
          array(
            'link_to'=>'projects/edit?id=' . $this->getId()
            )
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          'Goals set',
          'Project'
          ));
      }

      $resources=$this->getProjResources();
      if(sizeof($resources)==0)
      {
        if($this->mustHaveResources())
        {
        $checkList->addCheck(new Check(
          Check::FAILED,
          'No resource/task defined',
          'Tasks, resources, schedule',
          array(
            'link_to'=>'projects/edit?id=' . $this->getId() . '#resources'
            )
          )) ;
        }
      }
      else
      {
        foreach($resources as $resource)
        {
          if(!$resource->getQuantityEstimated()>0)
          {
            $checkList->addCheck(new Check(
              Check::FAILED,
              'The quantity defined for the resource is not set',
              'Tasks, resources, schedule',
              array(
                'link_to'=>'projects/editresource?id=' . $resource->getId(),
                )
              ));
          }
          if(!$resource->getProjResourceTypeId())
          {
            $checkList->addCheck(new Check(
              Check::FAILED,
              'The resource type is not set',
              'Tasks, resources, schedule',
              array(
                'link_to'=>'projects/editresource?id=' . $resource->getId(),
                )
              ));
          }
          
        }
        $checkList->addCheck(new Check(
          Check::PASSED,
          'At least a resource/task is defined',
          'Tasks, resources, schedule'
          )) ;
   
      }


      $upshots=$this->getProjUpshots();
      if(sizeof($upshots)==0)
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          'No upshots defined',
          'Expected upshots',
          array(
            'link_to'=>'projects/edit?id=' . $this->getId() . '#upshots'
            )
          ));
      }
      else
      {
        foreach($upshots as $upshot)
        {
          if(!$upshot->getDescription())
          {
            $checkList->addCheck(new Check(
              Check::FAILED,
              'No description defined for upshot',
              'Expected upshots',
              array(
                'link_to'=>'projects/editupshot?id=' . $upshot->getId(),
                )
              ));
          }
          if(!$upshot->getIndicator())
          {
            $checkList->addCheck(new Check(
              Check::FAILED,
              'No indicator defined for upshot',
              'Expected upshots',
              array(
                'link_to'=>'projects/editupshot?id=' . $upshot->getId(),
                )
              ));
          }
        }
        $checkList->addCheck(new Check(
          Check::PASSED,
          'At least an upshot is defined',
          'Expected upshots'
          )) ;

      }


      $deadlines=$this->getProjDeadlines();
      if(sizeof($deadlines)==0)
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          'No deadline defined',
          'Deadlines',
          array(
            'link_to'=>'projects/edit?id=' . $this->getId() . '#deadlines'
            )
          ));
      }
      else
      {
        foreach($deadlines as $deadline)
        {
          if(!$deadline->getOriginalDeadlineDate())
          {
            $checkList->addCheck(new Check(
              Check::FAILED,
              'No date defined for deadline',
              'Deadlines',
              array(
                'link_to'=>'projects/editdeadline?id=' . $deadline->getId(),
                )
              ));
          }
          if(!$deadline->getDescription())
          {
            $checkList->addCheck(new Check(
              Check::FAILED,
              'No description defined for deadline',
              'Deadlines',
              array(
                'link_to'=>'projects/editdeadline?id=' . $deadline->getId(),
                )
              ));
          }
        }
        $checkList->addCheck(new Check(
          Check::PASSED,
          'At least a deadline is defined',
          'Deadlines'
          )) ;
      }
    } // end if project state == PROJ_DRAFT
    
    elseif($this->getState()==Workflow::PROJ_CONFIRMED)
    {
      if(!$this->getFinalReport())
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          'No final report filled',
          'Project',
          array(
            'link_to'=>'projects/edit?id=' . $this->getId()
            )
          ));
      }
      else
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          'Final report filled',
          'Project'
          ));
      }
      
      $be=$this->getBudgetAndExpensesForDeclarableActivities();
      $budget=$be['budget'];
      $expenses=$be['expenses'];
      
      if($expenses > $budget)
      {
        $checkList->addCheck(new Check(
          Check::FAILED,
          'The quantity of activities declared is greater than the one approved',
          'Tasks, resources, schedule',
          array(
            'link_to'=>'projects/edit?id=' . $this->getId() . '#resources'
            )
          )) ;
      }
      elseif($expenses==0 and $budget>0)  // no activity has been declared, but should have
      {
        if($this->getNoActivityConfirm()) // confirmation flag checked
        {
          $checkList->addCheck(new Check(
            Check::PASSED,
            'No activity declared, and confirmation box has been checked',
            'Tasks, resources, schedule'
            )) ;
        }
        else
        {
          $checkList->addCheck(new Check(
            Check::FAILED,
            'No activity declared (you must either declare some, or check the «no activity confirmation» box)',
            'Tasks, resources, schedule',
            array(
              'link_to'=>'projects/edit?id=' . $this->getId() . '#resources'
            )

            )) ;
        }
      }
        
      else // some activities have been declared and confirmed
      {
        $checkList->addCheck(new Check(
          Check::PASSED,
          'The quantity of activities declared is compatible with the one approved',
          'Tasks, resources, schedule'
          )) ;
      }
      

      $upshots=$this->getProjUpshots();
      foreach($upshots as $upshot)
      {
        if(!$upshot->getUpshot())
        {
          $checkList->addCheck(new Check(
            Check::FAILED,
            'No obtained upshot declared',
            'Obtained upshots',
            array(
              'link_to'=>'projects/editupshot?id=' . $upshot->getId(),
              )
            ));
        }
        else
        {
          $checkList->addCheck(new Check(
            Check::PASSED,
            'Obtained upshot declared',
            'Obtained upshots'
            ));
        }
        if(!$upshot->getEvaluation())
        {
          $checkList->addCheck(new Check(
            Check::FAILED,
            'No evaluation declared for upshot',
            'Obtained upshots',
            array(
              'link_to'=>'projects/editupshot?id=' . $upshot->getId(),
              )
            ));
        }
        else
        {
          $checkList->addCheck(new Check(
            Check::PASSED,
            'Evaluation declared for upshot',
            'Obtained upshots'
            ));
        }
      }

      $deadlines=$this->getProjDeadlines();
      foreach($deadlines as $deadline)
      {
        if(!$deadline->getCompleted())
        {
          $checkList->addCheck(new Check(
            Check::FAILED,
            'Deadline not marked as completed',
            'Deadlines',
            array(
              'link_to'=>'projects/editdeadline?id=' . $deadline->getId(),
              )
            ));
        }
        else
        {
          $checkList->addCheck(new Check(
            Check::PASSED,
            'Deadline marked as completed',
            'Deadlines'
            ));
        }
      }
      
        
    } // end if project state == PROJ_CONFIRMED

    return $checkList;
    
  }

  public function getBudgetAndExpensesForDeclarableActivities()
  {
    $prc=new Criteria();
    $prc->add(ProjResourcePeer::STANDARD_COST, 0, Criteria::GREATER_THAN);
    $resources=$this->getProjResources($prc);
    // we need only the resources for which activities could be declared
    
    $budget=0;
    $expenses=0;  
    
    //$logbudget='';
    //$logexpenses='';
    
    foreach($resources as $resource)
    {
      $budget+=$resource->getQuantityApproved()*$resource->getStandardCost();
      //$logbudget.=$resource->getQuantityApproved(). ' * ' . $resource->getStandardCost(). "\n";
      foreach($resource->getProjActivities() as $activity)
      {
        $expenses+=$activity->getQuantity()*$resource->getStandardCost();
        //$logexpenses.=$activity->getQuantity() . ' * ' . $resource->getStandardCost(). "\n";
      }
    }
  
    return array(
      'budget'=>$budget,
      'expenses'=>$expenses,
      );
  }

  
  public function addWfevent($userId, $comment='', $i18n_subs, $state=0, $sf_context=null, $con=null)
  {
    Generic::addWfevent($this, $userId, $comment, $i18n_subs, $state, $sf_context, $con);
    return $this;
  }
  
  public function getWorkflowLogs()
	{
		$t = WfeventPeer::retrieveByClassAndId('Schoolproject', $this->getId(), true);
		if ($t)
			return $t;
		else
			return NULL;
	}
  
  public function getLastEventDate($state, $format='U')
  {
		$t = WfeventPeer::retrieveLastByClassIdAndState('Schoolproject', $this->getId(), $state);
		if ($t)
			return $t->getCreatedAt($format);
		else
			return NULL;
  }

  public function mayHaveResources()
  {
    return $this->getProjCategoryId() ? $this->getProjCategory()->getResources()>0 : false;
  }

  public function mustHaveResources()
  {
    return $this->getProjCategoryId() ? $this->getProjCategory()->getResources()==2 : false;
  }

  public function getReferenceNumberOrDefault()
  {
    if ($this->getState()<Workflow::PROJ_FINISHED or $this->getReferenceNumber())
    {
      return $this->getReferenceNumber();
    }
    else
    {
      return '_______';
    }
  }
  
  public function getEvaluationScale()
  {
    return sprintf('%d - %d', $this->getEvaluationMin(), $this->getEvaluationMax());
  }
  
  public function getCriteriaForTeamSelection()
  {
    $c=new Criteria();
    $userteams=$this->getCoordinatorProfile()->getTeams();
    
    $ids=array();
    foreach($userteams as $userteam)
    {
      $ids[]=$userteam->getTeamId();
    }

    Generic::logMessage('teams', $ids);
    
    $c->add(TeamPeer::ID, $ids, Criteria::IN);
    return $c;
  }

} // Schoolproject
