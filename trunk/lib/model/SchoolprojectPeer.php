<?php


class MyObj
{}

/**
 * SchoolprojectPeer class.
 *
 * @package    schoolmesh
 * @subpackage lib.model
 * @author     Loris Tissino
 * @license    GNU GPLv3 -- see license/gpl.txt for details
 */

class SchoolprojectPeer extends BaseSchoolprojectPeer {

  public static function retrieveAllForYear($year)
	{
		$c=new Criteria();
		$c->add(self::YEAR_ID, $year);
    $stateCriterion = $c->getNewCriterion(self::STATE, Workflow::PROJ_DRAFT, Criteria::GREATER_THAN);
    $refCriterion = $c->getNewCriterion(self::REFERENCE_NUMBER, '', Criteria::NOT_EQUAL);
    $dateCriterion = $c->getNewCriterion(self::SUBMISSION_DATE, 0, Criteria::GREATER_THAN);
    $stateCriterion->addOr($refCriterion);
    $stateCriterion->addOr($dateCriterion);
    $c->add($stateCriterion);
    //$c->add(self::STATE, Workflow::PROJ_DRAFT, Criteria::GREATER_THAN);
		$c->addJoin(self::USER_ID, sfGuardUserPeer::ID);
    self::addAscendingOrderToCriteria($c);
		return self::doSelectJoinAll($c);
	}
  
  public static function retrieveIdsForYear($year, $also_drafts=true)
	{
		$c=new Criteria();
		$c->add(self::YEAR_ID, $year);
    if(!$also_drafts)
    {
      $c->add(self::STATE, Workflow::PROJ_DRAFT, Criteria::GREATER_THAN);
    }
    $c->addJoin(self::PROJ_CATEGORY_ID, ProjCategoryPeer::ID);
    $c->add(ProjCategoryPeer::RESOURCES, 0, Criteria::NOT_EQUAL);
    $c->clearSelectColumns();
    $c->setDistinct();
    $c->addAsColumn('ID', SchoolprojectPeer::ID);
    $stmt=SchoolprojectPeer::doSelectStmt($c);
    
    $result=array();
    while($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
      $result[]=$row->ID;
    }
    return $result;
	}

  public function computeBudgetForChart($ids)
  {
  }

    
  public static function retrieveByPKsSorted($ids)
	{
		$c=new Criteria();
		$c->add(self::ID, $ids, Criteria::IN);
		$c->addJoin(self::USER_ID, sfGuardUserPeer::ID);
    self::addAscendingOrderToCriteria($c);
		return self::doSelectJoinAll($c);
	}

  public static function retrieveAllForYearAndUser($year, $user_id)
	{
		$c=new Criteria();
		$c->add(self::YEAR_ID, $year);
    $c->add(self::USER_ID, $user_id);
		$c->addJoin(self::USER_ID, sfGuardUserPeer::ID);
    self::addAscendingOrderToCriteria($c);
		return self::doSelectJoinAll($c);
	}

  public static function retrieveAllForUser($user_id, $options=array())
	{
		$c=new Criteria();
    $coordinatorCriterion=$c->getNewCriterion(self::USER_ID, $user_id, Criteria::EQUAL);

    if(isset($options['delegated_too']) && $options['delegated_too'])
    {
      $teams=TeamPeer::retrieveJoined($user_id, array('as_array'=>true));
      $delegatedCriterion=$c->getNewCriterion(self::TEAM_ID, $teams, Criteria::IN);
      
      $coordinatorCriterion->addOr($delegatedCriterion); 
      // see http://snippets.symfony-project.org/snippets/tagged/criteria/order_by/popularity
    }

    $c->add($coordinatorCriterion);
		$c->addJoin(self::USER_ID, sfGuardUserPeer::ID);
		$c->addDescendingOrderByColumn(self::YEAR_ID);
    self::addAscendingOrderToCriteria($c);
		return self::doSelectJoinAll($c);
	}

  private static function addAscendingOrderToCriteria(Criteria $c)
  {
    $cols=sfConfig::get('app_config_projects_sort_order', array('title'));
    foreach($cols as $col)
    {
      $c->addAscendingOrderByColumn('schoolproject.' . strtoupper($col));
    }
  }

	public static function retrieveByTitleAndYear($title, $yearId)
	{
		$c=new Criteria();
		$c->add(self::TITLE, $title);
		$c->add(self::YEAR_ID, $yearId);
		return self::doSelectOne($c);
	}

  public static function reassign($user, $params, $sf_context=null, $options=array())
  {
    $ids=$user->getAttribute('ids');
    $user_id=$user->getProfile()->getId();

    $profile=sfGuardUserProfilePeer::retrieveByPK($params['user_id']);
    if(!$profile->getIsActive())
    {
      $result['result']='error';
      $result['message']='The selected user is not active.';
      return $result;
    }

    if(!$profile->hasPermission('proj_coordination'))
    {
      $result['result']='error';
      $result['message']='The selected user is not allowed to coordinate projects.';
      return $result;
    }

    $projects = SchoolprojectPeer::retrieveByPKs($ids);
    foreach($projects as $project)
    {
      $project
      ->setUserId($params['user_id'])
      ;
      $project->addWfevent(
          $user_id,
          'Reassigned to %user%',
          array('%user%'=>$profile->getFullName()),
          null,
          $sf_context
        );
      $project->save();
    }
    $result['result']='notice';
    $result['message']='Projects information have been updated.';
    return $result;
    
  }

