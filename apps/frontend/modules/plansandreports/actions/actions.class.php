<?php

/**
 * teaching actions.
 *
 * @package    schoolmesh
 * @subpackage teaching
 * @author     Loris Tissino
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class plansandreportsActions extends sfActions
{
	
  public function executeReject(sfWebRequest $request)
  {
//    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
	$this->page=$request->getParameter('page', 1);
	
	$steps=Workflow::getWpFrSteps();
	$message=SystemMessagePeer::retrieveByKey($steps[$this->workplan->getState()]['actions']['reject']['logMessageCode']);
	
	$this->form = new EditWpRejectForm();
	
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$result=$this->workplan->Reject($this->getUser()->getProfile()->getSfGuardUser()->getId(), $this->getUser()->getAllPermissions(), $params['comment'], $this->getUser()->getCulture(), $this->getContext());
				
				$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
				
				if ($result['result']=='notice')
				{
					$this->redirect('plansandreports/list?page='. $this->page);
				}
				else
				{
					$this->redirect('plansandreports/reject?id='. $this->workplan->getId() . '&page=' . $this->page);
				}

			}
		}

	$this->form->setDefaults(
		array(
			'comment' => $message->getContent()
			)
	);

/*
	$result = $workplan->Reject($this->getUser()->getProfile()->getSfGuardUser()->getId(), $this->getUser()->getAllPermissions());

	$this->getUser()->setFlash($result['result'], $result['message']);

	$this->redirect('plansandreports/list?page=' . $page);
*/



  }

public function executeBatch(sfWebRequest $request)
{
	$action=$request->getParameter('batch_action');

	if ($action=='')
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must specify an action.'));
			$this->redirect('plansandreports/list');
		}



    $ids = $request->getParameter('ids');
    $workplans = AppointmentPeer::retrieveByPks($ids);
	
	if (sizeof($workplans)==0)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('You must select at least a document.'));
			$this->redirect('plansandreports/list');
		}
		
	$number=0;
