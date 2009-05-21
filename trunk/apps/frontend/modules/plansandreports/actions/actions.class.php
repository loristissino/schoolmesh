<?php

/**
 * teaching actions.
 *
 * @package    schoolmesh
 * @subpackage teaching
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class plansandreportsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
//    $this->workplans = AppointmentPeer::doSelect(new Criteria());
    $this->workplans = $this->getUser()->getProfile()->getWorkplans();
	$this->steps = Workflow::getWpfrSteps();

  }

	public function executeImport(sfWebRequest $request)
	{
	
	$this->content=sfYaml::load('uploads/test.yaml');

	
		
	}

	public function executeWpsubmit(sfWebRequest $request)
	{
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));
		
    $workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
	
	$result=$workplan->teacherSubmit($this->getUser()->getProfile()->getSfGuardUser()->getId());
	
	$this->getUser()->setFlash($result['result'], $this->getContext()->getI18N()->__($result['message']));
	
	return $this->redirect('@plansandreports');

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
    $this->forward404Unless($this->workplan);
    $this->forward404Unless($this->workplan->isOwnedBy($this->getUser()->getProfile()->getSfGuardUser()->getId()));

	$this->getResponse()->addCacheControlHttpHeader('max_age=1');
    $this->getResponse()->setHttpHeader('Expires',  $this->getResponse()->getDate(time()));


//$this->getResponse()->setHttpHeader('Last-Modified', $this->getResponse()->getDate(time()));

	$this->wpinfos = $this->workplan->getWpinfos();
	
	$this->tools = $this->workplan->getTools();
	
	$this->workflow_logs = $this->workplan->getWorkflowLogs();
	$this->steps = Workflow::getWpfrSteps();

  }

  public function executeView(sfWebRequest $request)
  {
    $this->workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->workplan);
	
	$whoIsViewing = $this->getUser()->getProfile()->getSfGuardUser()->getId();
	
    $this->forward404Unless($this->workplan->isViewableBy($whoIsViewing));

	switch($request->getRequestFormat())
		{
				case 'yaml': 
					$this->setLayout(false);
					$this->getResponse()->setContentType('text/plain');
					return $this->renderText(sfYaml::dump($this->workplan->getCompleteContentAsArray(), 10));
		}


	$this->workflow_logs = $this->workplan->getWorkflowLogs();
	$this->wpinfos = $this->workplan->getWpinfos();
	$this->wpitemTypes=WpitemTypePeer::getAllByRank();
	$this->tools = $this->workplan->getTools(true);
	$this->is_owner = $this->workplan->getUserId() == $whoIsViewing;



  }


  public function executeNew(sfWebRequest $request)
  {
//    $this->form = new AppointmentForm();


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