  private static function _setGenericDate($user, $params, $sf_context=null, $options=array())
  {
    $ids=$user->getAttribute('ids');
    $user_id=$user->getProfile()->getId();
    
    $setDateMethod='set'.$options['methodkey'].'Date';
    $setNotesMethod='set'.$options['methodkey'].'Notes';
    
    if($params['date']>date('Y-m-d', time()))
    {
      $result['result']='error';
      $result['message']='The date cannot be set in the future.';
      return $result;
    }

    if($params['notes']=='')
    {
      $result['result']='error';
      $result['message']='The notes field cannot be left blank.';
      return $result;
    }

    $projects = SchoolprojectPeer::retrieveByPKs($ids);
    foreach($projects as $project)
    {
      $project
      ->$setDateMethod($params['date'])
      ->$setNotesMethod($params['notes'])
      ;
      $project->addWfevent(
          $user_id,
          $options['date'] . ' set to %date% (%comment%)',
          array('%date%'=>$params['date'], '%comment%'=>$params['notes']),
          null,
          $sf_context
        );

      if ($project->getState()<$options['comparison_state'])
      {
        $project->setState($options['comparison_state']);
        $project->addWfevent(
          $user_id,
          sprintf('State set to «%s»', $options['newstate']),
          null,
          $options['comparison_state'],
          $sf_context
        );
      }
      $project->save();
    }
    $result['result']='notice';
    $result['message']='Projects information have been updated.';
    return $result;
  }

  public static function setApprovalDate($user, $params, $sf_context=null)
  {
    return self::_setGenericDate($user, $params, $sf_context,
      array(
        'date'=>'Approval date',
        'methodkey'=>'Approval',
        'comparison_state'=>Workflow::PROJ_APPROVED,
        'newstate'=>'approved',
        )
      );
  }

  public static function setFinancingDate($user, $params, $sf_context=null)
  {
    return self::_setGenericDate($user, $params, $sf_context,
      array(
        'date'=>'Financing date',
        'methodkey'=>'Financing',
        'comparison_state'=>Workflow::PROJ_FINANCED,
        'newstate'=>'financed',
        )
      );
  }

  public static function setConfirmationDate($user, $params, $sf_context=null)
  {
    return self::_setGenericDate($user, $params, $sf_context,
      array(
        'date'=>'Confirmation date',
        'methodkey'=>'Confirmation',
        'comparison_state'=>Workflow::PROJ_CONFIRMED,
        'newstate'=>'confirmed',
        )
      );
  }

  public static function updateStandardCosts($user, $ids, $sf_context=null)
  {
    $user_id=$user->getProfile()->getId();
    
    $projectsNo = 0;
    $resourcesNo = 0;
    
    $costscache=array();
    
    $projects = SchoolprojectPeer::retrieveByPKs($ids);
    foreach($projects as $project)
    {
      if($project->getState()<Workflow::PROJ_FINISHED)
      {
        $resources=$project->getProjResources();
        $projdirty=false;
        foreach($resources as $resource)
        {
          if(!array_key_exists($resource->getProjResourceTypeId(), $costscache))
          {
            // we cache the results...
            $costscache[$resource->getProjResourceTypeId()]=array(
              'cost'=>$resource->getProjResourceType()->getStandardCost(),
              'is_monetary'=>$resource->getProjResourceType()->getIsMonetary()
              );
          }
          if(
            ($costscache[$resource->getProjResourceTypeId()]['cost']!=$resource->getStandardCost())
            or
            ($costscache[$resource->getProjResourceTypeId()]['is_monetary']!=$resource->getIsMonetary())
            )
          {
            $resource
            ->setStandardCost($costscache[$resource->getProjResourceTypeId()]['cost'])
            ->setIsMonetary($costscache[$resource->getProjResourceTypeId()]['is_monetary'])
            ->save();
            $projdirty=true;
            $project->addWfevent(
              $user_id,
              'Updated standard cost of resource «%resource%», set to «%amount%» (monetary? %monetary%)',
              array('%resource%'=>$resource->getDescription(), '%amount%'=>$resource->getStandardCost(), '%monetary%'=>$resource->getIsMonetary()?'1':'0'),
              null,
              $sf_context
            );
          }
        }
        if($projdirty)
        {
          $projectsNo++;
        }
        
      }
    }
    $result['result']='notice';
    if($projectsNo)
    {
      $result['message']='Standard costs updated.';
    }
    else
    {
      $result['message']='No standard cost update needed.';
    }
    return $result;

  }
  
