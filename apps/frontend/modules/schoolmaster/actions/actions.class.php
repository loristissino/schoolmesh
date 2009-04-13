<?php

/**
 * schoolmaster actions.
 *
 * @package    schoolmesh
 * @subpackage schoolmaster
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class schoolmasterActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
   // $this->forward('default', 'module');


  }

	public function executeWpsubmitted(sfWebRequest $request)
	{
		
		$this->workplans=AppointmentPeer::getSubmitted(Workflow::WP_WSMC);
		$this->steps = Workflow::getWpfrSteps();
		
	}
	
	

  public function executeReject(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));
    $workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));

	$result = $workplan->Reject($this->getUser()->getProfile()->getSfGuardUser()->getId(), $this->getUser()->getAllPermissions());

	$this->getUser()->setFlash($result['result'], $result['message']);

	$this->redirect('@schoolmaster');

  }


  public function executeApprove(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post')||$request->isMethod('put'));
    $workplan = AppointmentPeer::retrieveByPk($request->getParameter('id'));

	$result = $workplan->Approve($this->getUser()->getProfile()->getSfGuardUser()->getId(), $this->getUser()->getAllPermissions());

	$this->getUser()->setFlash($result['result'], $result['message']);

	$this->redirect('@schoolmaster');

  }


}
