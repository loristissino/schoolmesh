<?php

require 'lib/model/om/BaseSchoolprojectPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'schoolproject' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class SchoolprojectPeer extends BaseSchoolprojectPeer {


  public static function retrieveAllForYear($year)
	{
		$c=new Criteria();
		$c->add(self::YEAR_ID, $year);
    $c->add(self::STATE, Workflow::PROJ_DRAFT, Criteria::GREATER_THAN);
		$c->addJoin(self::USER_ID, sfGuardUserPeer::ID);
		$c->addAscendingOrderByColumn(self::PROJ_CATEGORY_ID);
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


  public static function setApprovalDate($user, $params, $sf_context=null)
  {
    $ids=$user->getAttribute('ids');
    $user_id=$user->getProfile()->getId();
    
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
      ->setApprovalDate($params['date'])
      ->setApprovalNotes($params['notes'])
      ;
      $project->addWfevent(
          $user_id,
          'Approval date set to %date% (%comment%)',
          array('%date%'=>$params['date'], '%comment%'=>$params['notes']),
          null,
          $sf_context
        );

      if ($project->getState()<Workflow::PROJ_APPROVED)
      {
        $project->setState(Workflow::PROJ_APPROVED);
        $project->addWfevent(
          $user_id,
          'State set to «approved»',
          null,
          Workflow::PROJ_APPROVED,
          $sf_context
        );

      }
      $project->save();
    }
    $result['result']='notice';
    $result['message']='Projects information have been updated.';
    return $result;

  }

  public static function setFinancingDate($user, $params, $sf_context=null)
  {
    $ids=$user->getAttribute('ids');
    $user_id=$user->getProfile()->getId();
    
    $projects = SchoolprojectPeer::retrieveByPKs($ids);
    foreach($projects as $project)
    {
      $project
      ->setFinancingDate($params['date'])
      ->setFinancingNotes($params['notes'])
      ;
      $project->addWfevent(
          $user_id,
          'Financing date set to %date% (%comment%)',
          array('%date%'=>$params['date'], '%comment%'=>$params['notes']),
          null,
          $sf_context
        );
      if ($project->getState()<Workflow::PROJ_FINANCED)
      {
        $project->setState(Workflow::PROJ_FINANCED);
        $project->addWfevent(
          $user_id,
          'State set to «financed»',
          null,
          Workflow::PROJ_APPROVED,
          $sf_context
        );
      }
      $project->save();
    }
    $result['result']='notice';
    $result['message']='Projects information have been updated.';
    return $result;

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
            $costscache[$resource->getProjResourceTypeId()]=$resource->getProjResourceType()->getStandardCost();
          }
          if($costscache[$resource->getProjResourceTypeId()]!=$resource->getStandardCost())
          {
            $resource
            ->setStandardCost($costscache[$resource->getProjResourceTypeId()])
            ->save();
            $projdirty=true;
            $resourcesNo++;
            $project->addWfevent(
              $user_id,
              'Updated standard cost of resource «%resource%», set to %amount%',
              array('%resource%'=>$resource->getDescription(), '%amount%'=>$resource->getStandardCost()),
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
  
  public static function computeDataSynthesis($ids)
  {
    $projResourceTypes=ProjResourceTypePeer::doSelect(new Criteria());
    
    $types=array();
 
    $result=array();

    $projects=self::retrieveByPKs($ids);
    
    foreach($projects as $project)
    {
      $result['projects'][$project->getId()]['title']=$project->getTitle();
      $result['projects'][$project->getId()]['resources']=array();
      foreach($project->getProjResources() as $resource)
      {
        @$result['projects'][$project->getId()]['resources'][$resource->getProjResourceTypeId()]+=$resource->getQuantityMultipliedByCost();
        if(!array_key_exists($resource->getProjResourceTypeId(), $types))
        {
          $types[$resource->getProjResourceTypeId()]=1;
        }
      }
    }
    
    $result['types']=ProjResourceTypePeer::retrieveByPKs(array_keys($types));
    
    return $result;
  }
  
  
	public static function getChargeLetters($ids, $filetype='odt', $context=null)
	{
    return self::_getInfoLetters($ids, 'Charge letters', 'projects_charges.odt', $filetype, $context);
	}

	public static function getSubmissionLetters($ids, $filetype='odt', $context=null)
	{
    return self::_getInfoLetters($ids, 'Submission letters', 'projects_submission.odt', $filetype, $context);
	}



	private static function _getInfoLetters($ids, $filename, $templatename, $filetype='odt', $context=null)
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
			$letters->userTitle($user->getTitle());
			$letters->userFullName($user->getFullName());
      $letters->userEmail($user->getValidatedEmail());
			$letters->projectTitle($project->getTitle());
			$letters->schoolPrincipal(sfConfig::get('app_school_principal', 'missing Principal name in config file'));
			
			$letters->letterDate(date('d/m/Y'));
      
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
          $usedtypes[]=$ResourceType->getId();
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
      
      foreach(ProjResourceTypePeer::retrieveByPks($usedtypes) as $ResourceType)
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

} // SchoolprojectPeer