  public static function resetToDraft($user, $projects, $sf_context=null)
  {
    $user_id=$user->getProfile()->getId();
    
    foreach($projects as $project)
    {
      $project
      ->setState(Workflow::PROJ_DRAFT)
      ->addWfevent(
        $user_id,
        'Project reset to draft',
        null,
        null,
        $sf_context
      )
      ->save()
      ;
    }
    
    $result['result']='notice';
    $result['message']='All selected projects have been correctly reset to draft state.';
    return $result;

  }
  
  public static function computeDataSynthesis($ids, $staffonly)
  {
    $projResourceTypes=ProjResourceTypePeer::retrieveSortedByRank($staffonly);
    
    $types=array();
 
    $result=array();

    $projects=self::retrieveByPKsSorted($ids);
    
    $criteria=new Criteria();
    if($staffonly)
    {
      $criteria->add(ProjResourceTypePeer::ROLE_ID, null, Criteria::ISNOTNULL);
    }
    
    foreach($projects as $project)
    {
      $result['projects'][$project->getId()]['title']=$project->getTitle();
      $result['projects'][$project->getId()]['id']=$project->getId();
      $result['projects'][$project->getId()]['resources']=array();
      foreach($project->getProjResources($criteria) as $resource)
      {
        $amount=$resource->getQuantityMultipliedByCost()-$resource->getAmountFundedExternally();
        if($amount)
        {
          @$result['projects'][$project->getId()]['resources'][$resource->getProjResourceTypeId()]+=$amount;
          if(!array_key_exists($resource->getProjResourceTypeId(), $types))
          {
            $types[$resource->getProjResourceTypeId()]=1;
          }
        }
      }
    }
    
    $result['types']=ProjResourceTypePeer::retrieveByPKsSortedByRank(array_keys($types));
    
    return $result;
  }
  
	public static function getChargeLetters($ids, $filetype='odt', $context=null)
	{
    return self::_getInfoLetters($ids, 'Charge letters', 'projects_charges.odt', $filetype, array('date'=>'current', 'resources_query'=>'charge', 'resources_sort'=>'type'), $context);
	}

	public static function getTaskChargeLetters($ids, $filetype='odt', $context=null)
	{
    return self::_getResourceInfoLetters($ids, 'Charge letters', 'projects_tasks_charges.odt', $filetype, array('date'=>'current', 'resources_query'=>'charge', 'resources_sort'=>'type'), $context);
    // we cannot call _getInfoLetters, because we need a letter for each charged user, not for each project...
	}

	public static function getSubmissionLetters($ids, $filetype='odt', $context=null)
	{
    return self::_getInfoLetters($ids, 'Submission letters', 'projects_submission.odt', $filetype, array('date'=>'submission', 'resources_query'=>'submission', 'resources_sort'=>'date'), $context);
	}
  
	public static function getFinalReportLetters($ids, $filetype='odt', $context=null)
	{
    return self::_getInfoLetters($ids, 'Final reports', 'projects_report.odt', $filetype, array('date'=>'report', 'resources_query'=>'submission', 'resources_sort'=>'date'), $context);
	}