/*		
	if ($action=='Publish')
	{
		foreach ($workplans as $workplan)
		{
			$filename = sprintf('/tmp/%s_%s_%s.odt',
					$workplan->getOwner()->getUsername(),
					$workplan->getSchoolclassId(),
					$workplan->getSubject()->getDescription()
					);
			$odf=$workplan->getOdf('odt', $this->getContext(), 'workplan.odt', false);
			$odf->saveFile();
			copy($odf->getFileName(), $filename);
			$number++;
			unset($odf);
		}
		$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('The requested documents (%number%) have been published.', array('%number%'=>$number)));
		return $this->redirect('plansandreports/list');

	}
	*/
    foreach ($workplans as $workplan)
    {
		$result = $workplan->$action($this->getUser()->getProfile()->getSfGuardUser()->getId(), $this->getUser()->getAllPermissions(), $this->getUser()->getCulture(), $this->getContext());
		if ($result['result']=='notice')
			{
				$number++;
			}
	}
	
	if ($number==sizeof($workplans))
		{
			$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('The requested action has been performed.'));
		}
	else
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('The requested action could not be performed.'));
		}
    $this->redirect('plansandreports/list');
}

  

  public function executeApprove(sfWebRequest $request)
  {
    $workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
    $page=$request->getParameter('page', 1);
	
    //$this->content='approving workplan ' . $workplan->getId();
	
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));
    $workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));

    $result = $workplan->Approve($this->getUser()->getProfile()->getSfGuardUser()->getId(), $this->getUser()->getAllPermissions(), $this->getUser()->getCulture(), $this->getContext());

    $this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));

    $this->redirect('plansandreports/list?page='.$page);

  }


	public function executeSetsortlistpreference(sfWebRequest $request)
	{
		$sortby = $request->getParameter('sortby');
		$this->forward404Unless(in_array($sortby, array('', 'class', 'type', 'teacher', 'subject', 'state', 'hours')));
		$this->getUser()->setAttribute('sortby', $sortby);
		$this->redirect('plansandreports/list');
	}
	
	public function executeSetfilterlistpreference(sfWebRequest $request)
	{
		$filter = $request->getParameter('filter');
		$this->forward404Unless(in_array($filter, array('', 'class', 'teacher', 'subject', 'state')));
		$this->getUser()->setAttribute('filter', $filter);
		if ($request->hasParameter('id'))
		{
			$id = $request->getParameter('id');
			$this->getUser()->setAttribute('filter_id', $id);
			$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Filter set.'));
		}
		else
		{
			$this->getUser()->setAttribute('filter_id', -1);
			$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Filter unset.'));
		}
		
		$this->redirect('plansandreports/list');
	}



	public function executeList(sfWebRequest $request)
	{
		$max_per_page=sfConfig::get('app_config_appointments_max_per_page', 20);
		$this->page=$request->getParameter('page', 1);

		$sortby=$this->getUser()->getAttribute('sortby', 'class');
		$filter=$this->getUser()->getAttribute('filter', '');
		$filter_id=$this->getUser()->getAttribute('filter_id', -1);
    
    $this->year=$this->getUser()->getAttribute('year', sfConfig::get('app_config_current_year'));
		
		$this->pager = AppointmentPeer::listWorkplans($max_per_page, $this->page, $this->year, $sortby, $filter, $filter_id);
		$this->steps = Workflow::getWpfrSteps();
		$this->schoolclasses = SchoolclassPeer::retrieveCurrentSchoolclasses($this->year);
		$this->subjects = SubjectPeer::retrieveAllByRank();
		$this->states = Workflow::getWpfrStates(true);
		$this->teachers = sfGuardUserProfilePeer::retrieveTeachers(null, $this->year);
    $this->years = YearPeer::retrieveAll();
	}
	
  public function executeIndex(sfWebRequest $request)
  {
//    $this->workplans = AppointmentPeer::doSelect(new Criteria());
    $this->workplans = $this->getUser()->getProfile()->getWorkplans();
	$this->user = $this->getUser();
	$this->steps = Workflow::getWpfrSteps();

  }

	public function executeImport(sfWebRequest $request)
	{
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
	  $this->user=$this->getUser();
    $this->forward404Unless($this->workplan);
    $this->forward404Unless($this->workplan->isOwnedBy($this->user->getProfile()->getSfGuardUser()->getId()));
    $this->forward404Unless($this->workplan->getState()==Workflow::WP_DRAFT);
    $this->forward404Unless($this->workplan->countWpmodules()==0);

	  $this->steps = Workflow::getWpfrSteps();
	
	  $this->c_workplans = $this->workplan->retrieveImportableWorkplansOfColleagues();
	  $this->s_workplans = $this->workplan->retrieveOtherWorkplansOfSameTeacher();

	}

	public function executeImportmodule(sfWebRequest $request)
	{
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
	  $this->user=$this->getUser();
    $this->forward404Unless($this->workplan);
    $this->forward404Unless($this->workplan->isOwnedBy($this->user->getProfile()->getSfGuardUser()->getId()));

	  $this->steps = Workflow::getWpfrSteps();
  
    $this->allsubjects=$request->getParameter('allsubjects')=='true';
	
  	$this->c_modules = $this->workplan->retrieveImportableModulesOfColleagues(
      $this->workplan->getSchoolclass()->getGrade(),
      $this->allsubjects?null:$this->workplan->getSubjectId()
      );
	  $this->s_modules = $this->workplan->retrieveOtherModulesOfSameTeacher();
  

	}

	public function executeImportfromdb(sfWebRequest $request)
	{
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
	  $this->user=$this->getUser();
    $this->forward404Unless($this->workplan);
    $this->forward404Unless($this->workplan->getState()==Workflow::WP_DRAFT);
    $this->forward404Unless($this->workplan->isOwnedBy($this->user->getProfile()->getSfGuardUser()->getId()));

    $this->iworkplan = AppointmentPeer::retrieveByPk($request->getParameter('from'));
    $this->forward404Unless($this->iworkplan);
    $this->forward404Unless(($this->iworkplan->isViewableBy($this->user->getProfile()->getSfGuardUser()->getId())));
	
    $result=$this->workplan->importFromDB($this->getContext(), $this->iworkplan);

  	$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
	
  	$this->redirect('plansandreports/fill?id='.$this->workplan->getId());

	}


  public function executePublish(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));	
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
    
    $this->forward404Unless($this->workplan->isOwnedBy($this->getUser()->getProfile()->getUserId()));
    
    $result=$this->workplan->teacherPublishUnpublish($request->getParameter('makepublic')=='true', $this->getContext());
    $this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
    
    return $this->redirect('plansandreports/fill?id='. $this->workplan->getId());
  }

	public function executeSubmit(sfWebRequest $request)
	{
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));	
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
	
    $this->forward404Unless($this->workplan->isOwnedBy($this->getUser()->getProfile()->getUserId()));
    
    $result=$this->workplan->teacherSubmit($this->getContext());
    $this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
    if ($result['mail_sent_to'])
    {
      $this->getUser()->setFlash('mail_sent_to', $result['mail_sent_to']);
    }
	
    if (array_key_exists('checkList', $result))
    {
      $this->checkList = $result['checkList'];
    }
      
    $this->steps=Workflow::getWpfrSteps();
    
    $this->workflow_logs = $this->workplan->getWorkflowLogs();

	}

	public function executeRemovetool(sfWebRequest $request)
	{
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));
		
    $workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
	
    $result=$workplan->removeTool($this->getUser()->getProfile()->getSfGuardUser()->getId(), $request->getParameter('tool'));
    
    $this->getUser()->setFlash($result['result'], $result['message']);
    
    $tools=$workplan->getTools();

    return $this->renderPartial('aux', array('tools'=>$tools, 'workplan'=>$workplan));

	}

	public function executeAddtool(sfWebRequest $request)
	{
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));
		
    $workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
	
    $result=$workplan->addTool($this->getUser()->getProfile()->getSfGuardUser()->getId(), $request->getParameter('tool'));
    
    $this->getUser()->setFlash($result['result'], $result['message']);
    
    $tools=$workplan->getTools();

    return $this->renderPartial('aux', array('tools'=>$tools, 'workplan'=>$workplan));

	}



  public function executeEditInLine(sfWebRequest $request)
{
		$newtext=$request->getParameter('value');
		return $this->renderText($newtext."!");
}  


  public function executeFill(sfWebRequest $request)
  {
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
	  $this->user=$this->getUser();
    $this->forward404Unless($this->workplan);
    $this->forward404Unless(
		   $this->workplan->isOwnedBy($this->user->getProfile()->getSfGuardUser()->getId())
       ||
       $this->user->hasCredential('backadmin')
       );

	if ($request->getParameter('ref')=='wpmodule')
	{
		$this->getUser()->setFlash('notice_modules', $this->getContext()->getI18N()->__('Done with the module.'));
	}

	$this->steps = Workflow::getWpfrSteps();
	
	if ($this->steps[$this->workplan->getState()]['owner']['viewAction']!='fill' && !$this->user->hasCredential('backadmin'))
		{
		$this->redirect('plansandreports/view?id='.$this->workplan->getId());
		}

	$this->getResponse()->addCacheControlHttpHeader('max_age=1');
    $this->getResponse()->setHttpHeader('Expires',  $this->getResponse()->getDate(time()));


//$this->getResponse()->setHttpHeader('Last-Modified', $this->getResponse()->getDate(time()));

	$this->wpinfos = $this->workplan->getWpinfos();
	
	$this->tools = $this->workplan->getTools();
	
	$this->workflow_logs = $this->workplan->getWorkflowLogs();
  
	if($request->getParameter('flash'))
		{
			$this->getUser()->setFlash($request->getParameter('flash'), $this->getContext()->getI18N()->__('This item is not correctly filled.'));
			$this->getUser()->setAttribute('aux', 1);
		}

  }

