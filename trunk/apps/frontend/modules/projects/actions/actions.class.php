<?php

/**
 * projects actions.
 *
 * @package    schoolmesh
 * @subpackage projects
 * @author     Loris Tissino <loris.tisino@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class projectsActions extends sfActions
{
  
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

//   $this->projects=SchoolprojectPeer::retrieveAllForYearAndUser(sfConfig::get('app_config_current_year'), $this->getUser()->getProfile()->getSfGuardUser()->getId());
   $this->projects=SchoolprojectPeer::retrieveAllForUser($this->getUser()->getProfile()->getSfGuardUser()->getId(), array('delegated_too'=>true));
   $this->steps=Array();

   $this->setTemplate('index');
   $this->getUser()->setAttribute('back', null);


	}
  
  public function executeActivities(sfWebRequest $request)
  {
    $this->activities=ProjActivityPeer::retrieveAllForYearAndUser(sfConfig::get('app_config_current_year'), $this->getUser()->getProfile()->getSfGuardUser()->getId());
	}
  
  public function executeNewactivity(sfWebRequest $request)
  {
    if($request->hasParameter('id'))
    {
      $this->forward404Unless($this->resource=ProjResourcePeer::retrieveByPK($request->getParameter('id')));
      $this->form=new ProjActivityForm();
      $this->form->setDefault('beginning', time());
      $this->form->setDefault('proj_resource_id', $this->resource->getId());
      $this->project=$this->resource->getSchoolproject();
      $this->form->addConfiguration($this->resource);
      $this->form->unsetUserId();
      $this->action='newactivity';
      $this->setTemplate('newactivityform');

      if ($request->isMethod('post'))
      {
        $this->form->bind($request->getParameter('info'));
        if ($this->form->isValid())
        {
          $params = $this->form->getValues();
          $result=ProjActivityPeer::addActivity($this->getUser()->getProfile()->getId(), $params);
          
          $this->getUser()->setFlash($result['result'],
            $this->getContext()->getI18N()->__($result['message'])
            );
          
          if($result['result']=='notice')
          {
            return $this->redirect('projects/activities');
          }
        }
      }
      
    }
    
    $this->resources=ProjResourcePeer::retrieveAllForYearAndRole(sfConfig::get('app_config_current_year'), $this->getUser()->getProfile()->getRoleId());
	}

  public function executeAddacknowledgedactivity(sfWebRequest $request)
  {
    $this->forward404Unless($this->resource=ProjResourcePeer::retrieveByPK($request->getParameter('id')));
    $this->form=new ProjActivityForm();
    $this->form->setDefault('beginning', time());
    $this->form->setDefault('proj_resource_id', $this->resource->getId());
    $this->project=$this->resource->getSchoolproject();
    $this->forward404Unless($this->project->isEditableBy($this->getUser()));
    $this->form->addConfiguration($this->resource);
    $this->action='addacknowledgedactivity';
    $this->setTemplate('newactivityform');

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('info'));
      if ($this->form->isValid())
      {
        $params = $this->form->getValues();
        $result=ProjActivityPeer::addActivity($params['user_id'], $params, true);
        
        $this->getUser()->setFlash($result['result'],
          $this->getContext()->getI18N()->__($result['message'])
          );
        
        if($result['result']=='notice')
        {
          return $this->redirect('projects/viewresourceactivities?id='.$this->resource->getId());
        }
      }
    }
      
	}

  public function executeCheckbudgetcompatibility(sfWebRequest $request)
  {
    $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPK($request->getParameter('id')));
    $this->forward404Unless($this->project->isEditableBy($this->getUser()));
    
    $this->be=$this->project->getBudgetAndExpensesForDeclarableActivities();
      
	}




  public function executeEditactivity(sfWebRequest $request)
  {
    $this->forward404Unless($this->activity=ProjActivityPeer::retrieveByPK($request->getParameter('id')));
    $this->forward404Unless($this->activity->getUserId()==$this->getUser()->getProfile()->getId());
    $this->forward404Unless(!$this->activity->getAcknowledgedAt());
    
    $this->form=new ProjActivityForm($this->activity);
    $this->form->addConfiguration($this->activity->getProjResource());

    $this->setTemplate('editactivityform');

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('info'));
      if ($this->form->isValid())
      {
        $params = $this->form->getValues();
        $result=$this->activity->saveChanges($params);
        
        $this->getUser()->setFlash($result['result'],
          $this->getContext()->getI18N()->__($result['message'])
          );
        
        if($result['result']=='notice')
        {
          return $this->redirect('projects/activities');
        }
      }
    }
    
    $this->resource=$this->activity->getProjResource();
    $this->project=$this->resource->getSchoolproject();
    
	}

  public function executeDeleteactivity(sfWebRequest $request)
  {
    $this->forward404Unless($this->activity=ProjActivityPeer::retrieveByPK($request->getParameter('id')));
    $this->forward404Unless($this->activity->getUserId()==$this->getUser()->getProfile()->getId());
    $this->forward404Unless(!$this->activity->getAcknowledgedAt());
    $this->forward404Unless($request->isMethod('post') or $request->isMethod('delete'));
    
    $this->activity->delete();
    $result['result']='notice';
    $result['message']='The activity has been deleted.';

    $this->getUser()->setFlash($result['result'],
      $this->getContext()->getI18N()->__($result['message'])
      );

    return $this->redirect('projects/activities');
	}

  public function executeData(sfWebRequest $request)
  {
    $this->getRequest()->setParameter('id', $request->getParameter('id'));
    $this->getRequest()->setParameter('batch_action', 'computebudget');
    $this->forward('projects', 'batch'); //, array('id'=>$request->getParameter('id'), 'batch_action'=>'computebudget'));
  }

  public function executeBatch(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');
    $this->getUser()->setAttribute('ids', $ids);
    
    $action=$request->getParameter('batch_action');

    if ($action==='0')
      {
        $this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must specify an action.'));
        $this->redirect('projects/monitor');
      }
      
    $this->forward('projects', $action);
    // if an action is not valid, we get an error anyway, because there is no
    // template BatchSuccess.php
  }  

  protected function _getIds(sfWebRequest $request)
  {
    $this->ids=null;
    if($request->hasParameter('id'))
    {
      $this->ids=array($request->getParameter('id'));
    }
    elseif ($request->hasParameter('ids'))
    {
      if(!is_array($request->getParameter('ids')))
      {
        $this->ids = explode(',', $request->getParameter('ids'));
      }
      else
      {
        $this->ids = $request->getParameter('ids');
      }
    }
    if (!$this->ids)
		{
				$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select at least one project.'));
				$this->redirect('projects/monitor');
		}
    
    return $this->ids; // we could avoid returning it, since it's avaailable anyway
    
  }


  public function executeSetapprovaldate(sfWebRequest $request)
  {
    return $this->_executeSetgenericdate($request, 
      array(
        'date'=>'Approval date', 
        'notes'=>'Approval notes',
        'action'=>'setapprovaldate',
        'methodkey'=>'Approval',
        )
      );
  }

  public function executeSetfinancingdate(sfWebRequest $request)
  {
    return $this->_executeSetgenericdate($request, 
      array(
        'date'=>'Financing date', 
        'notes'=>'Financing notes',
        'action'=>'setfinancingdate',
        'methodkey'=>'Financing',
        )
      );

  }

  public function executeSetconfirmationdate(sfWebRequest $request)
  {
    return $this->_executeSetgenericdate($request, 
      array(
        'date'=>'Confirmation date', 
        'notes'=>'Confirmation notes',
        'action'=>'setconfirmationdate',
        'methodkey'=>'Confirmation',
        )
      );

  }
  
  private function _executeSetgenericdate(sfWebRequest $request, $options=array())
  {
  
    $this->form = new ProjectDateForm();
    
    $this->form->setLabels(array(
      'date'=>$this->getContext()->getI18N()->__($options['date']),
      'notes'=>$this->getContext()->getI18N()->__($options['notes'])
      ));
    
    $this->action=$options['action'];
    $this->setTemplate('projdate');
    
    $setmethod='set'.$options['methodkey'].'Date';
    $getmethod='get'.$options['methodkey'].'Date';
    
		if ($request->isMethod('post'))
    {
			$this->form->bind($request->getParameter('projectinfo'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$result=SchoolprojectPeer::$setmethod($this->getUser(), $params, $this->getContext());
        
				$this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
        
        return $this->redirect('projects/monitor');
			}
		}

    if($this->getUser()->hasAttribute('ids'))
    {
      $this->ids=$this->getUser()->getAttribute('ids');
    }
    else
    {
      $this->ids=$this->_getIds($request);
    }
    $this->projects=SchoolprojectPeer::retrieveByPks($this->ids);
    $date=$this->projects[0]->$getmethod('U');
    if(!$date) $date=time();
    $this->form->setDefault('date', $date);
    $this->form->setDefault('notes', $this->projects[0]->$getmethod());

  }


  public function executeReassign(sfWebRequest $request)
  {
		if ($request->isMethod('post'))
    {
      $this->form = new ChooseUserForm();

      Generic::logMessage('passed here', null);
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
        Generic::logMessage('params', $params);
				$result=SchoolprojectPeer::reassign($this->getUser(), $params, $this->getContext());
        
				$this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
        return $this->redirect('projects/monitor');
			}
      else
      {
        return $this->renderText('invalid data');
      }
		}

    $this->form = new ChooseUserForm(array(), array('peer_method'=>'retrieveUsersAllowedToProject'));

    if($this->getUser()->hasAttribute('ids'))
    {
      $this->ids=$this->getUser()->getAttribute('ids');
    }
    else
    {
      $this->ids=$this->_getIds($request);
    }
    $this->projects=SchoolprojectPeer::retrieveByPks($this->ids);

  }

  
  public function executeComputebudget(sfWebRequest $request)
  {
    $this->ids=$this->getUser()->hasAttribute('ids')? $this->getUser()->getAttribute('ids') : $this->_getIds($request);
    $this->projects=SchoolprojectPeer::retrieveByPksSorted($this->ids);
    $this->getUser()->setAttribute('back', 'budget');
  }

  public function executeComputesynthesiscomplete(sfWebRequest $request)
  {
    $this->_executeComputesynthesis($request, false);
  }
  
  public function executeComputesynthesisstaffonly(sfWebRequest $request)
  {
    $this->_executeComputesynthesis($request, true);
  }
  
  protected function _executeComputesynthesis(sfWebRequest $request, $staffonly=false)
  {
    $this->ids=$this->getUser()->hasAttribute('ids')? $this->getUser()->getAttribute('ids') : $this->_getIds($request);
    $this->result=SchoolprojectPeer::computeDataSynthesis($this->ids, $staffonly);
    $this->projects=$this->result['projects'];
    $this->types=$this->result['types'];
    $this->setTemplate('computesynthesis');
  }
  
  public function executeGetchargeletters(sfWebRequest $request)
  {
  	set_time_limit(0);
    $this->ids=$this->getUser()->hasAttribute('ids')? $this->getUser()->getAttribute('ids') : $this->_getIds($request);

		$result=SchoolprojectPeer::getChargeLetters($this->ids, $this->getUser()->getProfile()->getPreferredFormat(), $this->getContext());
		
		if ($result['result']=='error')
		{
			$this->getUser()->setFlash('error', $result['message']);
			$this->redirect('projects/monitor');
		}
		
		$odfdoc=$result['content'];
		if (is_object($odfdoc))
		{
			$odfdoc
			->saveFile()
			->setResponse($this->getContext()->getResponse());
			return sfView::NONE;

		}
		else
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.'));
			$this->redirect('projects/monitor');
		}
  }
  
  public function executeGetstaffsynthesis(sfWebRequest $request)
  {
  	set_time_limit(0);
    $this->ids=$this->getUser()->hasAttribute('ids')? $this->getUser()->getAttribute('ids') : $this->_getIds($request);

		$result=SchoolprojectPeer::getStaffSynthesisDoc($this->ids, $this->getUser()->getProfile()->getPreferredFormat(), $this->getContext());
		
		if ($result['result']=='error')
		{
			$this->getUser()->setFlash('error', $result['message']);
			$this->redirect('projects/monitor');
		}
		
		$odfdoc=$result['content'];
		if (is_object($odfdoc))
		{
			$odfdoc
			->saveFile()
			->setResponse($this->getContext()->getResponse());
			return sfView::NONE;
		}
		else
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.'));
			$this->redirect('projects/monitor');
		}
  }

  public function executeSpreadsheet(sfWebRequest $request)
  {
    $this->ids=$this->getUser()->hasAttribute('ids')? $this->getUser()->getAttribute('ids') : $this->_getIds($request);
    $this->projects=SchoolprojectPeer::retrieveByPksSorted($this->ids);
    $response = $this->getContext()->getResponse();
		$response->setHttpHeader('Content-Type', 'text/csv');
		$response->setHttpHeader('Content-Disposition', 'attachment; filename="'. $this->getContext()->getI18N()->__('Projects') . '_'. date('Ymd') . '.csv"');
    $this->setLayout(false);

  }
  
  public function executeUpdatestandardcosts(sfWebRequest $request)
  {
    $this->ids=$this->getUser()->hasAttribute('ids')? $this->getUser()->getAttribute('ids') : $this->_getIds($request);
		$result=SchoolprojectPeer::updateStandardCosts($this->getUser(), $this->ids, $this->getContext());
        
    $this->getUser()->setFlash($result['result'],
      $this->getContext()->getI18N()->__($result['message'])
      );
      
    return $this->redirect('projects/monitor');
  }
  
  public function executeResettodraft(sfWebRequest $request)
  {
    $this->ids=$this->getUser()->hasAttribute('ids')? $this->getUser()->getAttribute('ids') : $this->_getIds($request);
    
    $projects=SchoolprojectPeer::retrieveByPKs($this->ids);
    
    $possible=true;
    
    foreach($projects as $project)
    {
      $possible = $possible && ($project->getState()<Workflow::PROJ_CONFIRMED);
    }
    
    if ($possible)
    {
      $result=SchoolprojectPeer::resetToDraft($this->getUser(), $projects, $this->getContext());
    }
    else
    {
      $result['result']='error';
      $result['message']='You cannot reset to draft projects already confirmed.';
    }
        
    $this->getUser()->setFlash($result['result'],
      $this->getContext()->getI18N()->__($result['message'])
      );
      
    return $this->redirect('projects/monitor');
  }
  

  public function executeViewasreport(sfWebRequest $request)
  {
    $this->ids=$this->getUser()->hasAttribute('ids')? $this->getUser()->getAttribute('ids') : $this->_getIds($request);
    $this->projects=SchoolprojectPeer::retrieveByPksSorted($this->ids);
    $this->setTemplate('report');
    $this->breadcrumpstype='projects/monitoring/viewasreport';
  }
  
  public function executeSubmissions(sfWebRequest $request)
  {
    $this->forward404Unless($this->type=sfConfig::get('app_config_projects_view_report_type', false));
    $this->ids=SchoolprojectPeer::retrieveIdsForYear(sfConfig::get('app_config_current_year'), false);
    $this->projects=SchoolprojectPeer::retrieveByPksSorted($this->ids);
    $this->setTemplate('report');
    $this->breadcrumpstype='projects/submissions';
  }
  
  public function executeView(sfWebRequest $request)
  {
   $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPK($request->getParameter('id')));
   $this->projects=Array($this->project);
   $this->setTemplate('report');
   $this->type=$this->project->getState() < Workflow::PROJ_FINISHED ? 'submission': 'report';
   $this->breadcrumpstype='projects/project/view';
  }
  
  public function executeMonitorview(sfWebRequest $request)
  {
   $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPK($request->getParameter('id')));
   $this->projects=Array($this->project);
   $this->setTemplate('report');
   $this->breadcrumpstype='projects/monitoring/project/view';
  }
  
  public function executeEmail(sfWebRequest $request)
  {
    $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPK($request->getParameter('id')));
    $this->message=$this->project->getProjectAlertMessage($this->getUser()->getProfile(), $this->getContext());
    $this->form = new EmailForm();
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('email'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$this->project = SchoolprojectPeer::retrieveByPK($request->getParameter('id'));
				$result=$this->project->sendEmail($params, $this->getUser()->getProfile(), $this->getContext());
				$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
        return $this->redirect('projects/monitor');
      }
		}
    $this->form
    ->setDefault('email_subject', $this->message->getSubject())
    ->setDefault('body', $this->message->getBody())
    ;
    $this->breadcrumpstype='projects/monitoring/emailtocoordinator';

  }

  public function executeActivityemail(sfWebRequest $request)
  {
    $this->forward404Unless($this->activity=ProjActivityPeer::retrieveByPK($request->getParameter('id')));
    $this->message=$this->activity->getProjectActivityMessage($this->getUser()->getProfile(), $this->getContext());
    $this->form = new EmailForm();
    if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('email'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				$result=$this->activity->sendEmail($params, $this->getUser()->getProfile(), $this->getContext());
				$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
        return $this->redirect('projects/viewresourceactivity?id=' . $this->activity->getId());
      }
		}
    $this->form
    ->setDefault('email_subject', $this->message->getSubject())
    ->setDefault('body', $this->message->getBody())
    ;
    
    $this->resource=$this->activity->getProjResource();
    $this->project=$this->resource->getSchoolproject();
    $this->breadcrumpstype='projects/project/resource/emailtoactivityperformer';
    $this->setTemplate('email');
  }

  
  public function executeMonitor(sfWebRequest $request)
  {
   $this->year=$this->getUser()->getAttribute('year', sfConfig::get('app_config_current_year'));
   $this->years = YearPeer::retrieveAll();

   $this->projects=SchoolprojectPeer::retrieveAllForYear($this->year);
   $this->steps=Array();

   $template=$request->getParameter('template', 'monitor');
   $this->setTemplate($template);

	}
	
  public function executeLetters(sfWebRequest $request)
	{
    /* this is deprecated */
		$this->text='';
		$this->projects=SchoolprojectPeer::retrieveAllForYear(sfConfig::get('app_config_current_year'));
		
		$number=0;
		foreach($this->projects as $project)
		{
			$filename = sprintf('/tmp/projects/%s_%d.odt',
				$project->getsfGuardUser()->getUsername(),
				$project->getId()
				);
			$odf=$project->getOdf('odt', $this->getContext(), 'project_resume.odt', false);
			$odf->saveFile();
			@copy($odf->getFileName(), $filename);
			$number++;
			$this->text.=$odf->getFileName() . ' >> ' . $filename . "\n";
			unset($odf);
			
			
		}
		$this->number=$number;
		
	}
  
  
  public function executeAdddeadline(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPk($request->getParameter('id')));
    
    $result=$this->project->addDeadline($this->getUser()->getProfile());
    
    $this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
					
    if(array_key_exists('redirect', $result))
    {
      return $this->redirect($result['redirect']);
    }
    return $this->redirect('projects/edit?id='. $this->project->getId());
   } 
   
  public function executeAddresource(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPk($request->getParameter('id')));
    
    $result=$this->project->addresource($this->getUser()->getProfile());
    
    $this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
		
    if(array_key_exists('redirect', $result))
    {
      return $this->redirect($result['redirect']);
    }
    return $this->redirect('projects/edit?id='. $this->project->getId());
   } 

  public function executeAddupshot(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPk($request->getParameter('id')));
    
    $result=$this->project->addupshot($this->getUser()->getProfile());
    
    $this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
		
    if(array_key_exists('redirect', $result))
    {
      return $this->redirect($result['redirect']);
    }
    return $this->redirect('projects/edit?id='. $this->project->getId());
   } 



  public function executeDeletedeadline(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $this->forward404Unless($this->deadline=ProjDeadlinePeer::retrieveByPk($request->getParameter('id')));
    
    $id=$this->deadline->getSchoolprojectId();
    
    $result=$this->deadline->getSchoolproject()->deleteDeadline($this->getUser()->getProfile(), $this->deadline);
    
    $this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
					
    return $this->redirect('projects/edit?id='. $id);
    
  }

  public function executeDeleteresource(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $this->forward404Unless($this->resource=ProjResourcePeer::retrieveByPk($request->getParameter('id')));

    $id=$this->resource->getSchoolprojectId();

    $result=$this->resource->getSchoolproject()->deleteResource($this->getUser()->getProfile(), $this->resource);
    
    $this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
					
    return $this->redirect('projects/edit?id='. $id);

    
  }

  public function executeDeleteupshot(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $this->forward404Unless($this->upshot=ProjUpshotPeer::retrieveByPk($request->getParameter('id')));
    
    $id=$this->upshot->getSchoolprojectId();
    
    $result=$this->upshot->getSchoolproject()->deleteUpshot($this->getUser()->getProfile(), $this->upshot);
    
    $this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
					
    return $this->redirect('projects/edit?id='. $id);
  }


  public function executeEditdeadline(sfWebRequest $request)
  {
    $this->forward404Unless($this->deadline=ProjDeadlinePeer::retrieveByPk($request->getParameter('id')));
    $this->forward404Unless($this->deadline->isEditableBy($this->getUser())); // the deadline can be edited only by the owner or admins...
    
    $this->attachments=$this->deadline->getAttachmentFiles();
    
    $this->form = new ProjDeadlineForm($this->deadline);
    $this->form->addStateDependentConfiguration(
      $this->deadline->getSchoolProject()->getState(),
      array(
        'needs_attachment'=>$this->deadline->getNeedsAttachment()===true
        )
      );

	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('proj_deadline'), $request->getFiles('proj_deadline'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->deadline = ProjDeadlinePeer::retrieveByPK($params['id']);

				$result=$this->deadline->updateFromForm($params + array('user_id'=>$this->getUser()->getProfile()->getUserId()), $this->form->getValue('attachment'), $this->getContext());
				
				$this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
				
        if($result['result']=='notice')
        {
          return $this->redirect('projects/edit?id='. $this->deadline->getSchoolproject()->getId() . '#deadlines');
        }
        else
        {
          return $this->redirect('projects/editdeadline?id='. $this->deadline->getId());
        }
			}
			
		}

  }
 

  public function executeEditresource(sfWebRequest $request)
  {
    $this->forward404Unless($this->resource=ProjResourcePeer::retrieveByPk($request->getParameter('id')));
    $this->forward404Unless($this->resource->isEditableBy($this->getUser()));
    
    $this->form = new ProjResourceForm($this->resource,  array('culture' => $this->getUser()->getCulture()));
    
    if(!$this->resource->getScheduledDeadline())
    {
      $this->form->setDefault('scheduled_deadline', time());
    }
    
    if($this->resource->getProjResourceType() and $this->resource->getProjResourceType()->getMeasurementUnit()=='h')
    {
      /* For some inexplicable reason, in this form the default does not work if called in the configure() function */
      
      $this->form->setDefault('quantity_estimated', Generic::getHoursAsString($this->resource->getQuantityEstimated(), sfConfig::get('app_config_hoursminutessep', ':')));
      $this->form->setDefault('quantity_approved', Generic::getHoursAsString($this->resource->getQuantityApproved(), sfConfig::get('app_config_hoursminutessep', ':')));
    }
    /*
     * if(!$this->resource->getScheduledDeadline())
    {
      $this->form->setDefault('scheduled_deadline', time());
    }
    */

    //$this->form->setDefault('charged_user_id', $this->resource->getChargedUserId());
    //$this->form->setDefault('quantity_estimated', 'bla');

    if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('proj_resource'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->resource = ProjResourcePeer::retrieveByPK($params['id']);
				
				$result=$this->resource->updateFromForm($params, $this->getUser(), $this->getContext());
				
				$this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
          
        if($this->getUser()->getAttribute('back', '')=='budget')
        {
          return $this->redirect('projects/computebudget');
        }
				
        return $this->redirect('projects/editresource?id='. $this->resource->getId());
			}
			
		}




  }

  public function executeEditupshot(sfWebRequest $request)
  {
    $this->forward404Unless($this->upshot=ProjUpshotPeer::retrieveByPk($request->getParameter('id')));
    $this->forward404Unless($this->upshot->isEditableBy($this->getUser())); // the resource can be edited only by the owner or admins...
    
    $this->form = new ProjUpshotForm($this->upshot, array('sf_context'=>$this->getContext()));
    
    if(!$this->upshot->getScheduledDate())
    {
      $this->form->setDefault('scheduled_date', time());
    }
    
    if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('proj_upshot'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->upshot = ProjUpshotPeer::retrieveByPK($params['id']);
				
				$result=$this->upshot->updateFromForm($params, $this->getUser(), $this->getContext());
				
				$this->getUser()->setFlash($result['result'],
					$this->getContext()->getI18N()->__($result['message'])
					);
        
        if($result['result']=='notice')
        {
          return $this->redirect('projects/edit?id='. $this->upshot->getSchoolprojectId() . '#upshots');
        }
        return $this->redirect('projects/editupshot?id='. $this->upshot->getId());
			}
			
		}
  }

  public function executeViewresourceactivities(sfWebRequest $request)
  {
    $this->forward404Unless($this->resource=ProjResourcePeer::retrieveByPk($request->getParameter('id')));
    $this->forward404Unless($this->resource->isEditableBy($this->getUser())); // the resource can be edited only by the owner or admins...
    
    $this->activities=$this->resource->getProjActivities();
    $this->project=$this->resource->getSchoolproject();

  }


  public function executeAcknowledgeactivity(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    $this->forward404Unless($this->activity=ProjActivityPeer::retrieveByPk($request->getParameter('id')));
    $this->resource=$this->activity->getProjResource();
    $this->project=$this->resource->getSchoolproject();
    $this->forward404Unless($this->project->isEditableBy($this->getUser())); // the project can be edited only by the owner  or by admins...

    $result=$this->resource->acknowledgeActivity($this->getUser()->getProfile()->getId(), $this->activity);
    
    $this->getUser()->setFlash($result['result'],
      $this->getContext()->getI18N()->__($result['message'])
      );
    return $this->redirect('projects/viewresourceactivities?id=' . $this->resource->getId());
   }  


  public function executeEdit(sfWebRequest $request)
  {
    
	$this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPk($request->getParameter('id')));
  
  $this->forward404Unless($this->project->isEditableBy($this->getUser())); // the project can be edited only by the owner  or by admins...
	
	$this->form = new SchoolprojectForm($this->project);
  $this->form->addUserDependentConfiguration($this->getUser());
  //$this->form->addDetailsDefaults();
  
  if($request->getParameter('back','')=='monitor')
  {
    $this->breadcrumpstype='projects/monitoring';
  }
  else
  {
    $this->breadcrumpstype='projects/index';
  }

	if ($request->isMethod('post'))
		{
//			$this->form->getValidatorSchema()->setOption('allow_extra_fields', true);
//			$this->form->getValidatorSchema()->setOption('filter_extra_fields', false);
			
			
			$this->form->bind($request->getParameter('schoolproject'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->project = SchoolprojectPeer::retrieveByPK($params['id']);
				
				$this->project
        ->updateFromForm($params, $this->getUser(), $this->getContext())
        ->save();
				
				$this->getUser()->setFlash('notice',
					$this->getContext()->getI18N()->__('Project information updated.')
					);
					
			return $this->redirect('projects/edit?id='. $this->project->getId());
			}
			
		}
    /* this would be useful if we wanted to embed deadline forms,
    but there are some problems with validation, so we don't use it 	
    if($this->project)
    {
      foreach($this->project->getProjDeadlines() as $index=>$deadline)
      {
        $deadlineForm=new ProjDeadlineForm($deadline);
        $fieldname='deadline[' . $index . ']';
        $this->form->embedForm($fieldname, $deadlineForm);
        $this->form->getWidgetSchema()->setLabel($fieldname, 
          $this->getContext()->getI18N()->__('Deadline #%number%', array('%number%'=>$index+1))
          );

      }

    }
    */
  
    if ($this->project)
    {
      $this->deadlines=$this->project->getProjDeadlines();
      $this->resources=$this->project->getProjResources();
      $this->upshots  =$this->project->getProjUpshots();
    }
  
  
  }  
	

  public function executeSubmit(sfWebRequest $request)
  {
    
    $this->forward404Unless($this->project=SchoolprojectPeer::retrieveByPk($request->getParameter('id')));
  
    $this->forward404Unless($this->project->isEditableBy($this->getUser())); // the project can be edited only by the owner  or by admins...

    $this->forward404Unless($request->isMethod('post'));

    $result=$this->project->submit($this->getUser()->getProfile()->getId(), $this->getContext());
    
    $message=$this->getContext()->getI18N()->__($result['message']);
    if(array_key_exists('mail_sent_to', $result))
    {
      $message .= ' ' . $this->getContext()->getI18N()->__('A confirmation message has been sent to your address %email%.', array('%email%'=>$result['mail_sent_to']));
    }
    $this->getUser()->setFlash($result['result'], $message);

    if($result['result']=='notice')
    {
      return $this->redirect('projects/index');
    }
    
    if (array_key_exists('checkList', $result))
    {
      $this->checkList = $result['checkList'];
    }


   }  


  public function executeNew(sfWebRequest $request)
  {
  
  $this->project = new Schoolproject();
  $this->project
  ->setUserId($this->getUser()->getProfile()->getUserId())
  ->setState(Workflow::PROJ_DRAFT);

	$this->form = new SchoolprojectForm($this->project);
  $this->form->addUserDependentConfiguration($this->getUser());

  $this->deadlines=array();

	if ($request->isMethod('post'))
		{
			
			$this->form->bind($request->getParameter('schoolproject'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$this->project
        ->updateFromForm($params)
        ->setYearId(sfConfig::get('app_config_current_year'))
        ->setUserId($this->getUser()->getProfile()->getUserId())
        ->setState(Workflow::PROJ_DRAFT)
        ->setEvaluationMin(sfConfig::get('app_config_projects_evaluation_min', 1))
        ->setEvaluationMax(sfConfig::get('app_config_projects_evaluation_max', 4))
        ->save();
        $this->project->addWfEvent(
          $this->getUser()->getProfile()->getUserId(),
          'Project created',
          null,
          Workflow::PROJ_DRAFT,
          $this->getContext()
          );
        
				$this->getUser()->setFlash('notice',
					$this->getContext()->getI18N()->__('Project information saved.')
					);
					
			return $this->redirect('projects/edit?id='. $this->project->getId());
			}
			
		}
  
  
   }
   
   
  public function executeClone(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('POST'));
    set_time_limit(0);
    $this->forward404Unless($schoolproject=SchoolprojectPeer::retrieveByPK($request->getParameter('id')));
    $this->forward404Unless($schoolproject->isViewableBy($this->getUser()));
    
    $result=$schoolproject->makeClone($this->getUser()->getProfile()->getUserId(), $this->getContext());
    
    $this->getUser()->setFlash($result['result'],
      $this->getContext()->getI18N()->__($result['message'])
    );
    
    $this->redirect('projects/index');
    
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('POST'));
    set_time_limit(0);
    $this->forward404Unless($schoolproject=SchoolprojectPeer::retrieveByPK($request->getParameter('id')));
    $this->forward404Unless($schoolproject->isDeletableBy($this->getUser()));
    
    $result=$schoolproject->remove();
    
    $this->getUser()->setFlash($result['result'],
      $this->getContext()->getI18N()->__($result['message'])
    );
    
    $this->redirect('projects/index');
    
  }
	
  public function executeExport(sfWebRequest $request)
  {
    set_time_limit(0);
    $this->forward404Unless($schoolproject=SchoolprojectPeer::retrieveByPK($request->getParameter('id')));
    
    $this->ids=array($schoolproject->getId());

    switch($schoolproject->getState())
    {
      case Workflow::PROJ_FINISHED:
        $result=SchoolprojectPeer::getFinalReportLetters($this->ids, $this->getUser()->getProfile()->getPreferredFormat(), $this->getContext());
        break;
      default:
        $result=SchoolprojectPeer::getSubmissionLetters($this->ids, $this->getUser()->getProfile()->getPreferredFormat(), $this->getContext());
    }
		
		if ($result['result']=='error')
		{
			$this->getUser()->setFlash('error', $result['message']);
			$this->redirect('projects/monitor');
		}
		
		$odfdoc=$result['content'];
		if (is_object($odfdoc))
		{
			$odfdoc
			->saveFile()
			->setResponse($this->getContext()->getResponse());
			return sfView::NONE;

		}
		else
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.'));
			$this->redirect('projects/monitor');
		}
    
  }

}