	private static function _getInfoLetters($ids, $filename, $templatename, $filetype='odt', $options=array(), $context=null)
	{
		$result=Array();

		$usertypes=Array();
		
		$projects=self::retrieveByPks($ids);
		
		try
		{
			$odf=new OdfDoc($templatename, $context?$context->getI18N()->__($filename):$filename, $filetype);
		}
		catch (Exception $e)
		{
			if ($e InstanceOf OdfDocTemplateException)
			{
				$result['result']='error';
				$result['message']='Template not found or not readable: '. $templatename;
				return $result;
			}
			
			if ($e InstanceOf OdfException)
			{
				$result['result']='error';
				$result['message']='Template not valid: '. $templatename;
				return $result;
			}
			
			throw $e;
		}
		
		$odfdoc=$odf->getOdfDocument();
		$letters=$odfdoc->setSegment('letters');
		$count=0;
		foreach($projects as $project)
		{
			$count++;
      
      $user=$project->getCoordinatorProfile();
			$letters->userTitle($user->getLettertitle());
			$letters->userFullName($user->getFullName());
      $letters->userEmail($user->getValidatedEmail());
			$letters->projectTitle($project->getTitle());
      $letters->projectCode($project->getCode());
      $letters->approvalDate($project->getApprovalDate('d/m/Y'));
      $letters->financingDate($project->getFinancingDate('d/m/Y'));
      $letters->confirmationDate($project->getConfirmationDate('d/m/Y'));
			$letters->schoolPrincipal(sfConfig::get('app_school_principal', 'missing Principal name in config file'));
      
      $letters->referenceNumber($project->getReferenceNumberOrDefault());
      
      if($project->getState()>=Workflow::PROJ_FINISHED)
      {
        $letters->projectScale($project->getEvaluationScale());
      }
      
      switch($options['date'])
      {
        case 'current':
          $letters->letterDate(date('d/m/Y'));
          break;
        case 'submission':
          $letters->letterDate($project->getLastEventDate(Workflow::PROJ_SUBMITTED, 'd/m/Y'));
          break;
        case 'report':
          $letters->letterDate($project->getLastEventDate(Workflow::PROJ_FINISHED, 'd/m/Y'));
          break;
        default:
          $letters->letterDate('_______');
      }
      
      //Generic::logMessage('details', $project->getPrintableProjDetails($options['date']));
      try
      {
        foreach($project->getPrintableProjDetails($options['date']) as $detail)
        {
          $letters->details->detailDescription($detail->getProjDetailType()->getDescription());
          $letters->details->detailContent(OdfDocPeer::textvalue2odt($detail->getContent()));
          $letters->details->merge();
        }
      }
      catch (Exception $e)
      {
        if($e instanceof SegmentException)
        {
          // we just pass... the details segment actually can be missing
        }
        else
        {
          throw $e;
        }
      }
      
      $usedtypes=array();
      
      $externalResources=0;
      
      $c=new Criteria();
      
      switch($options['resources_query'])
      {
        case 'submission':
          $c->add(ProjResourceTypePeer::PRINTED_IN_SUBMISSION_LETTERS, true);
          break;
        case 'charge':
          $c->add(ProjResourceTypePeer::PRINTED_IN_CHARGE_LETTERS, true);
          break;
        case 'report':
          $c->add(ProjResourceTypePeer::PRINTED_IN_CHARGE_LETTERS, true);
          break;
      }

      switch($options['resources_sort'])
      {
        case 'date':
          $c->addAscendingOrderByColumn(ProjResourcePeer::SCHEDULED_DEADLINE);
          break;
        case 'type':
          $c->addAscendingOrderByColumn(ProjResourceTypePeer::RANK);
          break;
      }


      if($project->getState()<Workflow::PROJ_FINISHED)
      {
        foreach($project->getProjResources($c) as $Resource)
        {
          $ResourceType=$Resource->getProjResourceType();
          
          if($project->getState()<Workflow::PROJ_FINISHED)
          {
            $letters->resources->resourceDescription($Resource->getDescription());
            $letters->resources->resourceType($ResourceType->getDescription());
                    
            $letters->resources->resourceChargedUser($Resource->getChargedUserProfile());
            $letters->resources->resourceQuantity(OdfDocPeer::quantityvalue($Resource->getQuantityApproved(), $ResourceType->getMeasurementUnit()));
            $letters->resources->merge();
            if($ResourceType->getRoleId())
            {
              $usedtypes[$ResourceType->getId()]=$ResourceType;
            }
          }
        }
      }
      else // it is a final report, we need a log for each person that performed an activity...
      {
        
        $oldname='';
        $quantities=array();
        $activities=$project->getActivitiesPerformed();
        foreach($activities as $activity)
        {
          $fullname=$activity->getPerformerProfile()->getFullName();
          if($oldname!=$fullname)
          {
            if($oldname!='')
            {
              $letters->performers->performerQuantity(self::_quantitiesToString($quantities, $context));
              $letters->performers->merge();
              $quantities=array();
            }
            $oldname=$fullname;
            $letters->performers->performerFullName($fullname);
          }
          $letters->performers->activities->activityBeginning(
            $activity->getPaperLog()?
              $context->getI18N()->__('paper log')
              :
              $activity->getBeginning('d/m/y h:i')
          );
          $letters->performers->activities->activityQuantity(OdfDocPeer::quantityvalue($activity->getQuantity(), $activity->getProjResource()->getProjResourceType()->getMeasurementUnit()));
          $letters->performers->activities->activityResourceType($activity->getProjResource()->getProjResourceType()->getShortcut());
          $letters->performers->activities->activityDescription($activity->getNotes());
          $letters->performers->activities->merge();
          if (!isset($quantities['quantities'][$activity->getProjResource()->getProjResourceType()->getShortcut()]))
          {
            $quantities['quantities'][$activity->getProjResource()->getProjResourceType()->getShortcut()]=0;
          }
          $quantities['quantities'][$activity->getProjResource()->getProjResourceType()->getShortcut()]+=$activity->getQuantity();
          $quantities['descriptions'][$activity->getProjResource()->getProjResourceType()->getShortcut()]=$activity->getProjResource()->getProjResourceType()->getDescription();
          $quantities['mu'][$activity->getProjResource()->getProjResourceType()->getShortcut()]=$activity->getProjResource()->getProjResourceType()->getMeasurementUnit();
        }
        $letters->performers->performerQuantity(self::_quantitiesToString($quantities, $context));
        $letters->performers->merge();
          
      }
      
      try
      {
        foreach($project->getProjUpshots() as $Upshot)
        {
          $letters->upshots->upshotDescription($Upshot->getDescription());
          $letters->upshots->upshotIndicator($Upshot->getIndicator());
          if($project->getState()>=Workflow::PROJ_FINISHED)
          {
            $letters->upshots->upshotUpshot($Upshot->getUpshot());
            $letters->upshots->upshotEvaluation($Upshot->getEvaluation());
          }
          
          $letters->upshots->merge();
        }
      }
      catch (Exception $e)
      {
        if($e instanceof SegmentException)
        {
          // we just pass... the upshots segment actually can be missing
        }
        else
        {
          throw $e;
        }        
      }

      try
      {
        foreach($project->getProjDeadlines() as $Deadline)
        {
          $letters->deadlines->deadlineDate($Deadline->getOriginalDeadlineDate('d/m/y'));
          $letters->deadlines->deadlineDescription($Deadline->getDescription());
          
          if($project->getState()>=Workflow::PROJ_FINISHED)
          {
            $letters->deadlines->deadlineDate($Deadline->getCurrentDeadlineDate('d/m/y'));
            $letters->deadlines->deadlineNotes($Deadline->getNotes());
            $attachments=$Deadline->hasAttachmentFiles()?$context->getI18N()->__('yes'):$context->getI18N()->__('no');
            $letters->deadlines->deadlineAttachment($attachments);
          }
          
          $letters->deadlines->merge();
        }
      }
      catch (Exception $e)
      {
        if($e instanceof SegmentException)
        {
          // we just pass... the deadlines segment actually can be missing
        }
        else
        {
          throw $e;
        }        
      }
 
      if($project->getState()<=Workflow::PROJ_FINISHED)
      {
        foreach($usedtypes as $ResourceType)
        {
          $letters->resourcetypes->rtDescription($ResourceType->getDescription());
          $letters->resourcetypes->rtStandardCost(OdfDocPeer::quantityvalue($ResourceType->getStandardCost(), sfConfig::get('app_config_currency_symbol')));
          $letters->resourcetypes->merge();
        }
      }
    

      $pagebreak=($count<sizeof($projects))?'<pagebreak>':'';  
      $letters->pagebreak($pagebreak);
      $letters->merge();
    }
		
		$odfdoc->mergeSegment($letters);

		$result['content']=$odf;
		$result['result']='notice';
		return $result;

	}