/*
  public function executeXml(sfWebRequest $request)
	{
		$this->setLayout('odt_content');

		$this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
		$this->forward404Unless($this->workplan);
		
		$whoIsViewing = $this->getUser()->getProfile()->getSfGuardUser()->getId();
		
		$this->forward404Unless($this->workplan->isViewableBy($whoIsViewing));
		
		$this->tools = $this->workplan->getTools(false);


	}
*/
/*
  public function executeOdt(sfWebRequest $request)
	{
		$this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
		$this->forward404Unless($this->workplan);
	
		$document = new Opendocument('mattiussirq', $this->workplan);  // the second parameter is the document name
		$document->setHeader($this->getController()->getPresentationFor('headers', 'workplan'));
		$document->setContent($this->getController()->getPresentationFor('plansandreports', 'xml'));
		$document->setResponse($this->getContext()->getResponse());
		return sfView::NONE;
		
	}
*/
	public function executeServedoc(sfWebRequest $request)
	{
		$this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
		$this->forward404Unless($this->workplan);

		$this->doctype=$request->getParameter('doctype');
		$this->forward404Unless(in_array($this->doctype, array('odt', 'doc', 'pdf', 'rtf')));
		
		try 
		{
			$odfdoc=$this->workplan->getOdf($this->doctype, $this->getContext(), $request->getParameter('template', ''), true);
		}
		catch (Exception $e)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.'). ' ' . $e->getMessage());
			$this->redirect('plansandreports/export?id='. $this->workplan->getId());
		}
		
		try
		{
			$odfdoc
			->saveFile()
			->setResponse($this->getContext()->getResponse());
			return sfView::NONE;
		}
		catch (Exception $e)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Conversion failed.'). ' ' . $e->getMessage());
			$this->redirect('plansandreports/export?id='. $this->workplan->getId());
		}
		
	}

  public function executeArchive(sfWebRequest $request)
  {
		$this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
		$this->forward404Unless($this->workplan);

		$this->doctype=$request->getParameter('doctype');
		$this->forward404Unless(in_array($this->doctype, array('odt', 'doc', 'pdf', 'rtf')));
		
		//if ($this->workplan->
    
    try
    {
      $this->workplan->createAttachment($request->getParameter('complete', 'false')=='true', $this->getContext()); 
    }
		catch (Exception $e)
		{
			$this->getUser()->setFlash('error', $this->getContext()->getI18N()->__('Operation failed.'). ' ' . $this->getContext()->getI18N()->__('Please ask the administrator to check the template.') . $e->getMessage());
      $this->redirect('plansandreports/export?id='. $this->workplan->getId());

		}
		
    $this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Archiviation done.'));
    $this->redirect('plansandreports/export?id='. $this->workplan->getId());
  }

  public function executeView(sfWebRequest $request)
  {
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->workplan);
	
	  $whoIsViewing = $this->getUser()->getProfile()->getSfGuardUser()->getId();
	
    $this->forward404Unless($this->workplan->isViewableBy($whoIsViewing));
	
    $this->steps = Workflow::getWpfrSteps();

    if ($request->getParameter('layout')=='popup')
		{
			$this->setLayout('popup_layout');
		};

    switch($request->getRequestFormat())
		{
       case 'yaml': 
					$this->setLayout(false);
					$this->getResponse()->setContentType('text/plain');
					return $this->renderText(sfYaml::dump($this->workplan->getCompleteContentAsArray(), 10));
					
		}

    $this->wfevents = $this->workplan->getWorkflowLogs();
    $this->wpinfos = $this->workplan->getWpinfos();
    
    $this->wpitemTypes=WpitemTypePeer::getAllByRank($this->workplan);
    $this->tools = $this->workplan->getTools(true);
    $this->is_owner = $this->workplan->getUserId() == $whoIsViewing;

  }

  public function executeExport(sfWebRequest $request)
  {
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->workplan);
	
    $whoIsViewing = $this->getUser()->getProfile()->getSfGuardUser()->getId();
	
    $this->forward404Unless($this->workplan->isViewableBy($whoIsViewing));
    
    $this->attachments=$this->workplan->getAttachmentFiles();

    $this->unoconv_active=OdfDocPeer::getIsUnoconvActive();
    
    if($request->getParameter('back','')=='monitor')
    {
      $this->breadcrumpstype='plansandreports/list/appointment/export';
    }
    else
    {
      $this->breadcrumpstype='plansandreport/appointment/export';
    }

    

  }


  public function executeViewwfevents(sfWebRequest $request)
  {
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->workplan);
	
	  $this->events=$this->workplan->getWfevents();

  }


