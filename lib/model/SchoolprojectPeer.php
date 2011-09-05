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

  public static function updateStandardCosts($user, $sf_context=null)
  {
    $ids=$user->getAttribute('ids');
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

} // SchoolprojectPeer