	private static function _getResourceInfoLetters($ids, $filename, $templatename, $filetype='odt', $options=array(), $context=null)
	{
		$result=Array();

		$usertypes=Array();
		
		$projects=self::retrieveByPks($ids);
		
		try
		{
			$odf=new OdfDoc($templatename, $context?$context->getI18N()->__($filename):$filename, $filetype);
		}
		catch (Exception $e)
		{
			if ($e InstanceOf OdfDocTemplateException)
			{
				$result['result']='error';
				$result['message']='Template not found or not readable: '. $templatename;
				return $result;
			}
			
			if ($e InstanceOf OdfException)
			{
				$result['result']='error';
				$result['message']='Template not valid: '. $templatename;
				return $result;
			}
			
			throw $e;
		}
		
		$odfdoc=$odf->getOdfDocument();
		$letters=$odfdoc->setSegment('letters');
		$count=0;
		foreach($projects as $project)
		{
      foreach($project->getResourceChargedUsersIds() as $cu_id)
      {
        $count++;
        
        $user=sfGuardUserProfilePeer::retrieveByPK($cu_id);
        $letters->userTitle($user->getLettertitle());
        $letters->userFullName($user->getFullName());
        $letters->projectTitle($project->getTitle());
        $letters->projectCode($project->getCode());
        $letters->approvalDate($project->getApprovalDate('d/m/Y'));
        $letters->financingDate($project->getFinancingDate('d/m/Y'));
        $letters->confirmationDate($project->getConfirmationDate('d/m/Y'));
        $letters->schoolPrincipal(sfConfig::get('app_school_principal', 'missing Principal name in config file'));
        
        $letters->referenceNumber($project->getReferenceNumberOrDefault());
        
        if($project->getState()>=Workflow::PROJ_FINISHED)
        {
          $letters->projectScale($project->getEvaluationScale());
        }
        
        switch($options['date'])
        {
          case 'current':
            $letters->letterDate(date('d/m/Y'));
            break;
          case 'submission':
            $letters->letterDate($project->getLastEventDate(Workflow::PROJ_SUBMITTED, 'd/m/Y'));
            break;
          case 'report':
            $letters->letterDate($project->getLastEventDate(Workflow::PROJ_FINISHED, 'd/m/Y'));
            break;
          default:
            $letters->letterDate('_______');
        }
        
        $c=new Criteria();
        
        switch($options['resources_query'])
        {
          case 'submission':
            $c->add(ProjResourceTypePeer::PRINTED_IN_SUBMISSION_LETTERS, true);
            break;
          case 'charge':
            $c->add(ProjResourceTypePeer::PRINTED_IN_CHARGE_LETTERS, true);
            break;
          case 'report':
            $c->add(ProjResourceTypePeer::PRINTED_IN_CHARGE_LETTERS, true);
            break;
        }

        switch($options['resources_sort'])
        {
          case 'date':
            $c->addAscendingOrderByColumn(ProjResourcePeer::SCHEDULED_DEADLINE);
            break;
          case 'type':
            $c->addAscendingOrderByColumn(ProjResourceTypePeer::RANK);
            break;
        }
        
        $c->add(ProjResourcePeer::CHARGED_USER_ID, $cu_id);

        foreach($project->getProjResourcesSynthesis($c) as $Resource)
        {
//          $ResourceType=$Resource->getProjResourceType();
          
          if($project->getState()<Workflow::PROJ_FINISHED)
          {
            $letters->resources->resourceDescription($Resource->DESCRIPTION);
            $letters->resources->resourceType($Resource->TYPE_DESCRIPTION);
                    
            $letters->resources->resourceQuantity(OdfDocPeer::quantityvalue($Resource->QUANTITY_APPROVED, $Resource->TYPE_MEASUREMENT_UNIT));
            $letters->resources->merge();
          }
        }   
        
        $pagebreak='<pagebreak>';  
        $letters->pagebreak($pagebreak);
        $letters->merge();
      }
      
    }
		
		$odfdoc->mergeSegment($letters);

		$result['content']=$odf;
		$result['result']='notice';
		return $result;

	}