public function executeEditwfevent(sfWebRequest $request)
  {
	$this->forward404Unless($this->event=WfeventPeer::retrieveByPK($request->getParameter('id')));
	
	$this->form = new WfeventForm($this->event);
	
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$result=$this->event->modifyWfevent($params['user_id'], $params['created_at'], $params['comment'], $params['state'], $params['update_state']);
				
				$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
				
				if ($result['result']=='notice')
				{
					$this->redirect('plansandreports/viewwfevents?id='. $this->event->getBaseId());
				}
				else
				{
					$this->redirect('plansandreports/editwpevent?id='. $this->event->getId());
				}

			}
		}
 }

public function executeAddwfevent(sfWebRequest $request)
  {
	$this->appointment=AppointmentPeer::retrieveByPK($request->getParameter('appointment'));
	$this->forward404Unless($this->appointment);
  $wfevent=new Wfevent();
  $wfevent->setBaseTable(WfeventPeer::APPOINTMENT);
	$this->form = new WfeventForm($wfevent);
	
	if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter('info'));
			if ($this->form->isValid())
			{
				$params = $this->form->getValues();
				
				$wfevent
				->setBaseId($this->appointment->getId())
				->setUserId($params['user_id'])
				->setCreatedAt($params['created_at'])
				->setComment($params['comment'])
				->setState($params['state'])
				->save();
        
        if($params['update_state'])
        {
          $this->appointment->updateStateRecursively($params['state']);
				}
        
				$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('New event saved.'));
				
				$this->redirect('plansandreports/viewwfevents?id='. $this->appointment->getId());
				
			}
		}


	}

