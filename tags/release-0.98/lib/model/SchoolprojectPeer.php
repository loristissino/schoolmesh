<?php

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
    $c->add(self::STATE, Workflow::PROJ_DRAFT, Criteria::GREATER_THAN);
		$c->addJoin(self::USER_ID, sfGuardUserPeer::ID);
		$c->addAscendingOrderByColumn(self::PROJ_CATEGORY_ID);
		$c->addAscendingOrderByColumn(self::TITLE);
		return self::doSelectJoinAll($c);
	}
  
  public static function retrieveByPKsSorted($ids)
	{
		$c=new Criteria();
		$c->add(self::ID, $ids, Criteria::IN);
		$c->addJoin(self::USER_ID, sfGuardUserPeer::ID);
		$c->addAscendingOrderByColumn(self::PROJ_CATEGORY_ID);
		$c->addAscendingOrderByColumn(self::TITLE);
		return self::doSelectJoinAll($c);
	}

  public static function retrieveAllForYearAndUser($year, $user_id)
	{
		$c=new Criteria();
		$c->add(self::YEAR_ID, $year);
    $c->add(self::USER_ID, $user_id);
		$c->addJoin(self::USER_ID, sfGuardUserPeer::ID);
		$c->addAscendingOrderByColumn(self::PROJ_CATEGORY_ID);
		return self::doSelectJoinAll($c);
	}

  public static function retrieveAllForUser($user_id)
	{
		$c=new Criteria();
    $c->add(self::USER_ID, $user_id);
		$c->addJoin(self::USER_ID, sfGuardUserPeer::ID);
		$c->addDescendingOrderByColumn(self::YEAR_ID);
		$c->addAscendingOrderByColumn(self::TITLE);
		$c->addAscendingOrderByColumn(self::PROJ_CATEGORY_ID);
		return self::doSelectJoinAll($c);
	}

	public static function retrieveByTitleAndYear($title, $yearId)
	{
		$c=new Criteria();
		$c->add(self::TITLE, $title);
		$c->add(self::YEAR_ID, $yearId);
		return self::doSelectOne($c);
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
    return self::_getInfoLetters($ids, 'Charge letters', 'projects_charges.odt', $filetype, array('date'=>'current'), $context);
	}

	public static function getSubmissionLetters($ids, $filetype='odt', $context=null)
	{
    return self::_getInfoLetters($ids, 'Submission letters', 'projects_submission.odt', $filetype, array('date'=>'submission'), $context);
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
			$letters->schoolPrincipal(sfConfig::get('app_school_principal', 'missing Principal name in config file'));
      
      $letters->referenceNumber($project->getReferenceNumberOrDefault()); 
      
      switch($options['date'])
      {
        case 'current':
          $letters->letterDate(date('d/m/Y'));
          break;
        case 'submission':
          $letters->letterDate($project->getLastEventDate(Workflow::PROJ_SUBMITTED, 'd/m/Y'));
          break;
        default:
          $letters->letterDate('_______');
          
      }
      
      $usedtypes=array();
      
      foreach($project->getProjResources() as $Resource)
      {
        $ResourceType=$Resource->getProjResourceType();
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
      
      foreach($project->getProjUpshots() as $Upshot)
      {
        $letters->upshots->upshotDescription($Upshot->getDescription());
        $letters->upshots->upshotIndicator($Upshot->getIndicator());
        $letters->upshots->merge();
      }

      foreach($project->getProjDeadlines() as $Deadline)
      {
        $letters->deadlines->deadlineDate($Deadline->getOriginalDeadlineDate('d/m/y'));
        $letters->deadlines->deadlineDescription($Deadline->getDescription());
        $letters->deadlines->merge();
      }
      
      foreach($usedtypes as $ResourceType)
      {
        $letters->resourcetypes->rtDescription($ResourceType->getDescription());
        $letters->resourcetypes->rtStandardCost(OdfDocPeer::quantityvalue($ResourceType->getStandardCost(), sfConfig::get('app_config_currency_symbol')));
        $letters->resourcetypes->merge();
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
          
          $roles->projects->projectTitle($project->getTitle());
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


} // SchoolprojectPeer