	public static function getStaffSynthesisDoc($ids, $filetype='odt', $context=null)
	{
		$result=Array();

		$projects=self::retrieveByPks($ids);
		
    $filename='Staff Synthetic Data';
    $templatename='projects_staffsynthesis.odt';
    
		try
		{
			$odf=new OdfDoc($templatename, $context?$context->getI18N()->__($filename):$filename, $filetype);
		}
		catch (Exception $e)
		{
			if ($e InstanceOf OdfDocTemplateException)
			{
				$result['result']='error';
				$result['message']='Template not found or not readable: '. $templatename;
				return $result;
			}
			
			if ($e InstanceOf OdfException)
			{
				$result['result']='error';
				$result['message']='Template not valid: '. $templatename;
				return $result;
			}
			
			throw $e;
		}
		
    
		$odfdoc=$odf->getOdfDocument();
		$roles=$odfdoc->setSegment('roles');
		$count=0;
    
    $dirty=false;
    
		foreach(ProjResourceTypePeer::retrieveSortedByRank(true) as $projResourceType)
		{
			$count++;
      
      $criteria= new Criteria();
      $criteria->add(ProjResourceTypePeer::ID, $projResourceType->getId());
      
      $total=0;
      $totalInternal=0;
      
      foreach($projects as $project)
      {
        
        $resources=$project->getProjResources($criteria);
        
        $chargedUsers=array();
        $anonymousUsers=false;
        $hours=0;
        $amount=0;
        $externallyFunded=0;
        
        foreach($resources as $resource)
        {
          if($resource->getChargedUserId())
          {
            @$chargedUsers[$resource->getChargedUserId()]++;
          }
          else
          {
            $anonymousUsers=true;
          }
          
          $hours+=$resource->getQuantityApproved();
          $amount+=$resource->getQuantityMultipliedByCost();
          $externallyFunded+=$resource->getAmountFundedExternally();
        }
        if(sizeof($chargedUsers)>0 || $anonymousUsers>0)
        {
          
          $roles->projects->projectTitle($project->getTitleWithCode());
          $roles->projects->projectCoordinator($project->getCoordinatorProfile()->getLastname());
          $roles->projects->projectNumber(sprintf('%s %d', ($anonymousUsers?'* ': ''), sizeof($chargedUsers), $anonymousUsers));
          $roles->projects->projectHours($hours);
          $roles->projects->projectAmount(OdfDocPeer::quantityvalue($amount, sfConfig::get('app_config_currency_symbol')));
          $roles->projects->projectInternalAmount(OdfDocPeer::quantityvalue($amount-$externallyFunded, sfConfig::get('app_config_currency_symbol')));
          
          $total+=$amount;
          $totalInternal+=$amount-$externallyFunded;

          $roles->projects->merge();
          
          $roles->roleDescription($projResourceType->getDescription());
          $roles->roleTotalAmount(OdfDocPeer::quantityvalue($total, sfConfig::get('app_config_currency_symbol')));
          $roles->roleTotalInternalAmount(OdfDocPeer::quantityvalue($totalInternal, sfConfig::get('app_config_currency_symbol')));
          $dirty=true;

        }
      }
      
      if($dirty)
      {
        $roles->merge();
      }
      
      unset($criteria);
		}
		
		$odfdoc->mergeSegment($roles);

		$result['content']=$odf;
		$result['result']='notice';
		return $result;

	}

  private static function _quantitiesToString($quantities=array(), $sf_context=null)
  {
    // $quantities is an array like
    // ['descriptions']['TA']="Teachers' activities"
    // ['descriptions']['JA']="Janitors' activities"
    // ['quantities']['TA']=20
    // ['quantities']['JA']=40
    // ['mu']['TA']="h"
    // ['mu']['JA']="h"
    
    if(!isset($quantities['quantities']))
    {
      return '';
    }
    
    $text='';
    foreach($quantities['quantities'] as $key=>$value)
    {
      $text.=$sf_context->getI18N()->__('Total for %shortcut% (%description%): %quantity%', array(
        '%shortcut%'=>$key,
        '%description%'=>$quantities['descriptions'][$key],
        '%quantity%'=>OdfDocPeer::quantityvalue($quantities['quantities'][$key], $quantities['mu'][$key]
        ))) . '<br />';
    }
    return $text;
  }
  