public function executeRemovewfevent(sfWebRequest $request)
  {
	$this->event=WfeventPeer::retrieveByPK($request->getParameter('id'));
	$this->forward404Unless($request->isMethod('delete'));
	
	$this->appointmentId=$this->event->getBaseId();

	$this->event->delete();

	$this->getUser()->setFlash('notice', $this->getContext()->getI18N()->__('Event successfully deleted.'));
				
	$this->redirect('plansandreports/viewwfevents?id='. $this->appointmentId);
		
	}



  public function executeSyllabus(sfWebRequest $request)
  {
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->workplan);
    $whoIsViewing = $this->getUser()->getProfile()->getSfGuardUser()->getId();
    $this->forward404Unless($this->workplan->isViewableBy($whoIsViewing));
    
    $this->syllabus=$this->workplan->getSyllabus();
    $this->wpmodules=$this->workplan->getWpmodules();
    
    $this->syllabus_contributions=array();
    foreach($this->wpmodules as $wpmodule)
    {
      $this->syllabus_contributions[$wpmodule->getId()]=$wpmodule->getSyllabusContributionsAsArray();
    }
    
    //$this->syllabus_contributions=array();
  }
  
  

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new AppointmentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($workplan = AppointmentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object workplan does not exist (%s).', $request->getParameter('id')));
    $this->form = new AppointmentForm($workplan);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($workplan = AppointmentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object workplan does not exist (%s).', $request->getParameter('id')));
    $this->form = new AppointmentForm($workplan);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($workplan = AppointmentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object workplan does not exist (%s).', $request->getParameter('id')));
    $workplan->delete();

    $this->redirect('plansandreports/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $workplan = $form->save();

      $this->redirect('plansandreports/edit?id='.$workplan->getId());
    }
  }
}