  public static function getSynthesisBudgetData($ids=array())
  {
    $states = Workflow::getProjSteps();
    
    // we need to run three separate queries and then mix up the values
    // it could be possible in some other ways with pure SQL, but with
    // Propel it seems a bit complicated...
    
		$c1=new Criteria();
    $c1->addJoin(self::ID, ProjResourcePeer::SCHOOLPROJECT_ID, Criteria::LEFT_JOIN);
    //$c->addJoin(ProjResourcePeer::ID, ProjActivityPeer::PROJ_RESOURCE_ID, Criteria::LEFT_JOIN);
    $c1->add(self::ID, $ids, Criteria::IN);
    //$c->add(ProjActivityPeer::ACKNOWLEDGED_AT, null, Criteria::ISNOTNULL);
    $c1->clearSelectColumns();
    $c1->setDistinct();
    $c1->addAsColumn('ID', SchoolprojectPeer::ID);
    $c1->addAsColumn('CODE', SchoolprojectPeer::CODE);
    $c1->addAsColumn('TITLE', SchoolprojectPeer::TITLE);
    $c1->addAsColumn('STATE', SchoolprojectPeer::STATE);
    $c1->addAsColumn('EVALUATION_MIN', SchoolprojectPeer::EVALUATION_MIN);
    $c1->addAsColumn('EVALUATION_MAX', SchoolprojectPeer::EVALUATION_MAX);
    $c1->addAsColumn('TOTAL_AMOUNT', 'SUM(IF(' . ProjResourcePeer::STANDARD_COST . ' IS NULL, ' . ProjResourcePeer::QUANTITY_APPROVED . ', ' . ProjResourcePeer::QUANTITY_APPROVED . ' * ' . ProjResourcePeer::STANDARD_COST . '))');
    $c1->addAsColumn('EXTERNAL_FUNDING', 'SUM(' . ProjResourcePeer::AMOUNT_FUNDED_EXTERNALLY . ')');
    //$c->addAsColumn('DECLARED_ACTIVITIES', 'SUM(IF(' . ProjActivityPeer::ACKNOWLEDGED_AT . ' IS NOT NULL, ' . ProjActivityPeer::QUANTITY . ', 0) * ' . ProjResourcePeer::STANDARD_COST . ')');
    $c1->addGroupByColumn(SchoolprojectPeer::ID);
    $c1->addGroupByColumn(SchoolprojectPeer::TITLE);
    self::addAscendingOrderToCriteria($c1);
    $stmt=SchoolprojectPeer::doSelectStmt($c1);
    
    $result=array();
    while($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
      $row->INTERNAL_FUNDING = $row->TOTAL_AMOUNT - $row->EXTERNAL_FUNDING;
      $row->STATE=$states[$row->STATE]['stateDescription'];
      $row->STAFF=array();
      $result[$row->ID]=$row;
      $result[$row->ID]->ACKNOWLEDGED_ACTIVITIES = 0;
      $result[$row->ID]->AVG_EVALUATION = 'N/A';
      
    }
    
		$c2=new Criteria();
    $c2->addJoin(self::ID, ProjResourcePeer::SCHOOLPROJECT_ID, Criteria::LEFT_JOIN);
    $c2->addJoin(ProjResourcePeer::ID, ProjActivityPeer::PROJ_RESOURCE_ID, Criteria::LEFT_JOIN);
    $c2->add(self::ID, $ids, Criteria::IN);
    $c2->add(ProjActivityPeer::ACKNOWLEDGED_AT, null, Criteria::ISNOTNULL);
    $c2->clearSelectColumns();
    $c2->setDistinct();
    $c2->addAsColumn('ID', SchoolprojectPeer::ID);
    $c2->addAsColumn('ACKNOWLEDGED_ACTIVITIES', 'SUM(IF(' . ProjActivityPeer::ACKNOWLEDGED_AT . ' IS NOT NULL, ' . ProjActivityPeer::QUANTITY . ', 0) * ' . ProjResourcePeer::STANDARD_COST . ')');
    $c2->addGroupByColumn(SchoolprojectPeer::ID);
    self::addAscendingOrderToCriteria($c2);
    $stmt=SchoolprojectPeer::doSelectStmt($c2);
    
    while($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
      $result[$row->ID]->ACKNOWLEDGED_ACTIVITIES = $row->ACKNOWLEDGED_ACTIVITIES;
    }

		$c3=new Criteria();
    $c3->addJoin(self::ID, ProjResourcePeer::SCHOOLPROJECT_ID, Criteria::LEFT_JOIN);
    $c3->addJoin(ProjResourcePeer::ID, ProjActivityPeer::PROJ_RESOURCE_ID, Criteria::LEFT_JOIN);
    $c3->addJoin(ProjActivityPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
    $c3->addJoin(sfGuardUserProfilePeer::ROLE_ID, RolePeer::ID);
    $c3->add(self::ID, $ids, Criteria::IN);
    $c3->add(ProjActivityPeer::ACKNOWLEDGED_AT, null, Criteria::ISNOTNULL);
    $c3->clearSelectColumns();
    $c3->setDistinct();
    $c3->addAsColumn('ID', SchoolprojectPeer::ID);
    $c3->addAsColumn('ROLE', RolePeer::MALE_DESCRIPTION);
    $c3->addAsColumn('NUMBER', 'COUNT( DISTINCT ' . ProjActivityPeer::USER_ID . ')');
    $c3->addGroupByColumn(SchoolprojectPeer::ID);
    $c3->addGroupByColumn(RolePeer::MALE_DESCRIPTION);
    
    self::addAscendingOrderToCriteria($c3);
    
    $stmt=SchoolprojectPeer::doSelectStmt($c3);
    
    $old_id=null;
    
    while($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
      $result[$row->ID]->STAFF[$row->ROLE] = $row->NUMBER;
    }
    
		$c4=new Criteria();
    $c4->addJoin(self::ID, ProjUpshotPeer::SCHOOLPROJECT_ID, Criteria::LEFT_JOIN);
    $c4->add(self::ID, $ids, Criteria::IN);
    $c4->add(ProjUpshotPeer::EVALUATION, 0, Criteria::GREATER_THAN);  // it could be NULL or -1 for N/A
    $c4->clearSelectColumns();
    $c4->setDistinct();
    $c4->addAsColumn('ID', SchoolprojectPeer::ID);
    $c4->addAsColumn('AVG_EVALUATION', 'AVG(' . ProjUpshotPeer::EVALUATION . ')');
    $c4->addGroupByColumn(SchoolprojectPeer::ID);
    
    self::addAscendingOrderToCriteria($c4);
    
    $stmt=SchoolprojectPeer::doSelectStmt($c4);
    
    while($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
      $result[$row->ID]->AVG_EVALUATION = $row->AVG_EVALUATION;
    }
    return $result;    
    
  }
  
  public static function getStatsForYear($year)
	{
		$c=new Criteria();
		$c->add(self::YEAR_ID, $year);
    $c->clearSelectColumns();
    $c->setDistinct();
    $c->addAsColumn('STATE', SchoolprojectPeer::STATE);
    $c->addAsColumn('NUMBER', 'COUNT(' . SchoolprojectPeer::ID . ')');
    $c->addGroupByColumn(SchoolprojectPeer::STATE);
    $stmt=SchoolprojectPeer::doSelectStmt($c);
    
    $states = Workflow::getProjSteps();
    
    $result=array();
    while($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
      if(isset($states[$row->STATE]))
      {
        $row->STATEDESCRIPTION=$states[$row->STATE]['stateDescription'];
      }
      $result[]=$row;
    }
    return $result;
	}

} // SchoolprojectPeer



/*
SELECT schoolproject.ID AS ID, schoolproject.TITLE AS TITLE, SUM( IF( proj_resource.STANDARD_COST IS NULL , proj_resource.QUANTITY_APPROVED, proj_resource.QUANTITY_APPROVED * proj_resource.STANDARD_COST ) ) AS TOTAL_AMOUNT, SUM( proj_resource.AMOUNT_FUNDED_EXTERNALLY ) AS EXTERNAL_FUNDING, SUM(quantity*proj_resource.STANDARD_COST) as DECLARED_ACTIVITIES
FROM  `schoolproject` LEFT JOIN `proj_resource` on schoolproject.ID = proj_resource.SCHOOLPROJECT_ID LEFT JOIN proj_activity on proj_activity.PROJ_RESOURCE_ID = proj_resource.ID
WHERE schoolproject.ID
IN (
'64'
)
AND proj_activity.ACKNOWLEDGED_AT is not null
GROUP BY schoolproject.ID, schoolproject.TITLE
* 
* 
* 
* SELECT DISTINCT role.MALE_DESCRIPTION AS ROLE, COUNT( DISTINCT proj_activity.USER_ID ) AS NUMBER
FROM  `schoolproject` 
CROSS JOIN  `sf_guard_user_profile` 
CROSS JOIN  `role` 
LEFT JOIN proj_resource ON ( schoolproject.ID = proj_resource.SCHOOLPROJECT_ID ) 
LEFT JOIN proj_activity ON ( proj_resource.ID = proj_activity.PROJ_RESOURCE_ID ) 
WHERE schoolproject.ID
IN (
 '63',  '64',  '65',  '68',  '69',  '70',  '71',  '72',  '73',  '74',  '75',  '77',  '78',  '79',  '80',  '81',  '82',  '83',  '84',  '85',  '87',  '88',  '89',  '90',  '91',  '92'
)
AND proj_activity.ACKNOWLEDGED_AT IS NOT NULL 
AND proj_activity.USER_ID = sf_guard_user_profile.USER_ID
AND sf_guard_user_profile.ROLE_ID = role.ID
GROUP BY role.MALE_DESCRIPTION
ORDER BY schoolproject.CODE ASC , schoolproject.PROJ_CATEGORY_ID ASC , schoolproject.TITLE ASC 
* 
*/
